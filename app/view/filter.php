<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 27-Oct-16
 * Time: 15:10
 */

//$session = new Session;

if(isset($_GET['page'])) {

    if (isset($_GET['page']) == 'filter') {

        $id = $session->cleantonumber($_POST['id']);
        $filter = $session->clean($_POST['filter']);

        $_SESSION['role'] = $id;
        $_SESSION['filter'] = $filter;

        //var_dump($_SESSION['role']);

        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
//$_SESSION['role'] = $_POST['action'];
