<?php
session_start();
require_once "connect.php";
// var_dump($_SESSION);
if(!isset($_SESSION['nom'])){
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Papy's Chat</title>
</head>

<body>
    <div class="container-fluid bg">
        <h1>Papy's Chat</h1>    
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-4 mt-5 ">
                <div class="connected h-100 px-3">
                <div id="connecte" class="h-75">
                    
                </div>   
                <div id="logout" class="h-25">
                    <?php echo $_SESSION['nom']." est connecté(e)"?>
                    <form action="" method="POST">
                        <button class="btn btn-warning" type="submit" name='action' value='logout' id="logout">Log
                            Out</button>
                    </form>
                </div>
                </div>
            </div>
            <div class="col-12 col-sm-8 mt-5 discussion">
                <div class="col-12 messages" id="allposts">
                    <p>Ici seront affichés les posts</p>
                </div>
                <form method="POST">
                    <div class="input-group mb-3">
                        <input type="text" id="texte" class="form-control" placeholder="Saisir votre message"
                            aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <span class="input-group-text" id="Envoyer">Envoyer</span>
                        </div>
                    </div>
                </form>
                <div id="retour">
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
<?php
    if (isset($_POST['action'])&&($_POST['action']=='logout')){
        $dbb=connect();
        $req=$dbb->prepare('UPDATE `users` SET `Connected`=0 WHERE `ID_Users`=:users');
        $req->execute(['users' => $_SESSION['ID_user']]);
        session_destroy();
        header('location: index.php');
    }
    ?>
<script src="Script.js"></script>

</html>