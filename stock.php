<?php
require_once 'autoloader.php';
use App\Repository\ArticleRepository;

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
    }
$restaurateurid = $_SESSION['user_id'];
$repo = new ArticleRepository();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['stocks'])) {
        foreach ($_POST['stocks'] as $id_article => $nouvelle_quantite) {
            $repo->updateStock((int)$id_article, (float)$nouvelle_quantite);
        }
        $confirmation= "<p class='validationmsg'>✅ Stocks mis à jour avec succès !</p>";
    }
    }
    
    $ingredients = $repo->findByRestaurateur($restaurateurid);
    ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GestionStock</title>
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
        
    </head>
    <?php 
    $page_name = 'stock';
    include 'header.php'?>
    <body class="dashboard-body">
        <?php include 'sidebar.php'?>
        <main class="main-content">
            <?php  if(isset($confirmation)) { echo $confirmation ;} ?>
            <div class="content-inventaire ">
                <h1>Inventaire des Ingrédients</h1>
                <form method="POST">

                    
        <table style="border-collapse: collapse;">
            <thead>
                <tr style="background-color: #eee;">
                    <th>Ingrédient</th>
                    <th>Stock Actuel</th>
                    <th>Unité</th>
                </tr>
            </thead>
            <tbody>                  
                <?php foreach ($ingredients as $article){ ?>
                <tr>
                    <td>
                        <strong><?= htmlspecialchars($article->getNomIngredient()) ?></strong>
                    </td>
                    
                    <td>
                            <input type="number" step="0.01" name="stocks[<?= $article->getIdArticle() ?>]" 
                            value="<?= $article->getStockActuel() ?>">
                        </td>
                        
                        <td>
                            <?= htmlspecialchars($article->getUnite()) ?>
                        </td>
                    </tr>
                    <?php }; ?>
                    
                </tbody>
            </table>
            
            <br>
            <div class="btns-inventaire">
            <a href="dashboard.php" class="btn-retour" >Retour</a>
            <button type="submit" class="btn-enregistrer">Enregistrer</button>
            </div>
    </form>
    </div>
    <?php include'footer.php'?>
</main>
</body>
</html>