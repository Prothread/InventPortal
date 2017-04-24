<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 4-4-2017
 * Time: 11:45
 */

$error = false;

$valueNames = ["subject", "client", "user", "project", "assignment", "tender", "case", "urgency", "duration", "endDate", "description"];
$stringVals = ["subject", "endDate", "description"];
$intVals = ["client", "user", "project", "assignment", "tender", "case", "urgency", "duration"];

foreach ($valueNames as $v) {
    ${$v} = mysqli_real_escape_string($mysqli, $_POST[$v]);
}

foreach ($intVals as $iVal) {
    if (!filter_var(${$iVal}, FILTER_VALIDATE_INT) && ${$iVal} !== '0') {
        $error = true;
        $iVal_error = 'task_' . $iVal . '_error';
        ${$iVal_error} = true;
    }
}

foreach ($stringVals as $sVal) {
    ${$sVal} =  trim(${$sVal});
    if (!filter_var(${$sVal}, FILTER_SANITIZE_STRING)) {
        $error = true;
        $sVal_error = 'task_' . $sVal . '_error';
        ${$sVal_error} = true;
    }
}

if ($user == 0) {
    $status = 0;
} else {
    $status = 1;
}

if (!$error) {
    $taskinfo = [];
    foreach ($valueNames as $v) {
        $taskinfo[$v] = ${$v};
    }
    $taskController->create($taskinfo);
    $loginfo = [
        'subject' => 'TEXT_TASK_ADDED',
        'description' => 'TEXT_TASK_ADD[constDivide]' . $subject .  '[constDivide]TEXT_ADDED',
        'date' => date('Y-m-d G:i:s'),
        'user' => $_SESSION['usr_id'],
        'linkType' => $typeNumb,
        'linkId' => $id
    ];
    $logController->create($loginfo);
} else {
    $taskError = true;
}