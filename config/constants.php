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
 define("DIR_VIEW",                         WWW_ROOT."../app/views/");
 define("DIR_CONTROLLER",                   WWW_ROOT."../app/Controller/");
 define("DIR_MAILER",                       WWW_ROOT."../vendor/phpmailer/");
 define("DIR_IMAGE",                        WWW_ROOT."../app/uploads/");
 
// DATABASE CONNECTION
 define("FILE_DB",                          DIR_CONTROLLER."Database.php");
 
 //ERROR FILE
 define("FILE_ERROR",                       DIR_MODEL."error.php");





 //RECHTEN & BITFIELD
 define("FILE_M_RECHTBITFIELD",             DIR_MODEL."rechtBitfield.php");
 define("FILE_M_RECHTGROEP",                DIR_MODEL."rechtgroep.php");
 define("FILE_DB_RECHT",                    DIR_CONTROLLER."db_recht.php");
 define("FILE_M_BITFIELD",                  DIR_MODEL."bitfield.php");
 define("FILE_DB_RECHTGROEP",               DIR_CONTROLLER."db_rechtgroep.php");
 define("FILE_M_RECHT",                     DIR_MODEL."recht.php");
 
 //LOGIN & UITLOGGEN
 define("FILE_DB_LOGINSTYSTEEM",            DIR_CONTROLLER."db_loginsysteem.php");
 define("FILE_M_LOGINSYSTEEM",              DIR_MODEL."loginsysteem.php");
 define("FILE_V_LOGINSCHERM",               DIR_VIEW."login_scherm.php");
 define("URL_WEERGEVEN_UITLOGGEN",          "Uitloggen");
 
 //SESSION
 define("FILE_M_SESSION",                   DIR_MODEL."session.php");
 
 // DASHBOARD
 define("FILE_V_DASHBOARD",                 DIR_VIEW."dashboard.php");
 define("URL_DASHBOARD",                    "?page=dashboard");

// ERROR
 define("TEXT_FORM_FIELD_ERROR_DEFAULT",       "Tekst veld mag niet leeg zijn!");           
 define("TEXT_FORM_FIELD_ERROR_USERNAME",       "Gebruikersnaam is niet geldig!");  
 define("TEXT_FORM_FIELD_ERROR_VOORNAAM",   "Voornaam is niet geldig!");
 define("TEXT_FORM_FIELD_ERROR_TUSSENVOEGSEL",  "Tussenvoegsel is niet geldig!");
 define("TEXT_FORM_FIELD_ERROR_ACHTERNAAM", "Achternaam is niet geldig!");
 define("TEXT_FORM_FIELD_ERROR_GEBOORTEDATUM",       "Geboortedatum is niet geldig!");
 define("TEXT_FORM_FIELD_ERROR_ADRES",       "Adres is niet geldig!");
 define("TEXT_FORM_FIELD_ERROR_WOONPLAATS",       "Woonplaats is niet geldig!");
 define("TEXT_FORM_FIELD_ERROR_TELEFOONPRIVE",       "Privé nummer is niet geldig!");
 define("TEXT_FORM_FIELD_ERROR_TELEFOONWERK",       "Werk nummer is niet geldig!");
 define("TEXT_FORM_FIELD_ERROR_INDIENST",       "In dienst datum is niet geldig!");
 define("TEXT_FORM_FIELD_ERROR_RECHT",       "Recht is niet geldig!");
