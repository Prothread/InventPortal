<?php

if(isset($_SESSION['usr_id'])) {
    session_destroy();
    unset($_SESSION['usr_id']);
    unset($_SESSION['usr_name']);
    header("Location: index.php?page=login");
} else {
    header("Location: index.php?page=register");
}
