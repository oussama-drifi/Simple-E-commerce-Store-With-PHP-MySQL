<?php
require("database.php");
session_start();
$sql = "SELECT * FROM detail_commande AS dc INNER JOIN 
        produit AS p ON dc.produit_id = p.produit_id 
        WHERE commande_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$_GET["commande_id"]]);
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

// pannier elements
$sql = "SELECT * FROM pannier where client_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$_SESSION["client_id"]]);

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
    <title>details commande</title>
    <!-- font family -->
    <style>
        @font-face {
        font-family: 'Poppins';
        src: url('Poppins/Poppins-Bold.ttf') format('truetype');
        }
    </style>
    <!-- css files -->
    <link rel="stylesheet" href="css/detailscommande.css">
    <!--font-icon-->
    <link rel="stylesheet" href="css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="homepage.php"><img src="imgs/logoLight.png" alt="img"></a>
        </div>
        <form method="post" class="btns">
            <div class="links">
                <a href="commandes.php"><i class="fa-solid fa-boxes-stacked"></i> commandes</a>
                <a href="support.php"><i class="fa-solid fa-headset"></i> support</a>
            </div>
            <button type="submit" name="deconnexion"><i class="fa-solid fa-arrow-right-from-bracket"></i> Deconnexion</button>
            <div class="wrapper">
                <button type="button" class="pannier"><span><?php echo $stmt->rowCount() ?></span><a href="pannier.php"><i class="fa-solid fa-cart-shopping"></i></a></button>
                <button><i class="fa-regular fa-heart"></i></button>
            </div>
        </form>
    </header>
    <div class="container">
        <h1>Détails du commande</h1>
        <table>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Prix totale</th>
            </tr>
            <?php foreach($produits as $produit) { ?>
            <tr>
                <td>
                    <img src="uploaded_products/<?php echo $produit['produit_image'] ?>" alt=""> <span><?= $produit["produit_nom"] ?></span>
                </td>
                <td><?= $produit["quantite"] ?> pièces</td>
                <td><?= $produit["prix"] ?> DHs</td>
                <td><?= $produit["quantite"] * $produit["prix"] ?> DHs</td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>