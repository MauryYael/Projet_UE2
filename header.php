<!DOCTYPE html>
<html>
    <head>
			<link href="https://fonts.googleapis.com/css?family=Courgette|Open+Sans&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
        <link href="https://cdn.boxicons.com/3.0.8/fonts/filled/boxicons-filled.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
    </head>
<header class="landing-header">
        <div class="landing-container">
            <div class="header-content">
                <div class="landing-logo">
                    <div class="landing-logo-icon">
                        <a class="material-symbols-outlined" href="index.php">restaurant</a>
                    </div>
                    <a class="landing-logo-text" href="index.php">FoodStock</a>
                </div>
                <?php if (!isset($_SESSION['user_id'])) { ?>
                    <div class="header-actions">
                    <a class="btn-login" href="login.php">Se connecter</a>
                    <a class="btn-get-started" href="register.php">S'inscrire</a>
                </div>
                <?php } else {
                    $nom_utilisateur = $_SESSION['user_name'];
                ?>
                <div class="header-actions">
                    <a href="dashboard.php"><?php echo $nom_utilisateur ?> </a>
                    <i class="bxf bx-circle" style="color:#00ff11;"></i>
                </div>
                <?php } ?>
            </div>
        </div>
    </header>
</html>