<?php

class Session
{

    public function exists($name)
    {
        if (isset($_SESSION[$name]) && !empty($_SESSION[$name])) {
            return true;
        }

        return false;
    }

    public function delete()
    {
        session_destroy();
        $_SESSION = null;
    }

    static function flash($type, $message)
    {
        $_SESSION['flash'][] = [
            'type' => $type,
            'message' => $message
        ];
    }

    public function setMailId($id){
        $_SESSION['id'] = $id;
    }

    public function getMailId(){
        return $_SESSION['id'];
    }

    public function ImageVerify($imageid, $verify){
        $img_id = '"' . 'img' . $imageid . '"';
        $_SESSION[$img_id] = $verify;
    }

    public function getImageVerify($imageid){
        $img_id = '"' . 'img' . $imageid . '"';
        return $_SESSION[$img_id];
    }

}