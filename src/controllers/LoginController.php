<?php



require_once 'AppController.php';
require_once __DIR__.'/../models/UserModel.php';
class LoginController extends AppController
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }
    public function login()
    {
        //$testUser = new UserModel('test', 'test');
        if(!$this->isPost()){
            return $this->render('login');
        }
        $login= $_POST['username'];
        $password=$_POST['password'];

        $user = $this->userRepository->getUser($login);

        if(!$user){
            return $this->render('login',['errorLogin'=>'Incorrect login or password!']);
        }

        if($user->getPassword()!==$password){
            return $this->render('login',['errorLogin'=>'Incorrect login or password!']);
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/trainings");

    }

}