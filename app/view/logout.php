<?php
#LOGOUT PAGE
if(isset($_SESSION['usr_id'])) {
    session_destroy();
    $block->Redirect('index.php?page=login');
    unset($_SESSION['usr_id']);
    unset($_SESSION['usr_name']);
} else {
    $block->Redirect('index.php?page=register');
}
