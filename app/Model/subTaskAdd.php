<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 4-4-2017
 * Time: 11:45
 */

$error = false;

$valueNames = ["subject", "client", "userId", "project", "assignment", "tender", "cases", "urgency", "duration", "endDate", "description"];
$stringVals = ["subject", "endDate", "description"];
$intVals = ["client", "userId", "project", "assignment", "tender", "cases", "urgency", "duration"];

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
        if($sVal == 'endDate' && ${$sVal} == ''){
            ${$sVal} = "0000-00-00";
        }else {
            $error = true;
            $sVal_error = 'task_' . $sVal . '_error';
            ${$sVal_error} = true;
        }
    }
}

if ($userId == 0) {
    $status = 0;
} else {
    $status = 1;
}

if (!$error) {
    $taskinfo = [];
    foreach ($valueNames as $v) {
        $taskinfo[$v] = ${$v};
    }
    $taskId = $taskController->create($taskinfo);
    $loginfo = [
        'subject' => 'TEXT_TASK_ADDED',
        'description' => 'TEXT_TASK_ADD[constDivide]' . $subject .  '[constDivide]TEXT_ADDED',
        'date' => date('Y-m-d G:i:s'),
        'userId' => $_SESSION['usr_id'],
        'linkType' => $typeNumb,
        'linkId' => $id
    ];
    $logController->create($loginfo);
    $loginfo['linkType'] = 4;
    $loginfo['linkId'] = $taskId;
    $loginfo['description'] = 'TEXT_TASK_ADD[constDivide]' . $subject .  '[constDivide]TEXT_ADDED';
    $logController->create($loginfo);
} else {
    $taskError = true;
}