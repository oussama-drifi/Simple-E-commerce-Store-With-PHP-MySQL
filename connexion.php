<?php
session_start();
require("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- font family -->
    <style>
        @font-face {
        font-family: 'Poppins';
        src: url('Poppins/Poppins-Bold.ttf') format('truetype');
        }
    </style>
    <!-- css styles -->
    <link rel="stylesheet" href="css/forms.css">
    <!--font-icon-->
    <link rel="stylesheet" href="css/all.min.css">
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
            <img src="imgs/logoLight.png" alt="">
            <h3>Merci de se connecter</h3>
            <div class="input-holder">
                <input type="text" placeholder="email" required name="email">
                <i class="fa-solid fa-envelope"></i>
                <label>Email</label>
            </div>
            <div class="input-holder">
                <input type="password" placeholder="mot de pass" required name="password">
                <i class="fa-solid fa-lock"></i>
                <label>Mot de passe</label>
            </div>
            <button type="submit" name="connexion"><i class="fa-solid fa-right-to-bracket"></i> Connexion</button>
            <a href="inscrire.php"><i class="fa-solid fa-user-plus"></i> S'inscrire</a>
        </form>
    </div>
</body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["connexion"])){
    $sql = "SELECT * FROM clients where client_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_POST["email"]]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($client && password_verify($_POST["password"], $client["client_password"])){
        $_SESSION["client_id"] = $client["client_id"];
        header("location: homepage.php");
        exit();
    }
    echo"<div class='err-msg'>email ou mot de passe incorrecte</div>";
}
?>