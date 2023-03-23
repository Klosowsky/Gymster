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