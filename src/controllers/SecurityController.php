<?php
require_once 'AppController.php';
require_once __DIR__.'/../models/UserModel.php';
require_once __DIR__.'/../repositories/UserRepository.php';
class SecurityController extends AppController
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }
    public function login()
    {
        session_start();
        //$testUser = new UserModel('test', 'test');
        if(!$this->isPost()){
            if (isset($_COOKIE["userId"]) OR isset($_COOKIE["username"]) OR isset($_COOKIE["privileges"])){
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/trainings");
            }
            else{
                return $this->render('login');
            }

        }
        $login= $_POST['username'];
        $password=$_POST['password'];

        $user = $this->userRepository->getUser($login);


        if(!$user){
            return $this->render('login',['errorLogin'=>'Incorrect login or password!']);
        }

        if($user->getPassword()!==md5($password)){
            return $this->render('login',['errorLogin'=>'Incorrect login or password!']);
        }


        setcookie("userId",$user->getUserId(), time() + (70000 * 30));
        setcookie("username", $login, time() + (70000 * 30));
        setcookie("privileges",$user->getPriviledge(), time() + (70000 * 30));

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/trainings");

    }

    public function register(){
        if (!$this->isPost()) {
            if (isset($_COOKIE["userId"]) OR isset($_COOKIE["username"]) OR isset($_COOKIE["privileges"])){
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/trainings");
            }
            else {
                return $this->render('register');
            }
        }
        $login=$_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repatPassword = $_POST['repatPassword'];

        if ($password !== $repatPassword) {
            return $this->render('register', ['messages' => ['Please provide proper password']]);
        }

        //TODO try to use better hash function
        $user = new UserModel($login,md5($password));
        $user->setEmail($email);

        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
    }


    public function logout(){
        session_start();
        session_destroy();
        if (isset($_COOKIE["userId"]) OR isset($_COOKIE["username"]) OR isset($_COOKIE["privileges"])){
            setcookie("userId", '', time() - (3600));
            setcookie("username", '', time() - (3600));
            setcookie("privileges", '', time() - (3600));
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");

    }


}