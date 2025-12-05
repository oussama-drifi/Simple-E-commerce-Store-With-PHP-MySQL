<?php
session_start();
require("database.php");
// l'utilisateur n'a pas l'accès directement au pannier
if(!isset($_SESSION["client_id"])){
    header("location: connexion.php");
    exit();
}

$client_id = $_SESSION["client_id"];

$sql = "SELECT * FROM pannier where client_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$client_id]);

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["ajouter_pannier"])){
    $sql = "INSERT into pannier(client_id, produit_id, quantite) values (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$client_id, $_POST["produit_id"], 1]);
    header("location: homepage.php");
}

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
    <title>homepage</title>
    <style>
        @font-face {
        font-family: 'Poppins';
        src: url('Poppins/Poppins-Bold.ttf') format('truetype');
        }
    </style>
    <!-- css files -->
    <link rel="stylesheet" href="css/homepage.css">
    <!--font-icon-->
    <link rel="stylesheet" href="css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="imgs/logoLight.png" alt="img">
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

    <!-- image principale -->
    <section class="homebanner">
        <img src="imgs/home_banner.png" alt="pas d'image">
    </section>
    <!-- affichage des produits-->
    <?php
    $sql = "SELECT * FROM produit";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <section class="produits">
        <h1><i class="fa-solid fa-minus"></i> Notre Collection des Parfums <i class="fa-solid fa-minus"></i></h1>
        <p>Découvrez notre collection de parfums de luxe, conçue pour l’homme moderne qui allie style, charisme et raffinement. Laissez votre présence parler avant même un mot.</p>
        <div class="produits-container">
            <?php foreach($produits as $produit){ ?>
                <?php $produit_id = $produit["produit_id"] ?>
                <div class="produit1">
                    <div class="image">
                        <img src="<?php echo"uploaded_products/$produit[produit_image]" ?>" alt="">
                    </div>
                    <h3><i class="fa-solid fa-minus"></i> <?php echo $produit['produit_nom'] ?> <i class="fa-solid fa-minus"></i></h3>
                    <h2><?php echo $produit['produit_prix'] ?> DHs</h2>
                    <?php
                    $sql = "SELECT * FROM pannier WHERE produit_id = ? and client_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$produit_id, $client_id]);
                    if($stmt->rowCount() > 0){
                    ?>
                    <div class="btns">
                        <a href="produit.php?id=<?php echo $produit_id ?>">Plus Détails</a>
                        <form action="" method="post">
                            <button type="button" style="pointer-events: none; opacity: 0.6"><i class="fa-solid fa-check"></i></button>
                        </form>
                    </div>
                    <?php } else { ?>
                    <div class="btns">
                        <a href="produit.php?id=<?php echo $produit_id ?>">Plus Détails</a>
                        <form action="" method="post">
                            <input type="hidden" name="produit_id" value="<?php echo $produit_id ?>">
                            <button type="submit" name="ajouter_pannier"><i class="fa-solid fa-cart-shopping"></i></button>
                        </form>
                    </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </section>
    <footer>
        <div class="liens">
            <img src="imgs/logoLight.png" alt="">
            <ul>
                <li><a href="#">Conditions d'utilisation</a></li>
                <li><a href="#">politique de confidentialité</a></li>
            </ul>
        </div>
        <div class="copyright">Copyright © 2025 Tous les droits sont réservées.</div>
    </footer>
</body>
</html>