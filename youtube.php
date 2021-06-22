<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tsimzuora</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css'/>
    <link rel="stylesheet" href="css/tsimzuora.css">
	<script src="js/tsimzuora.js"></script>
</head>


<body>
	<!-- navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="index.php">
			<span><img src="img/ninja32.png"/></span>	
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
						<a class="nav-link" href="sudoku/constrain.php"> Constrain </a>
						<a class="nav-link" href="sudoku/backtracking.php"> BackTracking </a>
						<a class="nav-link" href="sudoku/creategrid.php"> Création de grille </a>
						<a class="nav-link" href="sudoku/dbgrille.php"> Grille BDD </a>
						<a class="nav-link" href="sudoku/play.php"> Jouer </a>
					</div>
                </li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					DisneyQuizz
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="nav-link" href="DisneyQuizz/"> Questions </a>
					</div>
				</li>
                <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					WoW Api
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="nav-link" href="wow/mount.php"> Monture </a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link logout" href="youtube.php"> Youtube </a>
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
                            <a class="nav-link" href="compte/connexion.php"> S'identifier </a>
                            <a class="nav-link" href="compte/inscription.php"> S'inscrire </a>
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

	<div class="container main">
        <div class="embedflix">
            <div class="embedperso">
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/mQSNyqaBd4U" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="embedperso">
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/Xk7dbLjRnvs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="embedperso">
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/BdxnxPxF_WI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="embedperso">
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/_8mdj2JEUSQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="embedperso">
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/B_g2HHBQ180" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
	</div>

</body>
</html>