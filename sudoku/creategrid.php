<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tsimzuora</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/create.js"></script>
    <script src="js/funcGeneral.js"></script>
    <script src="js/constrain.js"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css'/>
    <link rel="stylesheet" href="../css/tsimzuora.css">
    <link rel="stylesheet" href="css/sudoku.css">
    <script src="../js/tsimzuora.js"></script>
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
                        <a class="nav-link" href="constrain.php"> Constrain </a>
						<a class="nav-link" href="backtracking.php"> BackTracking </a>
						<a class="nav-link" href="creategrid.php"> Création de grille </a>
						<a class="nav-link" href="dbgrille.php"> Grille BDD </a>
                        <a class="nav-link" href="play.php"> Jouer </a>
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
                            <a class="nav-link" href="../compte/connexion.php"> S'identifier </a>
                            <a class="nav-link" href="../compte/inscription.php"> S'inscrire </a>
                        </div>
                    </li>
                </ul>
            <?php } else { ?>
                <ul class="navbar-nav my-2 my-sm-0">	
                    <li class="nav-item">
                        <a class="nav-link logout" href="#"> Déconnexion </a>
                    </li>
                </ul>
            <?php } ?>
		</div>
	</nav>

    <div class="container main">
        
        <div class="azerty">
            <?php if (isset($_SESSION["auth"]) == false) { ?>
                <div class="row alert SudokuLog" role="alert">Vous devez être connecté pour accerder à cette fonctionnalité.</div>
            <?php } ?>
            <div class="row alert SudokuError" role="alert"></div>
            <div class="row alert SudokuComplete" role="alert"></div>

            <!-- Groupe de bouton -->
            <?php if (isset($_SESSION["auth"]) == true) { ?>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-info btn-sm" onclick="mainFunc()"> Create </button>
                <button type="button" class="btn btn-outline-info btn-sm" onclick="gridJouable()"> Randomize </button>
                <button type="button" class="btn btn-outline-info btn-sm" onclick="UniqueSolution()"> Solvent </button>
                <button type="button" class="btn btn-outline-info btn-sm" onclick="Seek()"> Seek </button>
            </div>
            <?php } ?>
            <!-- Tableau sudoku -->

            <table id='Tableau' class="table table-dark al"></table>

        </div>
        
    </div>

</body>
</html>

<script>

    mainFunc();

    $('.SudokuError').hide();
    $('.SudokuComplete').hide();

</script>