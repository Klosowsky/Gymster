<?php


class AppController
{
    private $request;
    public function __construct()
    {
        $this->request=$_SERVER['REQUEST_METHOD'];
    }

    protected function isPost():bool{
        return $this->request==='POST';
    }

    protected function isGet():bool{
        return $this->request==='GET';
    }

    protected function render(string $view = null, array $messages = [])
    {
        //die($view);
        session_start();

        if (($view!="login" AND $view!="register") AND !(isset($_COOKIE["userId"]) OR isset($_COOKIE["username"]) OR isset($_COOKIE["privileges"]))){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");
        }
        $path = 'public/views/' . $view . '.php';
        $output = 'page not found';
        if (file_exists($path)) {
            extract($messages);
            ob_start();
            include $path;
            $output = ob_get_clean();
        }
        print $output;
    }
}

?>