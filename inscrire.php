<?php
include("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- texte police -->
    <style>
        @font-face {
        font-family: 'Poppins';
        src: url('Poppins/Poppins-Bold.ttf') format('truetype');
        }
    </style>
    <!-- css fichier -->
    <link rel="stylesheet" href="css/forms.css">
    <!--font-icon-->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- css du message erreur -->
    <style>
        .err-msg{
            position: absolute;
            margin: auto;
            top: 10px;
            border-radius: 7px;
            font-size: 16px;
            font-weight: 600;
            background-color: rgb(255, 233, 233);
            color: red;
            padding: 10px;
        }
    </style>
</head>
<body>
<div class="form-container">
        <form action="" method="POST">
            <!-- <img src="imgs/logofinallight.png" alt=""> -->
            <img src="imgs/logoLight.png" alt="">
            <h3>Merci de saisir vos informations</h3>
            <div class="input-holder">
                <input type="text" placeholder="fname" required name="nom">
                <i class="fa-solid fa-user"></i>
                <label>Nom Complet</label>
            </div>
            <div class="input-holder">
                <input type="email" placeholder="email" required name="email">
                <i class="fa-solid fa-envelope"></i>
                <label>Email</label>
            </div>
            <div class="input-holder">
                <input type="password" placeholder="pass" required name="password">
                <i class="fa-solid fa-lock"></i>
                <label>Mot De Passe</label>
            </div>
            <div class="input-holder">
                <input type="password" placeholder="pass" required name="password-verife">
                <i class="fa-solid fa-lock"></i>
                <label>Verifier Mot De Passe</label>
            </div>
            <button type="submit" name="inscrire"><i class="fa-solid fa-user-plus"></i> S'inscrire</button>
            <a href="connexion.php"><i class="fa-solid fa-right-to-bracket"></i> Se connecter</a>
        </form>
    </div>
</body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["inscrire"])){
    if($_POST["password"] !== $_POST["password-verife"]){
        echo"<div class='err-msg'>les mots de passe sont pas identiques!</div>";
    } else{
        $sql = "SELECT * FROM clients where client_email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$_POST["email"]]);
        if ($stmt->rowCount() > 0){ // l'utilisateur déjà existe
            echo "<div class='err-msg'>cet email est déjà enregistré</div>";
        } else{
            $sql = "INSERT into clients(client_nom, client_email, client_password) values (?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_POST["nom"], $_POST["email"], password_hash($_POST["password"], PASSWORD_DEFAULT)]);
            header("location: connexion.php");
            exit();
        }
    }
}
?>