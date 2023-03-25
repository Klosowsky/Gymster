<?php



require_once 'AppController.php';
require_once __DIR__.'/../models/UserModel.php';
class LoginController extends AppController
{
    public function login()
    {
        $testUser = new UserModel('test', 'test');
        if(!$this->isPost()){
            return $this->render('login');
        }
        $login= $_POST['username'];
        $password=$_POST['password'];

        if($testUser->getLogin()!==$login or $testUser->getPassword()!==$password){
            return $this->render('login',['errorLogin'=>'Incorrect login or password!']);
        }
        else{
            return $this->render('trainings');
        }





    }

}