<?php 
require_once 'connect.php'
// require 'header_client.php';
 ?>


<div class="container-fluid bg">
<div class="row w-100 justify-content-center h-25 align-items-center">
    <h1>Papy's Chat</h1>    
</div>
<div class="row w-100 justify-content-center h-50">
<div class="bgblanc">
        <h2> Se connecter </h2>
        <div class="row w-100 justify-content-center mx-0">
            <div class="col-12 d-flex justify-content-center w-100" style="flex-wrap:wrap">
                <form class="w-100" action="" method="POST">
                    <div class="form-group">
                        <label for=""> Pseudo</label>
                        <input type="text" name="username" class="form-control" />
                    </div>
                    <div class="form-group"> <label for=""> Mot de passe
                        </label> <input type="password" name="password" class="form-control" />
                    </div> 
                    <button type="submit" class="btn btn-primary">Se connecter </button>
                </form>
                <div>
                    <?php 
                if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
                    $dbb=connect();
                    $req=$dbb->prepare('SELECT * FROM users WHERE Login_Users= :username ');
                    $req->execute(['username' => $_POST['username']]);
                    $user = $req ->fetch();
                    if($_POST['password']==$user["MDP_Users"]){
                        $_SESSION['Login']=$user['Login_Users'];
                        $_SESSION['nom']=$user['Name_Users'];
                        $_SESSION['ID_user']=$user['ID_Users'];
                        $dbb=connect();
                        $req=$dbb->prepare('UPDATE `users` SET `Connected`=1 WHERE `ID_Users`=:users');
                        $req->execute(['users' => $_SESSION['ID_user']]);
                            header('location: chat.php');
                            exit;
                    }
                    else{
                    echo'identifiant ou mot de passe incorrecte';
                    }
                }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
            </div>
<?php
// require 'footer.php'; ?>