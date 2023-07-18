<?php
require '../core/helper.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$apiUri = $_ENV['API_LINK'];

$datasend = $_POST['datasend'];

// Extract email data
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    $nope = $_POST['nope'];
    $status = $_POST['status'];
    $status = ($status == 'on') ? 'Active' : 'Not Active';
}

// Extract site data
if (isset($_POST['situs'])) {
    $situs = $_POST['situs'];
    $earning = $_POST['earning'];
}

$email = $_POST['email'];
$note = $_POST['note'];

if ($datasend == "mailup") {
    $image = $_FILES['file'];
    $image_url = uploadFile($image, 'email');

    if ($image_url == null) {
        echo "error";
    } else {
        $body = [
            'email' => $email,
            'password' => $password,
            'nohp' => $nope,
            'status' => $status,
            'ss' => $image_url,
            'note' => $note
        ];
        $savedata = emailsave($body, $apiUri);
        return $savedata;
    }
}

if ($datasend == "editmail") {
    $id = $_POST['id-edit'];
    $image_url = ($_FILES['file']["name"] == null) ? $_POST['img-scr'] : uploadFile($_FILES['file'], 'email');

    if ($image_url == null) {
        echo "error";
    } else {
        $body = [
            'email' => $email,
            'password' => $password,
            'nohp' => $nope,
            'status' => $status,
            'ss' => $image_url,
            'note' => $note
        ];

        $editData = editEmail($body, $id, $apiUri);
        return $editData;
    }
}

if ($datasend == "siteup") {
    $image = $_FILES['file'];
    $image_url = uploadFile($image, 'site');
    if ($image_url == null) {
        echo "error";
    } else {
        $body = [
            'situs' => $situs,
            'email' => $email,
            'earning' => $earning,
            'ss' => $image_url,
            'note' => $note,
        ];
        $savedata = siteSave($body, $apiUri);
        return $savedata;
    }
}

if ($datasend == "editsite") {
    $id = $_POST['id-edit'];
    $image_url = ($_FILES['file']["name"] == null) ? $_POST['img-scr'] : uploadFile($_FILES['file'], 'site');

    if ($image_url == null) {
        echo "error";
    } else {
        $body = [
            'situs' => $situs,
            'email' => $email,
            'earning' => $earning,
            'ss' => $image_url,
            'note' => $note,
        ];
        $editData = editSite($body, $id, $apiUri);
        return $editData;
    }
}
