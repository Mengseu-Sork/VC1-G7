<?php
class BaseController
{
    public function view($view, $data = [])
    {
        extract($data);
        ob_clean();
        $content = ob_get_clean();
        require_once 'views/layout.php';
        require_once 'auth/'.$view.'.php';
    }
    public function redirect($uri)
    {
        header('Location:' . $uri);
        exit();
    }
}
