<?php
require_once 'connect.php';

function readallpost()
{
    $dbb=connect();
    $req=$dbb->prepare('SELECT Date_Chat, Message_chat, Name_Users, ID_Users, Color, Avatar_Users FROM chat INNER JOIN users ON chat.users_id_users=users.ID_Users ORDER BY Date_Chat DESC LIMIT 20');
    $req->execute();
    $allpost = $req ->fetchAll();
    echo json_encode($allpost);
}

function addapost($id,$message)
{
    $dbb=connect();
    $req=$dbb->prepare('INSERT INTO `chat`(`ID_Chat`, `Date_Chat`, `Message_Chat`, `users_id_users`) VALUES (NULL,NOW(),:post,:id)');
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->bindParam(':post', $message, PDO::PARAM_STR);
    $req->execute();
}

function Whosconnected()
{
    $dbb=connect();
    $req=$dbb->prepare('SELECT * FROM `users` WHERE `Connected`=1');
    $req->execute();
    $allconnected = $req ->fetchAll();
    echo json_encode($allconnected);
}
?>