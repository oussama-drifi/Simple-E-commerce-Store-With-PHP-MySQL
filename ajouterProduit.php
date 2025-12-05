<?php
require("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Produit</title>
    <!-- font family -->
    <style>
        @font-face {
        font-family: 'Poppins';
        src: url('Poppins/Poppins-Bold.ttf') format('truetype');
        }
    </style>
    <!-- css files -->
    <link rel="stylesheet" href="css/ajouterProduit.css">
    <link rel="stylesheet" href="ajouterProduit.css?v=<?= time() ?>">
    <!--font-icon-->
    <link rel="stylesheet" href="css/all.min.css">

    <style>
        .err-msg, .succès-msg{
            position: absolute;
            margin: auto;
            top: 10px;
            border-radius: 7px;
            font-size: 16px;
            font-weight: 600;
            padding: 10px;
        }
        .succès-msg{
            background-color: rgb(237, 255, 233);
            color: green;
            border: 1.5px solid green;
        }
        .err-msg{
            background-color: rgb(255, 233, 233);
            color: red;
            border: 1.5px solid red;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form method="post" enctype="multipart/form-data">
            <img src="imgs/logoLight.png" alt="">
            <h4>merci de saisir les informations du produit</h4>
            <input type="text" placeholder="Nom du produit" name="nom" required>
            <textarea name="description" id="" placeholder="Description du produit" required></textarea>
            <input type="number" min="1" step="0.01" placeholder="Prix du produit" name="prix" required>
            <input type="number" min="1" placeholder="Quantité en stock" name="quantite" required>
            <input type="file" name="image" accept="image/*" required>
            <input type="submit" name="ajouter" value="Ajouter produit">
        </form>
    </div>
</body>
</html>


<?php
if(isset($_POST["ajouter"])){
    $produit_nom = $_POST["nom"];
    $produit_description = $_POST["description"];
    $produit_prix = $_POST["prix"];
    $quantite_stock = $_POST["quantite"];
    try{
        if(!isset($_FILES["image"])){
            throw new Exception("Aucune image n'a été envoyée.");
        }
        if($_FILES["image"]["error"] !== 0){
            throw new Exception("Erreur lors de l'insertion de l'image.");
        }
        $produit_image = $_FILES["image"]["name"];
        $img_temp = $_FILES['image']['tmp_name'];
        $dossier_images = "uploaded_products/";
        $image_source = $dossier_images.$produit_image;
        if(!move_uploaded_file($img_temp, $image_source)){
            throw new Exception("Impossible de déplacer l'image.");
        }
        $sql = "INSERT into produit(produit_nom, produit_description, produit_prix, quantite_stock, produit_image) 
                values (?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$produit_nom, $produit_description, $produit_prix, $quantite_stock, $produit_image]);
        echo"<div class='succès-msg'>Produit est insérée avec succès</div>";
    } catch(Exception $e){
        echo "<div class='err-msg'>Erreur : ".$e->getMessage()."</div>";
    }
}
?>