<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 04-Oct-16
 * Time: 09:28
 */

class Session
{

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

}