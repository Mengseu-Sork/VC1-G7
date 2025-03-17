<?php

class BaseController
{
    function view($view, $data = [])
    {
        extract($data);
        ob_clean();
        $content = ob_get_clean();
        require_once 'views/layout.php';
        require_once 'views/'.$view.'.php';
    }

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

}
