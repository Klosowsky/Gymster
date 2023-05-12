<?php
require_once 'Repository.php';
require_once __DIR__.'/../models/UserModel.php';
class UserRepository extends Repository
{
    public function getUser($login) : ?UserModel {
        $stmnt = $this->database->connect()->prepare('SELECT * FROM public.users WHERE username = :login');
        $stmnt->bindParam(':login',$login,PDO::PARAM_STR);
        $stmnt->execute();
        $userFromDb=$stmnt->fetch(PDO::FETCH_ASSOC);

        if(!$userFromDb){
            return null;
        }
        $user= new UserModel($userFromDb['login'],$userFromDb['password']);
        $user->setPriviledge($userFromDb['privilege_id']);
        $user->setUserId($userFromDb['user_id']);
        return $user;
    }

    public function addUser(UserModel $user){

        $con= $this->database->connect();
        try {
            $con->beginTransaction();
            $stmt = $con->prepare('INSERT INTO public.user_details (email) VALUES (?) RETURNING user_detail_id');
            $stmt->execute([$user->getEmail()]);
            $userId = $stmt->fetch(PDO::FETCH_ASSOC)['user_detail_id'];
            $stmt = $con->prepare('INSERT INTO public.users (user_id, privilege_id, username, password) VALUES (?, 1, ?, ?)');
            $stmt->execute([
                $userId,
                $user->getLogin(),
                $user->getPassword()
            ]);
            $con->commit();
        }catch (Exception $ex){
            $con->rollBack();
            print_r($ex);
        }
    }

    public function updateUserDetails(UserModel $user){
        session_start();

        $local_user_id=$_COOKIE['userId'];
        $stmt=$this->database->connect()->prepare('SELECT * FROM public.user_details WHERE user_detail_id= :user_id');
        $stmt->bindParam(':user_id',$local_user_id,PDO::PARAM_INT);
        $stmt->execute();
        $userRecord=$stmt->fetch(PDO::FETCH_ASSOC);
        $newUserDetails= new UserModel("","");
        $newUserDetails->setUserId($userRecord['user_detail_id']);
        if($user->getEmail()==null){
            $newUserDetails->setEmail($userRecord['email']);
        }
        else{
            $newUserDetails->setEmail($user->getEmail());
        }
        if($user->getFirstName()==null){
            $newUserDetails->setFirstName($userRecord['first_name']);
        }
        else{
            $newUserDetails->setFirstName($user->getFirstName());
        }
        if($user->getSecName()==null){
            $newUserDetails->setSecName($userRecord['second_name']);
        }
        else{
            $newUserDetails->setSecName($user->getSecName());
        }
        if($user->getFile()==null){
            $newUserDetails->setFile($userRecord['image']);
        }
        else{
            $newUserDetails->setFile($user->getFile());
        }

        $email=$newUserDetails->getEmail();
        $fName=$newUserDetails->getFirstName();
        $sName=$newUserDetails->getSecName();
        $image=$newUserDetails->getFile();

        $stmt=$this->database->connect()->prepare('UPDATE public.user_details SET email=:new_email, first_name=:new_first_name,second_name=:new_sec_name,image=:new_image WHERE user_detail_id=:user_id');
        $stmt->bindParam(':new_email',$email,PDO::PARAM_STR);
        $stmt->bindParam(':new_first_name',$fName,PDO::PARAM_STR);
        $stmt->bindParam(':new_sec_name',$sName,PDO::PARAM_STR);
        $stmt->bindParam(':new_image',$image,PDO::PARAM_STR);
        $stmt->bindParam(':user_id',$local_user_id,PDO::PARAM_INT);
        $stmt->execute();



    }



}