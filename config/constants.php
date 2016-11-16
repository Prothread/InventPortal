<?php
/**
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 * @author Ghoogendoorn
 * @version 0.2
 *
 * Version history
 * 0.1      GHoogendoorn        Initial version
 *
 * 
 * If the path is not found ad the following line to the config.php:
 *  ini_set('include_path', './' . PATH_SEPARATOR . "./common/". PATH_SEPARATOR . ini_get('include_path'));
 */
set_include_path( get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] );

//echo get_include_path();

define("WWW_ROOT",                          "");
 define("HOME",                             WWW_ROOT."/index.php");
 define("DIR_MODEL",                        WWW_ROOT."../app/Model/");
 define("DIR_VIEW",                         WWW_ROOT."../app/view/");
 define("DIR_CONTROLLER",                   WWW_ROOT."../app/Controller/");
 define("DIR_MAILER",                       WWW_ROOT."../vendor/phpmailer/");
 define("DIR_IMAGE",                        WWW_ROOT."../app/uploads/");
 define("DIR_PUBLIC",                       WWW_ROOT."css/");
 define("DIR_IMG",                          WWW_ROOT."img/profile/");
