<?php
if (isset($_POST['submitType'])) {
    include('../db/class.php');
    $db = new admin_class();
    if ($_POST['submitType'] == 'Login') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $login = $db->login($username, $password);
        if ($login->num_rows > 0) {
            $user = $login->fetch_assoc();
            session_start();
            $_SESSION['id'] = $user['ID'];
            echo 200;
        } else {
            echo 400;
        }
    } elseif ($_POST['submitType'] == 'AddArticle') {
        echo $db->addNewArticle($_POST, $_FILES['articlePhoto']);
    } elseif ($_POST['submitType'] == 'EditArticle') {
        echo $db->editArticle($_POST, $_FILES['articlePhoto']);
    } elseif ($_POST['submitType'] == 'DeleteArticle') {
        $id = $_POST['id'];
        echo $db->deleteArticle($id);
    } else {
        echo 'none1';
    }
} else {
    echo 'none';
}
