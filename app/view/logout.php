<?php
if(isset($_SESSION['usr_id'])) {
    session_destroy();
    header("Location: index.php?page=login");
    unset($_SESSION['usr_id']);
    unset($_SESSION['usr_name']);
} else {
    header("Location: index.php?page=register");
}
