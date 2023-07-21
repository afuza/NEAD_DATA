<?php
require '../core/helper.php';

$apiUri = $_ENV['API_LINK'];

// Process form data if 'datasend' is set
if (isset($_POST['datasend'])) {
    $datasend = $_POST['datasend'];
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
                'password' => $_POST['password'],
                'nohp' => $_POST['nope'],
                'status' => ($_POST['status'] == 'on') ? 'Active' : 'Not Active',
                'ss' => $image_url,
                'note' => $note
            ];
            $savedata = emailsave($body, $apiUri);
            return $savedata;
        }
    } elseif ($datasend == "editmail") {
        $id = $_POST['id-edit'];

        if ($_FILES['file']["name"] == null) {
            $image_url = $_POST['img-scr'];
        } else {
            $image = $_FILES['file'];
            $imagename = $_POST['img-scr'];
            $imagename = explode('/', $imagename);
            $imagename = end($imagename);
            $respondel = deleteFile($imagename);
            if ($respondel == 204) {
                $image_url = uploadFile($image, 'site');
            } else {
                echo "error";
            }
        }

        if ($image_url == null) {
            echo "error";
        } else {
            $body = [
                'email' => $email,
                'password' => $_POST['password'],
                'nohp' => $_POST['nope'],
                'status' => ($_POST['status'] == 'on') ? 'Active' : 'Not Active',
                'ss' => $image_url,
                'note' => $note
            ];

            $editData = editEmail($body, $id, $apiUri);
            return $editData;
        }
    } elseif ($datasend == "siteup") {
        $image = $_FILES['file'];
        $image_url = uploadFile($image, 'site');
        if ($image_url == null) {
            echo "error";
        } else {
            $body = [
                'situs' => $_POST['situs'],
                'email' => $email,
                'earning' => $_POST['earning'],
                'ss' => $image_url,
                'note' => $note,
            ];
            $savedata = siteSave($body, $apiUri);
            return $savedata;
        }
    } elseif ($datasend == "editsite") {
        $id = $_POST['id-edit'];

        if ($_FILES['file']["name"] == null) {
            $image_url = $_POST['img-scr'];
        } else {
            $image = $_FILES['file'];
            $imagename = $_POST['img-scr'];
            $imagename = explode('/', $imagename);
            $imagename = end($imagename);
            $respondel = deleteFile($imagename);
            if ($respondel == 204) {
                $image_url = uploadFile($image, 'site');
            } else {
                echo "error";
            }
        }

        if ($image_url == null) {
            echo "error";
        } else {
            $body = [
                'situs' => $_POST['situs'],
                'email' => $email,
                'earning' => $_POST['earning'],
                'ss' => $image_url,
                'note' => $note,
            ];
            $editData = editSite($body, $id, $apiUri);
            return $editData;
        }
    }
}

if (isset($_GET['login'])) {
    $body = [
        "username" => $_POST['username'],
        "password" => $_POST['password'],
    ];
    echo login($apiUri, $body);
}

if (isset($_GET['token'])) {
    getTokenAcc($apiUri);
}

if (isset($_GET['allmail'])) {
    $data = AllEmail($apiUri);
    echo json_encode($data);
}

if (isset($_GET['getdataemail'])) {
    $id = $_GET['id'];
    $data = getEmail($id, $apiUri);
    echo json_encode($data);
}

if (isset($_POST['deleteemail'])) {
    $id = $_POST['id_email'];
    $data = deleteEmail($id, $apiUri);
    if ($data == 200) {
        echo "success";
    } else {
        echo "error";
    }
}

if (isset($_GET['getdatasite'])) {
    $id = $_GET['id'];
    $data = getSite($id, $apiUri);
    echo json_encode($data);
}

if (isset($_GET['allsite'])) {
    $data = allSite($apiUri);
    echo json_encode($data);
}

if (isset($_POST['deletesite'])) {
    $id = $_POST['id_site'];
    $data = deleteSite($id, $apiUri);
    if ($data == 200) {
        echo "success";
    } else {
        echo "error";
    }
}

if (isset($_POST['logout'])) {
    $data = logout($apiUri);
    echo $data;
}
