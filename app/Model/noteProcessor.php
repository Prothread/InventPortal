<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 4-4-2017
 * Time: 14:18
 */

$error = false;

foreach ($noteTypes as $n) {
    if ($n['id'] == $_POST['noteType']) {
        $logName = $n['name'];
    }
}

if (isset($_POST['noteDelete'])) {
    $noteId = mysqli_real_escape_string($mysqli, $_POST['deleteId']);
    if (!filter_var($noteId, FILTER_VALIDATE_INT)) {
        $error = true;
        echo 'FOUT ' . $noteId;
    }
    if (!$error) {
        $noteController->delete($noteId);
        $loginfo = [
            'subject' => 'TEXT_NOTE_DELETED',
            'description' => 'TEXT_VIEW_NOTE[constDivide]' . $logName . '[constDivide]TEXT_DELETED',
            'date' => date('Y-m-d G:i:s'),
            'userId' => $_SESSION['usr_id'],
            'linkType' => $typeNumb,
            'linkId' => $id
        ];
        $logController->create($loginfo);
    }
} else {

    $valueNames = ["linkType", "linkId", "noteType", "eventDate", "description", "userId", "creationDate"];
    $stringVals = ["eventDate", "description", "creationDate"];
    $intVals = ["linkType", "linkId", "noteType", "userId"];
    foreach ($valueNames as $v) {
        ${$v} = mysqli_real_escape_string($mysqli, $_POST[$v]);
    }
    foreach ($intVals as $iVal) {
        if (!filter_var(${$iVal}, FILTER_VALIDATE_INT) && ${$iVal} !== '0') {
            $error = true;
            $iVal_error = 'note_' . $iVal . '_error';
            ${$iVal_error} = true;
            echo 'iVal' . $iVal;
        }
    }
    foreach ($stringVals as $sVal) {
        ${$sVal} = trim(${$sVal});
        if (!filter_var(${$sVal}, FILTER_SANITIZE_STRING)) {
            $error = true;
            $sVal_error = 'note_' . $sVal . '_error';
            ${$sVal_error} = true;
        }
    }
    if (isset($_POST['noteEdit'])) {
        $noteId = mysqli_real_escape_string($mysqli, $_POST['id']);
        if (!filter_var($noteId, FILTER_VALIDATE_INT)) {
            $error = true;
        }
    }
    if (!$error) {
        if (isset($_POST['noteAdd'])) {
            $noteInfo = [
                'linkType' => $linkType,
                'linkId' => $linkId,
                'noteType' => $noteType,
                'eventDate' => $eventDate,
                'description' => $description,
                'userId' => $userId,
                'creationDate' => $creationDate
            ];
            if ($noteController->create($noteInfo)) {
                $loginfo = [
                    'subject' => 'TEXT_NOTE_ADDED',
                    'description' => 'TEXT_VIEW_NOTE[constDivide]' . $logName . '[constDivide]TEXT_ADDED',
                    'date' => date('Y-m-d G:i:s'),
                    'userId' => $_SESSION['usr_id'],
                    'linkType' => $typeNumb,
                    'linkId' => $id
                ];
                $logController->create($loginfo);
            }
        } elseif (isset($_POST['noteEdit'])) {
            $noteInfo = [
                'linkType' => $linkType,
                'linkId' => $linkId,
                'noteType' => $noteType,
                'eventDate' => $eventDate,
                'description' => $description,
                'userId' => $userId,
                'creationDate' => $creationDate,
                'id' => $noteId
            ];
            if($noteController->update($noteInfo)) {
                $loginfo = [
                    'subject' => 'TEXT_NOTE_EDITED',
                    'description' => 'TEXT_VIEW_NOTE[constDivide]' . $logName . '[constDivide]TEXT_LOG_EDITED',
                    'date' => date('Y-m-d G:i:s'),
                    'userId' => $_SESSION['usr_id'],
                    'linkType' => $typeNumb,
                    'linkId' => $id
                ];
                $logController->create($loginfo);
            }
        }
    } else {
        if (isset($_POST['noteAdd'])) {
            $noteAddError = true;
        } elseif (isset($_POST['noteEdit'])) {
            $noteEditError = true;
        }
    }
}