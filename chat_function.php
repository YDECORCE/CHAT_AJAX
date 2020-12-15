<?php
require_once 'connect.php';

function readallpost()
{
    $dbb=connect();
    $req=$dbb->prepare('SELECT * FROM chat INNER JOIN users ON chat.users_id_users=users.ID_Users');
    $req->execute();
    $allpost = $req ->fetchAll();
    return $allpost;
}

function addapost()
{
    $dbb=connect();
    $req=$dbb->prepare('INSERT INTO "chat"("Date_Chat", "Message_Chat", "users_id_users") VALUES (NOW(),:post, :id');
    $req->bindParam(':id', $_SESSION['ID_user'], PDO::PARAM_INT);
    $req->bindParam(':post', $_POST['message'], PDO::PARAM_STR);
    $req->execute();
}
?>