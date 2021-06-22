<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tsimzuora.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/play.js"></script>
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
            <!-- Groupe de bouton -->     
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-info btn-sm" onclick="Getgrid()"> New </button>
                <button type="button" class="btn btn-outline-info btn-sm" onclick="Help()"> Help </button> 
                <button type="button" class="btn btn-outline-info btn-sm" onclick="Soluce()"> Soluce </button> 
            </div>  
            
            <!-- Tableau sudoku -->
            <table id='Tableau' class="table table-dark al"></table>

         </div>

    </div>


</body>
</html>

<script>
    
    let Jeu =     [ [0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0] ];

    let Solution = [ [0, 0, 0, 0, 0, 0, 0, 0, 0],
                     [0, 0, 0, 0, 0, 0, 0, 0, 0],
                     [0, 0, 0, 0, 0, 0, 0, 0, 0],
                     [0, 0, 0, 0, 0, 0, 0, 0, 0],
                     [0, 0, 0, 0, 0, 0, 0, 0, 0],
                     [0, 0, 0, 0, 0, 0, 0, 0, 0],
                     [0, 0, 0, 0, 0, 0, 0, 0, 0],
                     [0, 0, 0, 0, 0, 0, 0, 0, 0],
                     [0, 0, 0, 0, 0, 0, 0, 0, 0] ];


    function Play(GridRsp){

        for (let y = 0 ; y < 9 ; y++) {
            Jeu[0][y] = parseInt(GridRsp.R1[y]);
            Jeu[1][y] = parseInt(GridRsp.R2[y]);
            Jeu[2][y] = parseInt(GridRsp.R3[y]);
            Jeu[3][y] = parseInt(GridRsp.R4[y]);
            Jeu[4][y] = parseInt(GridRsp.R5[y]);
            Jeu[5][y] = parseInt(GridRsp.R6[y]);
            Jeu[6][y] = parseInt(GridRsp.R7[y]);
            Jeu[7][y] = parseInt(GridRsp.R8[y]);
            Jeu[8][y] = parseInt(GridRsp.R9[y]);
            Solution[0][y] = parseInt(GridRsp.R1[y]);
            Solution[1][y] = parseInt(GridRsp.R2[y]);
            Solution[2][y] = parseInt(GridRsp.R3[y]);
            Solution[3][y] = parseInt(GridRsp.R4[y]);
            Solution[4][y] = parseInt(GridRsp.R5[y]);
            Solution[5][y] = parseInt(GridRsp.R6[y]);
            Solution[6][y] = parseInt(GridRsp.R7[y]);
            Solution[7][y] = parseInt(GridRsp.R8[y]);
            Solution[8][y] = parseInt(GridRsp.R9[y]);
        };

        ResoudreCSTN(Solution); 
        ReplaceT(Jeu);

        $('.DivEdit').keydown(function() {
            if (this.innerText.length > 0)
                this.innerText = "";
        });

        $('.DivEdit').keyup(function() {

            if (this.innerText.length > 1)
                this.innerText = "";

            let id = this.id;
            const i = Math.trunc(id / 9);
            const j = id % 9;
            const X = parseInt(this.innerText);

            if (X == Solution[i][j]) {
                Jeu[i][j] = X;
                $(this).css({"color": "green"});                
                if (grilleTermine(Jeu))
                    alert("Bravo !");
            } else {
                $(this).css({"color": "red"});
                if (Jeu[i][j] != 0)
                    Jeu[i][j] = 0;
            }
        });
    }


    function Getgrid(){

        $.ajax({
            type: "POST",
            url: "https://www.tsimzuora.com/lib/ajax.php",
            data: {action: 'newgrid'},
            dataType:'JSON', 
            success: function(response){
                Play(response);
            }
        });

    }

    function Help() {

        let helped = false;

        if (!grilleTermine(Jeu)) {

            do {
                // Fonctions d'aléatoire 
                const rnd = Aleatoire(0,80);

                const i = Math.trunc(rnd / 9);
                const j = rnd % 9;

                let e = document.getElementById(rnd); 

                if (Jeu[i][j] == 0){
                    e.innerText = Solution[i][j];
                    e.contentEditable = "false";
                    e.style.color = "orange";
                    Jeu[i][j] = Solution[i][j]
                    helped = true;
                }   

            } while (helped == false)

        } else {
            alert("Grille terminé !!");
        }

    }

    function Soluce() {
        ResoudreCSTN(Jeu);
        ReplaceT(Jeu);
    }

    Getgrid();

</script>