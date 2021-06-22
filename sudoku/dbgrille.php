<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tsimzuora</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="js/funcGeneral.js"></script>
	<script src="../js/tsimzuora.js"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css'/>
	<link rel="stylesheet" href="../css/tsimzuora.css">
	<link rel="stylesheet" href="css/sudoku.css">
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

			<select id="GrilleSelect" class="form-control form-control-sm selectd" onchange="ChangeSelector()">
				<option selected="selected" value="0">Liste des grilles</option>
			</select> 

			<!-- Tableau sudoku -->
			<table id='Tableau' class="table table-dark al"></table>

		</div>

        </div>
    </div>




</body>
</html>

<script>

		
	let Grille =  [ [0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0],
					[0, 0, 0, 0, 0, 0, 0, 0, 0] ];
	
	let LesGrilles;


    function Allgrid(){
        $.ajax({
            type: "POST",
            url: "https://www.tsimzuora.com/lib/ajax.php",
            data: {action: 'allgrid'},
            dataType:'JSON', 
            success: function(response){
                Organise(response);
            }
        });
	}


	function Organise(ObjetGrilles){
		LesGrilles = ObjetGrilles;

		let NombredeGrille = ObjetGrilles.length;

		for(i=0;i<NombredeGrille;i++){
			$("#GrilleSelect").append("<option value='"+ObjetGrilles[i].ID+"'>"+ObjetGrilles[i].ID+"</option>");
		}
	
		for (let y = 0 ; y < 9 ; y++) {
            Grille[0][y] = parseInt(ObjetGrilles[0].R1[y]);
            Grille[1][y] = parseInt(ObjetGrilles[0].R2[y]);
            Grille[2][y] = parseInt(ObjetGrilles[0].R3[y]);
            Grille[3][y] = parseInt(ObjetGrilles[0].R4[y]);
            Grille[4][y] = parseInt(ObjetGrilles[0].R5[y]);
            Grille[5][y] = parseInt(ObjetGrilles[0].R6[y]);
            Grille[6][y] = parseInt(ObjetGrilles[0].R7[y]);
            Grille[7][y] = parseInt(ObjetGrilles[0].R8[y]);
            Grille[8][y] = parseInt(ObjetGrilles[0].R9[y]);
        }

        ReplaceT(Grille);
	}


	function ChangeSelector() {
        let e = document.getElementById("GrilleSelect");  
		let VS = (parseInt(e.options[e.selectedIndex].value)-1);
		
		if (VS >= 0){

			for(let i=0;i<9;i++)
				for(let j=0;j<9;j++)
					Grille[i][j]=0;

			for (let y = 0 ; y < 9 ; y++) {
				Grille[0][y] = parseInt(LesGrilles[VS].R1[y]);
				Grille[1][y] = parseInt(LesGrilles[VS].R2[y]);
				Grille[2][y] = parseInt(LesGrilles[VS].R3[y]);
				Grille[3][y] = parseInt(LesGrilles[VS].R4[y]);
				Grille[4][y] = parseInt(LesGrilles[VS].R5[y]);
				Grille[5][y] = parseInt(LesGrilles[VS].R6[y]);
				Grille[6][y] = parseInt(LesGrilles[VS].R7[y]);
				Grille[7][y] = parseInt(LesGrilles[VS].R8[y]);
				Grille[8][y] = parseInt(LesGrilles[VS].R9[y]);
			}

			ReplaceT(Grille);
		}
	};
	
	Allgrid();
</script>