<?php
    session_start();
    $json_response = json_encode($_SESSION['ID_user']);
    echo $json_response;
?>