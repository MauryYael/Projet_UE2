<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>FoodStock - Maitrisez vos stocks</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="style.css">
</head>
<body class="landing-body">
<?php include 'header.php' ?>
    
<!-- Preview du produit -->
    <section class="hero-section">
        <!-- <div class="hero-grid"></div> -->
        
        <div class="landing-container">
            <div class="hero-content">

                <h1 class="hero-title">
                    La précision en réserve, <br/><span class="hero-title-highlight"> l'excellence dans l'assiette.</span>
                </h1>

                <p class="hero-description">
                    Gérez vos stocks sans prise de tête.<br>Ajoutez vos commandes journalières.<br>Et on s'occupe du reste.
                </p>

                <div class="hero-buttons">
                    <a class="btn-hero-primary" href="dashboard.php">Accédez au Dashboard</a>
                </div>

            </div>
        </div>
    </section>
    <!-- Footer -->
    <?php include 'footer.php' ?>
</body>
</html>