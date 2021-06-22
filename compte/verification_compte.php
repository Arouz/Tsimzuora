<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tsimzuora</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../js/funcGeneral.js"></script>
    <script src="../js/tsimzuora.js"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css'/>
    <link rel="stylesheet" href="../css/tsimzuora.css">
</head>


<body>
	<!-- navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../index.php">
            <span><img src="../img/ninja32.png"/></span>
        </a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Sudoku
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="nav-link" href="../sudoku/constrain.php"> Constrain </a>
						<a class="nav-link" href="../sudoku/backtracking.php"> BackTracking </a>
						<a class="nav-link" href="../sudoku/creategrid.php"> Création de grille </a>
						<a class="nav-link" href="../sudoku/dbgrille.php"> Grille BDD </a>
                        <a class="nav-link" href="../sudoku/play.php"> Jouer </a>
					</div>
                </li>
                <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					DisneyQuizz
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="nav-link" href="../DisneyQuizz/"> Questions </a>
					</div>
				</li>
                <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					WoW Api
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="nav-link" href="../wow/mount.php"> Monture </a>
					</div>
				</li>
            </ul>

            <?php session_start(); ?>
            <?php if (isset($_SESSION["auth"]) == false) { ?>
                <ul class="navbar-nav my-2 my-sm-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mon compte
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="nav-link" href="connexion.php"> S'identifier </a>
                            <a class="nav-link" href="inscription.php"> S'inscrire </a>
                        </div>
                    </li>
                </ul>
            <?php } ?>

            <?php if (isset($_SESSION["auth"]) == true) { ?>
            <ul class="navbar-nav my-2 my-sm-0">	
				<li class="nav-item">
					<a class="nav-link logout" href="#"> Déconnexion </a>
				</li>
			</ul>
            <?php } ?>
		</div>
	</nav>

<?php

if (isset($_GET['cle']) && isset($_GET['mail'])) {

    $Mail = $_REQUEST["mail"];
    $Cle = $_REQUEST["cle"];
    $Etat = 1;

    require "../lib/connexionBase.php";
    $db = connexionBase();

    $sqlsel = "SELECT Membre_ID, Username FROM `Membre` AS M WHERE M.Adresse_email = :mail";
    $stmtsel = $db->prepare($sqlsel);
    $stmtsel->bindParam(':mail', $Email);
    $stmtsel->execute();
    $user = $stmtsel->fetch(PDO::FETCH_OBJ);

    if ($user) {
        $sqlup = "UPDATE Membre SET Etat = :etat WHERE Adresse_email = :mail AND Cle_de_verification = :cle";
        $stmtup = $db->prepare($sqlup);
        $stmtup->bindParam(':etat', $Etat);
        $stmtup->bindParam(':mail', $Mail);
        $stmtup->bindParam(':cle', $Cle);
        $stmtup->execute();
        echo("Votre compte a bien été activé.");
    } else {
        echo("Aucun compte n'est lié à cette adresse email.");
    }
}

?>

<?php if (isset($_GET['cle']) == false || isset($_GET['mail']) == false) { ?>
    <div class="container main">
        <div class="row justify-content-center">
            <div class="container log">
                <p><span><img src="../img/torii128.png"/></span></p>
                <p>Verify your email</p>
                <form id="form_p">
                    <!-- Div d'alert -->
                    <div class="form-group log">
                        <div id="Error" style="display :none;" class="alert alert-danger centertext sign" role="alert">/!\  /!\</div>
                        <div id="SuccessLogin" style="display :none;" class="alert alert-info centertext sign" role="alert">/!\ Vous êtes maintenant connecté /!\</div>
                    </div>
                    <div class="form-group log">
                        <input type="email" class="form-control" name="Identifiant" id="Email" aria-describedby="emailHelp" placeholder="Your email adresse">
                    </div>
                    <div class="form-group log">
                        <input type="text" class="form-control" name="Clef" id="Cle" placeholder="Your key">
                    </div>
                </form>
                <div class="form-group log">
                    <button type="submit" class="btn btn-outline-info btn-sm login">Verify</button>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="form-group log">
        <div id="Error" class="alert alert-danger centertext sign" role="alert"></div>
        <div id="SuccessLogin" style="display :none;" class="alert alert-info centertext sign" role="alert"></div>
    </div>
<?php } ?>
</body>
</html>

