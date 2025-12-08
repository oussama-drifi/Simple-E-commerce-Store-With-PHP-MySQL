<?php
session_start();
require("database.php");
$sql = "SELECT * FROM commande where client_id = ? ORDER BY commande_date DESC";
$stmt = $conn->prepare($sql);
$stmt->execute([$_SESSION["client_id"]]);
$commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// pannier elements
$sql = "SELECT * FROM pannier where client_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$_SESSION["client_id"]]);

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["details"])){
    header("location: detailscommande.php?commande_id=$_POST[commande_id]");
}

// se deconnecter
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["deconnexion"])){
    session_unset();
    session_destroy();
    header("location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes</title>
    <!-- font family -->
    <style>
        @font-face {
        font-family: 'Poppins';
        src: url('Poppins/Poppins-Bold.ttf') format('truetype');
        }
    </style>
    <!-- css files -->
    <link rel="stylesheet" href="css/commandes.css">
    <!--font-icon-->
    <link rel="stylesheet" href="css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="homepage.php"><img src="imgs/logoLight.png" alt="img"></a>
        </div>
        <form method="post" class="btns">
            <button type="submit" name="deconnexion"><i class="fa-solid fa-arrow-right-from-bracket"></i> Deconnexion</button>
            <div class="wrapper">
                <button type="button" class="pannier"><span><?php echo $stmt->rowCount() ?></span><a href="pannier.php"><i class="fa-solid fa-cart-shopping"></i></a></button>
                <button><i class="fa-regular fa-heart"></i></button>
            </div>
        </form>
    </header>

    <div class="main-section">
        <h1>Mes Commandes</h1>
        <table>
            <thead>
                <tr>
                    <th>Code Commande</th>
                    <th>Commande date</th>
                    <th>Commande prix</th>
                    <th>Commande état</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($commandes as $commande) { ?>
                <tr>
                    <td>COM_NBR<?= $commande['commande_id'] ?>ESPC</td>
                    <td><?= $commande['commande_date'] ?></td>
                    <td><?= $commande['prix_totale'] ?> DHs</td>
                    <td style="color: red;">non livrée</td>
                    <td>
                        <form action="" method="POST">
                            <input type="hidden" value="<?= $commande['commande_id'] ?>" name="commande_id">
                            <button type="submit" name="details">Détails</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>