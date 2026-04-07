<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'autoloader.php';
use App\Repository\PlatRepository;
use App\Repository\CommandeRepository;
use App\Repository\LignecommandeRepository;
session_start();

// veriification de connexion
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
    }
// recuperation de l'utilisateur et des objets repository
$restaurateurid = $_SESSION['user_id'];
$nom_utilisateur = $_SESSION['user_name'];
$repo = new PlatRepository();
$commandeRepo = new CommandeRepository();
$ligneCommandeRepo = new LigneCommandeRepository();


// récupération des éléments rentrés dans les input de commande et traitement 
$message = ""; 
if ($_SERVER['REQUEST_METHOD']=== 'POST' && isset($_POST['ventes']) ){
    $platsVendus =[];
    foreach ($_POST['ventes'] as $id_plat => $quantite) {
                $quantite = (int)$quantite; 
        
        if ($quantite > 0) {
            $repo->vendrePlat((int)$id_plat, $quantite);
            $platsVendus[$id_plat] = $quantite;
            }
            }
        if (!empty($platsVendus)) {
        $idCommande = $commandeRepo->creer($restaurateurid);

        foreach ($platsVendus as $idPlat => $qty) {
            $ligneCommandeRepo->creer($idCommande, $idPlat, $qty);
        }
            $message = "<p class='validationmsg'>✅ Ventes validées et stocks mis à jour ! <p>";
            }
            }

$mes_plats= $repo->findByRestaurateur($restaurateurid);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>FoodStock - Dashboard Overview</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<?php include 'header.php' ?>
<body class="dashboard-body">

    <!-- Navbar Gauche -->
    <?php
    $page_name = 'dashboard';
    include 'sidebar.php'?>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Navbar -->


        <div class="content-wrapper">
        <?php  if(isset($message)) { echo $message ;} ?>


            <section class="sales-entry-section">
                <form method="POST">
                    <div class="section-header">
                    <div class="section-header-text">
                        <h2 class="section-title">Ventes journalières</h2>
                        <p class="section-description">Veuillez renseigner le nombre de plats vendus aujourd'hui</p>
                    </div>
                    <div class="section-actions">
                        <button class="btn-secondary" type="reset">Réinitialiser</button>
                        <button class="btn-primary" type="submit">Valider</button>
                    </div>
                </div>


                <div class="products-container">
                    <div class="products-grid">
                    <?php    foreach($mes_plats as $plat){?>
                    <div class="product-card">
                    <h3><?php echo htmlspecialchars($plat->getNom());?></h3>
                    <input type="number" value="0" id=qtt-<?php echo $plat->getIdPlat(); ?> name="ventes[<?php echo $plat->getIdPlat()?>]">
                    <div class="divButton">
                    <button type="button" class="counter-btn" onclick="updateQtt(<?php echo $plat->getIdPlat()?>,1)">+</button>
                    <button type="button" class="counter-btn" onclick="updateQtt(<?php echo $plat->getIdPlat()?>,-1)">-</button>
                    </div>
                    </div>
                    
                <?php } ?>    
                </div>
                </div>
                </form>
            </section>
        </div>

        <!-- Footer -->
        <?php include 'footer.php' ?>
    </main>
</body>
</html>