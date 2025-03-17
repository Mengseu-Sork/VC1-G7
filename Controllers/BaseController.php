<?php

class BaseController
{
    function view($view, $data = [])
    {
        extract($data);
        ob_clean();
        $content = ob_get_clean();
        require_once 'views/layout.php';
    }
<<<<<<< HEAD
    public function redirect($uri)
    {
        header('Location:' . $uri);
        exit();
    }  
=======

    function redirect($uri)
    {
        header('Location:' . $uri);
        exit();
    }
    function json($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

>>>>>>> e37aa4e4f99a93e0efb02bbbda6050b8ff1b8e42
}
