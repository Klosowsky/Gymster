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
        $user= new UserModel($userFromDb['login'],$userFromDb['password'],$userFromDb['privilege_id']);
        return $user;
    }

    public function addUser(UserModel $user){

        $con= $this->database->connect();
        try {
            $con->beginTransaction();
            $stmt = $con->prepare('INSERT INTO public.user_details (email,country_id) VALUES (?,1) RETURNING user_detail_id');
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



}