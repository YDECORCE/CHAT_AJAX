<?php 
var_dump($_SESSION);
require_once 'connect.php'
// require 'header_client.php';
 ?>


<div class="container-fluid bg">
    <div class="container bgblanc">
        <h1> Se connecter </h1>
        <div class="row w-100 justify-content-center mx-0">
            <div class="col-12 col-lg-8 d-flex justify-content-center w-100" style="flex-wrap:wrap">
                <form class="w-100" action="" method="POST">
                    <div class="form-group">
                        <label for=""> Pseudo</label>
                        <input type="text" name="username" class="form-control" />
                    </div>
                    <div class="form-group"> <label for=""> mot de passe
                        </label> <input type="password" name="password" class="form-control" />
                    </div> <button type="submit" class="btn btn_jaune">Se connecter </button>
                </form>
                <div>
                    <?php 
                if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
                    $dbb=connect();
                    $req=$dbb->prepare('SELECT * FROM users WHERE Login_Users= :username ');
                    $req->execute(['username' => $_POST['username']]);
                    $user = $req ->fetch();
                    var_dump($user);
                    if($_POST['password']==$user["MDP_Users"]){
                        $_SESSION['Login']=$user['Login_Users'];
                        $_SESSION['nom']=$user['Name_Users'];
                        $_SESSION['ID_user']=$user['ID_Users'];
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
<?php
// require 'footer.php'; ?>