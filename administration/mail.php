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
    <script src="../js/tsimzuora.js"></script>
    <link rel="stylesheet" href="../css/sudoku.css">
</head>

<body>
    
    <!-- navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<a class="navbar-brand" href="../index.php">Tsimzuora</a>
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
						<a class="nav-link" href="../sudoku/creation_de_grille.php"> Création de grille </a>
						<a class="nav-link" href="../sudoku/dbgrille.php"> GrilleDB </a>
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
                            <a class="nav-link" href="../connexion.php"> S'identifier </a>
                            <a class="nav-link" href="../inscription.php"> S'inscrire </a>
                        </div>
                    </li>
                </ul>
            <?php } else { ?>

            
                <ul class="navbar-nav my-2 my-sm-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                            Bienvenue
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="nav-link" href="index.php"> Administration </a>
                            <a class="nav-link logout" href="#"> Déconnexion </a>
                        </div>
                    </li>
                </ul>
            <?php } ?>
		</div>
	</nav>



    <!-- Si non log -->
    <?php if (isset($_SESSION["auth"]) == true) { ?>
        
    <div class="container main">
        <h4>Formulaire d'envoi d'e-mail</h4>
            <!-- formulaire -->
            <br>
            <form>
                <div class="form-group">
                    <label for="Sujet">Sujet</label>
                    <input type="text" class="form-control" id="Sujet">
                </div>
                
                <div class="form-group">
                    <label for="Message">Message</label>
                    <textarea class="form-control" id="Message" rows="5"></textarea>
                </div>

                <div class="form-group">
                    <label for="Niveau">Niveau des destinataires</label>
                    <select class="form-control" id="Niveau" onchange="ChangeSelector()">
                        <option value="1">Membre</option>
                        <option value="2">Modérateur</option>
                        <option value="3">Administrateur</option>
                        <option value="4" selected="selected">Tous</option>
                    </select>
                </div>
        </form>
        <button class="btn btn-primary send"> Envoyer </button>
    </div>

    <?php } ?>

</body>
</html>


<script>
    let niveau = "4";
    function ChangeSelector() {
        niveau = $('#Niveau').find(":selected").val();
    }

    $(document).ready(function(){
        $('.send').click(function(){
            let ajaxurl = 'ovh_mail.php';
            let sujet = $('#Sujet').val();
            let message = $('#Message').val();
            let datax =  {'action': 'sendmail', 'sujet': sujet, 'message': message, 'niveau': niveau};
            $.post(ajaxurl, datax, function (data) {
                if (data == 'success') {
                    alert("Mails envoyés");
                }
                else 
                    alert(data);
            });
        });
    });
</script>