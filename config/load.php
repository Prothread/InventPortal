<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 03-Oct-16
 * Time: 10:44
 */

//Session start
session_start();

//Get Composer autloader
require '../vendor/autoload.php';

// Require helper functions.
require '../app/helpers.php';

//Get directory Constants
require '../config/constants.php';

//Get permissions for users
//require '../config/perms.php';
