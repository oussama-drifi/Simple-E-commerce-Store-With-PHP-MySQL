<?php
session_start();
require("database.php");
// l'utilisateur n'a pas l'accès directement au pannier
if(!isset($_SESSION["client_id"])){
    header("location: connexion.php");
}
// afficher les produits
$sql = "SELECT pannier.produit_id, pannier.quantite, produit.produit_id, produit.produit_nom, produit.produit_description, produit.produit_prix, produit.produit_image
        FROM pannier inner join produit on pannier.produit_id = produit.produit_id where client_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$_SESSION["client_id"]]);
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
// lorsqu'on supprime un produit
if($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST["supprimer"])){
    $sql = "DELETE from pannier where client_id = ? and produit_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_SESSION["client_id"], $_POST["produit_id"]]);
    header("location: pannier.php");
}
// lorsqu'on modifie la quantité
if($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST["modifier_qt"])){
    $sql = "UPDATE pannier set quantite = ? where client_id = ? and produit_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_POST["quantite"], $_SESSION["client_id"], $_POST["produit_id"]]);
    header("location: pannier.php");
}
// se deconnecter
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["deconnexion"])){
    session_unset();
    session_destroy();
    header("location: home.php");
}
// finaliser une commande
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["commander"])){
    $sql = "INSERT INTO commande(commande_date, prix_totale, client_id) values (CURRENT_DATE(), ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_SESSION["totale_commande"], $_SESSION["client_id"]]);
    $commande_id = $conn->lastInsertId();
    // ajouter au detail commande
    foreach($produits as $produit){
        $sql = "INSERT INTO detail_commande values (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$commande_id, $produit["produit_id"], $produit["quantite"], $produit["produit_prix"]]);
    }
    // vider le pannier
    $sql = "DELETE FROM pannier where client_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_SESSION["client_id"]]);
    header("location: commandes.php");
}
// pour calculer la somme
$noms_produits = [];
$qt_produits = [];
$prix_produits = [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pannier</title>
    <!-- font family -->
    <style>
        @font-face {
    font-family: 'Poppins';
    src: url('Poppins/Poppins-Bold.ttf') format('truetype');
    }
    </style>
    <!-- css files -->
    <link rel="stylesheet" href="css/pannier.css">
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
        </form>
    </header>
    <div class="container">
        <div class="produits">
            <?php if($stmt->rowCount() === 0){ ?>
            <div class="message">
                <p>Vous avez ajouté aucun produit au pannier.</p>
                <a href="homepage.php">Ajouter</a>
            </div>
            <?php } else{ ?>
            <?php foreach($produits as $produit){ ?>
            <?php
            array_push($noms_produits, $produit["produit_nom"]);
            array_push($qt_produits, $produit["quantite"]);
            array_push($prix_produits, $produit["produit_prix"]);
            ?>
            <div class="affichage">
                <div class="image-container">
                    <img src="uploaded_products/<?php echo $produit['produit_image'] ?>" alt="">
                </div>
                <div class="details">
                    <h2><?php echo $produit["produit_nom"] ?></h2>
                    <h1><?php echo $produit["produit_prix"] ?> DHs</h1>
                    <!-- modifier la quantité button -->
                    <form action="" method="post">
                        <input type="hidden" value="<?php echo $produit['produit_id'] ?>" name="produit_id">
                        Quantité <input type="number" min="1" value="<?php echo $produit['quantite'] ?>" name="quantite">
                        <button type="submit" name="modifier_qt">modifier</button>
                    </form>
                    <!-- button supprimer -->
                    <form action="" method="post">
                        <input type="hidden" value="<?php echo $produit['produit_id'] ?>" name="produit_id">
                        <button type="submit" name="supprimer"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="commander">
            <div>
                <h2>Finaliser la commande</h2>
                <div class="prix">
                    <?php for($i = 0; $i < count($noms_produits); $i++){ ?>
                    <div class="produit"><span><i class="fa-solid fa-circle-check"></i><?php echo "$noms_produits[$i] ~ <b>$qt_produits[$i]</b>"  ?></span> <span><b><?php echo $qt_produits[$i]*$prix_produits[$i] ?> DHs</b></span></div>
                    <?php } ?>
                </div>
            </div>
            <div class="group">
                <?php
                $somme = 0;
                for($i = 0; $i < count($prix_produits); $i++){
                    $somme += $prix_produits[$i]*$qt_produits[$i];
                }
                $_SESSION["totale_commande"] = $somme;
                ?>
                <h3 class="prix-totale">Prix Totale: <?php echo $somme ?> DHs</h3>
                <form action="" method="post">
                    <input type="hidden" value="1000">
                    <button type="submit" name="commander"><i class="fa-solid fa-cart-shopping"></i> Commander</button>
                </form>
            </div>
        </div>
        <?php } ?>
    </div>
</body>
</html>