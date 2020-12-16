<?php
session_start();
var_dump($_SESSION);
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
    <title>Document</title>
</head>

<body>
    <div id="logout">
        <?php echo $_SESSION['nom']." est connecté(e)"?>
        <form action="" method="POST">
            <button type="submit" name='action' value='logout' id="logout">Logout</button>
        </form>
        
    </div>
    <?php
    if (isset($_POST['action'])&&($_POST['action']=='logout')){
        session_destroy();
        header('location: index.php');
    }
    ?>
    <div class="container">
        <div class="col-12" id="allposts">
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
    
</body>
<script src="Script.js"></script>

</html>