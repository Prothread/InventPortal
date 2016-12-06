<?php
$settings = new UserController();
$admin = $settings->getAdminSettings();

/* CONFIGURATION */
$crendentials = array(
    'email' => $admin['Email'],         //Your GMail adress
    'password' => $admin['Mailpass']    //Your GMail password
);

/* SPECIFIC TO GMAIL SMTP */
$smtp = array(
    'host' => $admin['SMTP'],
    'port' => $admin['SMTPport'],
    'username' => $crendentials['email'],
    'password' => $crendentials['password'],
    'secure' => 'tls' //SSL or TLS

);