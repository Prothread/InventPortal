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
    'host' => 'smtp.gmail.com',
    'port' => 587,
    'username' => $crendentials['email'],
    'password' => $crendentials['password'],
    'secure' => 'tls' //SSL or TLS

);