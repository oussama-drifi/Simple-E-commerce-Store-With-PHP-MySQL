<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- font family -->
    <style>
        @font-face {
        font-family: 'Poppins';
        src: url('Poppins/Poppins-Bold.ttf') format('truetype');
        }
    </style>
    <!-- css files -->
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="home.css?v=<?= time() ?>">
    <!--font-icon-->
    <link rel="stylesheet" href="css/all.min.css">
</head>
<body>
    <div class="section">
        <div class="content">
            <img src="imgs/logoLight.png" alt="image not found">
            <h1>Explorer notre plus <span>recent collection</span> des parfums</h1>
            <p> Découvrez des parfums d'exception, des boisés sensuels aux fleurs intemporelles, en passant par les éclats d'agrumes vibrants</p>
            <div class="btns">
                <a href="connexion.php"><i class="fa-solid fa-user"></i> Connexion</a>
                <a href="inscrire.php"><i class="fa-solid fa-plus"></i> inscrire</a>
            </div>
        </div>
        <div class="image">
            <img src="imgs/main_img.png" alt="image not found">
        </div>
    </div>
</body>
</html>