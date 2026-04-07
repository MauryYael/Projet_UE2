<?php 
require_once 'autoloader.php';
use App\Repository\RestaurateurRepository;
session_start();
$message = "";
if ($_SERVER['REQUEST_METHOD']=== 'POST'){
    $nom = $_POST['nom'];
    $mail = $_POST['mail'];
    $mdp = $_POST['mdp'];
    $repo = new RestaurateurRepository();
    if ($repo->inscription($nom,$mail,$mdp)){
        $message = "Félicitation , le compte est créé";
        }
    else{$message = "Erreur ,veuillez réessayer";}
        }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register StockFood</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.boxicons.com/3.0.8/fonts/filled/boxicons-filled.min.css" rel="stylesheet">
</head>
<?php include 'header.php' ?>
<?php include 'bgemoji.php' ?>


    <body id="logbody">
        <div class="wrapper">
            <form action="" method="POST">
                <h1>Créer un Compte</h1>
                <div class="input-box">
                    <input type="text" placeholder="Nom d'utilisateur" 
                    required name="nom">
                    <i id="userimg" class='bxf  bx-user'></i> 
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Email" 
                    required name="mail">
                    <i id="mailimg" class="bxf bx-envelope-alt"></i> 
                </div>
                <div  class="input-box">
                    <input type="password" placeholder="Mot de passe" 
                    required name="mdp">
                    <i id="lockimg" class='bxf  bx-lock-keyhole'></i> 
                </div>
                <button type="submit" class="btn">S'enregistrer</button>
                <div class="register-link">
                    <p>Déjà inscrit ? <a href="login.php">Se connecter</a></p>
                </div>
            </form>
            <?php if (!empty($message)){?>
            <div>
                <?php echo $message ?>
            </div>
            <?php } ?>


        </div>

    </body>
</html>