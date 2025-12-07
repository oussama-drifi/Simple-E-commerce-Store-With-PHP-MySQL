<?php
session_start();
require("database.php");

if(!isset($_SESSION["client_id"])){
    header("location: connexion.php");
}

$client_id = $_SESSION["client_id"];

$sql = "SELECT * FROM pannier where client_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$client_id]);

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["deconnexion"])){
    session_unset();
    session_destroy();
    header("location: home.php");
}

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["ajouter_pannier"])){
    $sql = "INSERT into pannier(client_id, produit_id, quantite) values (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$client_id, $_POST['id_produit'], $_POST["quantite"]]);
    header("location: homepage.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Produit</title>
    <style>
        @font-face {
        font-family: 'Poppins';
        src: url('Poppins/Poppins-Bold.ttf') format('truetype');
        }
    </style>
    <!-- css fichiers -->
    <link rel="stylesheet" href="css/produit.css">
    <link rel="stylesheet" href="produit.css?v=<?= time() ?>">
    <!--font-icon-->
    <link rel="stylesheet" href="css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="homepage.php"><img src="imgs/logoLight.png" alt="img"></a>
        </div>
        <form  method="post" class="btns">
            <div class="links">
                <a href="commandes.php"><i class="fa-solid fa-boxes-stacked"></i> commandes</a>
                <a href="support.php"><i class="fa-solid fa-headset"></i> support</a>
            </div>
            <button type="submit" name="deconnexion"><i class="fa-solid fa-arrow-right-from-bracket"></i> Deconnexion</button>
            <div class="wrapper">
                <button type="button"><span><?php echo $stmt->rowCount() ?></span><a href="pannier.php"><i class="fa-solid fa-cart-shopping"></i></a></button>
                <button><i class="fa-regular fa-heart"></i></button>
            </div>
        </form>
    </header>
    
    <!-- affichage du produit avec les details -->
    <div class="container">
        <?php
        $id_produit = $_GET["id"];
        $sql = "SELECT * FROM produit where produit_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_produit]);
        $produit = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <div class="image">
            <img src="uploaded_products/<?php echo $produit["produit_image"] ?>" alt="not found">
        </div>
        <form class="details" method="post">
            <h1><?php echo $produit["produit_nom"] ?></h1>
            <h1><?php echo $produit["produit_prix"] ?> DHs</h1>
            <h4 style="color: green; margin-bottom: 10px"><?php echo $produit["quantite_stock"] ?> en Stock</h4>
            Quantité <input type="number" min="1" value="1" name="quantite" required>
            <p><?php echo $produit["produit_description"] ?></p>
            <div class="btns">
                <?php
                $sql = "SELECT * FROM pannier where produit_id = ? AND client_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$id_produit, $client_id]);
                if ($stmt->rowCount() > 0) { 
                ?>
                <button style="pointer-events: none; opacity: 0.5" type="submit" name="ajouter_pannier"><i class="fa-solid fa-cart-shopping"></i> déjà ajouté</button>
                <?php } else { ?>
                    <form action="" method="POST">
                        <input type="hidden" name="id_produit" value="<?= $produit['produit_id'] ?>">
                        <button type="submit" name="ajouter_pannier"><i class="fa-solid fa-cart-plus"></i> Ajouter au Pannier</button> 
                    </form>
                <?php } ?>
            </div>
        </form>
    </div>
</body>
</html>