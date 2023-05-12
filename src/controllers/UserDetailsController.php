<?php

require_once 'AppController.php';
require_once 'src/repositories/UserRepository.php';

class UserDetailsController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private $userRepository;
    private $message = [];

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function userPanel(){
        $this->render('userpanel',['user'=>'test']);
    }

    public function setUserDetails()
    {
        $isImageUpdated=false;
        if ($this->isPost()) {
            $userDetails = new UserModel("", "");
            if (is_uploaded_file($_FILES['photo']['tmp_name']) ) {
                if($this->validate($_FILES['photo'])){
                move_uploaded_file(
                    $_FILES['photo']['tmp_name'],
                    dirname(__DIR__) . self::UPLOAD_DIRECTORY . $_FILES['photo']['name']
                );
                $userDetails->setFile($_FILES['photo']['name']);
                $isImageUpdated=true;
                }
                else{
                    return $this->render('userpanel', ['error' => 'File error!']);
                }

            }

            if ($_POST['email']!=='' && strpos($_POST['email'],'@') === false) {
                return $this->render('userpanel', ['error' => 'Wrong email!!']);
            }

            $userDetails->setEmail($_POST['email']);
            $userDetails->setFirstName($_POST['first_name']);
            $userDetails->setSecName($_POST['second_name']);

            if(!$this->userRepository->updateUserDetails($userDetails)){
                return $this->render('userpanel', ['error' => 'Error!']);
            }
        }
        if($isImageUpdated){
            session_start();
            setcookie("image",$_FILES['photo']['name'], time() + (70000 * 30));
        }
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/userpanel");
        return $this->render('userpanel', ['success' => 'User details updated!']);
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is too large for destination file system.';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'File type is not supported.';
            return false;
        }
        return true;
    }

}