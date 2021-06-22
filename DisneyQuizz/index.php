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
    <link rel="stylesheet" href="../css/tsimzuora.css">
    <link rel="stylesheet" href="css/quizz.css">
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
						<a class="nav-link" href="#"> Questions </a>
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

        <!-- Modal Modification-->
        <div class="modal fade modalmodif" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form>
                        <!-- Div d'alert -->
                        <div class="form-group log">
                            <div id="ErrorM" style="display :none;" class="alert alert-danger centertext sign" role="alert"></div>
                            <div id="SuccessRegisterM" style="display :none;" class="alert alert-info centertext sign" role="alert">La question a été modifiée.</div>
                        </div>

                        <div class="form-group log">
                            <input type="hidden" disabled="disabled" class="form-control" id="ID">
                        </div>
                        
                        <div class="form-group log">
                            <input type="text" class="form-control" id="Question" placeholder="Question">
                        </div>

                        <div class="form-group log">
                            <input type="text" class="form-control" id="Reponse"  placeholder="Réponse(s)">
                        </div>

                        <div class="form-group log">
                            <input type="text" class="form-control" id="Image"  placeholder="Image (URL)">
                        </div>

                        <div class="form-group log">
                            <a class="btn btn-outline-info modifier" >Modifier</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->

        
        <!-- Modal Ajout -->
        <div class="modal fade modaladd" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form>
                        <!-- Div d'alert -->
                        <div class="form-group log">
                            <div id="ErrorA" style="display :none;" class="alert alert-danger centertext sign" role="alert"></div>
                            <div id="SuccessRegisterA" style="display :none;" class="alert alert-info centertext sign" role="alert">La question a été ajoutée.</div>
                        </div>
                        
                        <div class="form-group log">
                            <input type="text" class="form-control" id="MAQuestion" placeholder="Question">
                        </div>

                        <div class="form-group log">
                            <input type="text" class="form-control" id="MAReponse"  placeholder="Réponse(s)">
                        </div>

                        <div class="form-group log">
                            <input type="text" class="form-control" id="MAImage"  placeholder="Image (URL)">
                        </div>

                        <div class="form-group log">
                            <a class="btn btn-outline-info ajouter" >Ajouter</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->

        
        <!-- Modal Suppression-->
        <div class="modal fade modalsuppr" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form>
                        <!-- Div d'alert -->
                        <div class="form-group log">
                            <div id="ErrorS" style="display :none;" class="alert alert-danger centertext sign" role="alert"></div>
                            <div id="SuccessRegisterS" style="display :none;" class="alert alert-info centertext sign" role="alert">La question a été supprimée.</div>
                        </div>

                        <div class="form-group log">
                            <input type="hidden" disabled="disabled"  class="form-control" id="MSID">
                        </div>
                        
                        <div class="form-group log">
                            <input type="text" disabled="disabled"  class="form-control" id="MSQuestion" placeholder="Question">
                        </div>

                        <div class="form-group log">
                            <input type="text" disabled="disabled"  class="form-control" id="MSReponse"  placeholder="Réponse(s)">
                        </div>

                        <div class="form-group log">
                            <input type="text" disabled="disabled"  class="form-control" id="MSImage"  placeholder="Image (URL)">
                        </div>

                        <div class="form-group log">
                            <a class="btn btn-outline-info supprimer" >Supprimer</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->


        <div class="row justify-content-center">
            <div class="container log">
            <button class="btn btn-outline-info add" data-toggle='modal' data-target='.modaladd'> Ajouter une question </button>
            <!-- Tableau sudoku -->
            <table id='Tableau' class="table table-dark al"></table>  
            </div>
        </div>
    </div>

</body>
</html>


<script>    

    let DbObject;

    function ShowQuestion(qst){
        let Qlength = qst.length;

        const Dtableau = document.getElementById('Tableau');
        Dtableau.innerHTML = '';

        Dtableau.innerHTML += "<tr id='TR'>";
        const Dtri = document.getElementById('TR');
        Dtri.innerHTML += "<td class='Ttitre'>QUESTIONS</td>";
        Dtri.innerHTML += "<td class='Ttitre'>RÉPONSES</td>";
        Dtri.innerHTML += "<td class='Ttitre'>IMAGES</td>";
        Dtri.innerHTML += "<td colspan='2' class='Ttitre'>OPTIONS</td>";
        Dtableau.innerHTML += "</tr>";

        for (let i = 0; i < Qlength; i++) {
            Dtableau.innerHTML += "<tr id='TR" + i + "'>";
            const Dtr = document.getElementById('TR' + i);
            let img = '✗'
            if (qst[i].Image != null)
                img='✓';

            Dtr.innerHTML += "<td id='Q"+qst[i].ID+"'>" + qst[i].Question + "</td>";
            Dtr.innerHTML += "<td id='R"+qst[i].ID+"' class='Reponse'>" + qst[i].Reponse + "</td>";
            Dtr.innerHTML += "<td id='I"+qst[i].ID+"'>" + img + "</td>";
            Dtr.innerHTML += "<td><button class='btn btnM' data-toggle='modal' data-target='.modalmodif' id="+qst[i].ID+" onclick='ModalModifyQuestion(this)'>M</button></td>";
            Dtr.innerHTML += "<td><button class='btn btnS' data-toggle='modal' data-target='.modalsuppr' id="+qst[i].ID+" onclick='ModalSupprQuestion(this)'>S</button></td>";
            Dtableau.innerHTML += "</tr>";
            //SupprQuestion(this)
            if (qst[i].Image != null)
                document.getElementById('I'+qst[i].ID).style.color = 'green';
            else
                document.getElementById('I'+qst[i].ID).style.color = 'red';
        }
    }

    function GetQuestion(){
        $.ajax({
            type: "POST",
            url: "https://www.tsimzuora.com/lib/ajax.php",
            data: {action: 'questions'},
            dataType:'JSON', 
            success: function(qst){
                ShowQuestion(qst);
                DbObject = qst;
            }
        });
    }

    function ModifQuestion(Question) {
        let id = Question.id;
    }


    function SupprQuestion(Question) {
        let Action = 'delquestion';
        let ajaxurl = 'https://www.tsimzuora.com/lib/ajax.php';
        let ID = Question.id;
        let datax =  {'action': Action, 'ID': ID};
        $.post(ajaxurl, datax, function (data) {
            if (data == "yes") {
                $("#SuccessRegister").slideDown(500).delay(2500).slideUp(900);
                setTimeout(() => {
                    window.location.href = "index.php";
                }, 1000);
            } else {
                $("#Error").text("Oupsi doupsi j'ai pas réussi.")
                $("#Error").slideDown(500).delay(2500).slideUp(900);
            }  
        });
    }

    function ModalModifyQuestion(Question) {

        let BonObject;
        for (i=0;i<DbObject.length;i++)
            if (DbObject[i].ID == Question.id)
                BonObject=i;

        const ModalID = document.getElementById('ID');
        const ModalQuestion = document.getElementById('Question');
        const ModalReponse = document.getElementById('Reponse');
        const ModalImage = document.getElementById('Image');

        ModalID.value = DbObject[BonObject].ID;
        ModalQuestion.value = DbObject[BonObject].Question;
        ModalReponse.value = DbObject[BonObject].Reponse;
        ModalImage.value = DbObject[BonObject].Image;
    }

    function ModalSupprQuestion(Question){
        let BonObject;
        for (i=0;i<DbObject.length;i++)
            if (DbObject[i].ID == Question.id)
                BonObject=i;

        const ModalID = document.getElementById('MSID');
        const ModalQuestion = document.getElementById('MSQuestion');
        const ModalReponse = document.getElementById('MSReponse');
        const ModalImage = document.getElementById('MSImage');

        ModalID.value = DbObject[BonObject].ID;
        ModalQuestion.value = DbObject[BonObject].Question;
        ModalReponse.value = DbObject[BonObject].Reponse;
        ModalImage.value = DbObject[BonObject].Image;
    }


    $(document).ready(function(){
        $('.modifier').click(function(){
            let ModalID = document.getElementById('ID').value;
            let ModalQuestion = document.getElementById('Question').value;
            let ModalReponse = document.getElementById('Reponse').value;
            let ModalImage = document.getElementById('Image').value;
            let Action = 'updquestion';
            let ajaxurl = 'https://www.tsimzuora.com/lib/ajax.php';
            let datax =  {'action': Action, 'ID': ModalID, 'Q': ModalQuestion, 'R': ModalReponse, 'I': ModalImage};
            $.post(ajaxurl, datax, function (data) {
                if (data == "yes") {
                    $("#SuccessRegisterM").slideDown(500).delay(2500).slideUp(900);
                    setTimeout(() => {
                        window.location.href = "index.php";
                    }, 2500);
                } else {
                    $("#ErrorM").text("Oupsi doupsi j'ai pas réussi.")
                    $("#ErrorM").slideDown(500).delay(2500).slideUp(900);
                }  
            });
        });
    });

    $(document).ready(function(){
        $('.supprimer').click(function(){
            let Action = 'delquestion';
            let ModalID = document.getElementById('MSID').value;
            let ajaxurl = 'https://www.tsimzuora.com/lib/ajax.php';
            let datax =  {'action': Action, 'ID': ModalID};
            $.post(ajaxurl, datax, function (data) {
                if (data == "yes") {
                    $("#SuccessRegisterS").slideDown(500).delay(2500).slideUp(900);
                    setTimeout(() => {
                        window.location.href = "index.php";
                    }, 1000);
                } else {
                    $("#ErrorS").text("Oupsi doupsi j'ai pas réussi.")
                    $("#ErrorS").slideDown(500).delay(2500).slideUp(900);
                }  
            });
        });
    });

    $(document).ready(function(){
        $('.ajouter').click(function(){
            let Action = 'addquestion';
            let ajaxurl = 'https://www.tsimzuora.com/lib/ajax.php';
            let Question = document.getElementById('MAQuestion').value;
            let Reponse = document.getElementById('MAReponse').value;
            let Image = document.getElementById('MAImage').value;
            let datax =  {'action': Action, 'Question': Question, 'Reponse': Reponse, 'Image': Image};
            $.post(ajaxurl, datax, function (data) {
                if (data == "yes") {
                    $("#SuccessRegisterA").slideDown(500).delay(2500).slideUp(900);
                    setTimeout(() => {
                        window.location.href = "index.php";
                    }, 2500);
                } else {
                    $("#ErrorA").text("Oupsi doupsi j'ai pas réussi.")
                    $("#ErrorA").slideDown(500).delay(2500).slideUp(900);
                }  
            });
        });
    });

    GetQuestion();
</script>