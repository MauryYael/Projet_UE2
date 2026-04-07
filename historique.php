<?php
require_once 'autoloader.php';
use App\Repository\CommandeRepository;

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$repo = new CommandeRepository();
$historique = $repo->findHistoriqueByRestaurateur($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des Commandes - FoodStock</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
</head>
<body class="dashboard-body">

    <?php
    $page_name = 'historique';
    include 'header.php';
    include 'sidebar.php' ?>
    
    <main class="main-content">
        

        <div class="content-wrapper">
            <div class="legal-content" style="max-width: 1000px;"> <h1>Historique des Ventes</h1>
                <p>Retrouvez ici le détail de toutes les commandes passées.</p>

                <?php if (empty($historique)){ ?>
                    <div style="text-align: center; padding: 40px; color: #64748b;">
                        <span class="material-symbols-outlined" style="font-size: 48px;">receipt_long</span>
                        <p>Aucune vente enregistrée pour le moment.</p>
                        <a href="dashboard.php" class="btn-primary" style="display:inline-block; margin-top:10px;">Faire une vente</a>
                    </div>
                <?php } else{ ?>

                    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                        <thead>
                            <tr style="background-color: #f1f5f9; text-align: left;">
                                <th style="padding: 15px; border-radius: 8px 0 0 8px;">Date</th>
                                <th style="padding: 15px;">Détails de la commande</th>
                                <th style="padding: 15px;">Montant Total</th>
                                <th style="padding: 15px; border-radius: 0 8px 8px 0;">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($historique as $commande){ ?>
                                <tr style="border-bottom: 1px solid #e2e8f0;">
                                    <td style="padding: 15px; color: #64748b;">
                                        <?= date('d/m/Y à H:i', strtotime($commande['date_commande'])) ?>
                                    </td>
                                    
                                    <td style="padding: 15px;">
                                        <strong><?= htmlspecialchars($commande['details']) ?></strong>
                                    </td>
                                    
                                    <td style="padding: 15px; font-weight: bold; color: #1152d4;">
                                        <?= number_format($commande['total_prix'], 2, ',', ' ') ?> €
                                    </td>
                                    
                                    <td style="padding: 15px;">
                                        <span style="color: #16a34a; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 700;">
                                            <?= htmlspecialchars($commande['statut']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php }; ?>
                        </tbody>
                    </table>

                <?php }; ?>
            </div>
        </div>

        <?php include 'footer.php' ?>
    </main>

</body>
</html>