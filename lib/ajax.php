<?php 

    session_start();
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'login':
                login();
                break;
            case 'logout': 
                logout();
                break;
            case 'register': 
                register();
                break;
            case 'insert': 
                insertgrid();
                break;
            case 'newgrid': 
                getgrid();
                break;
            case 'questions': 
                getquestion();
                break;
            case 'addquestion';
                addquestion();
                break;
            case 'delquestion';
                delquestion();
                break;
            case 'updquestion';
                modifquestion();
                break;
            case 'allgrid';
                allgrid();
                break;
            default : 
                break;
        }
    }
    
    function getgrid() {

        require "connexionBase.php";
        $db = connexionBase();
        
        $sqlall = "SELECT * FROM `GrilleValide`";
        $stmt = $db->prepare($sqlall);
        $stmt->execute();
        $row = $stmt->rowCount();
    
        $randrow = rand(1,$row);
    
        $sql = "SELECT * FROM `GrilleValide` AS GV WHERE GV.ID = :id";
        $stmt2 = $db->prepare($sql);
        $stmt2->bindParam(':id', $randrow);
        $stmt2->execute();
        $grille = $stmt2->fetch(PDO::FETCH_OBJ);
        echo(json_encode($grille));

    }

    function insertgrid() {
        
        if (isset($_POST['L1']) && isset($_POST['L2']) && isset($_POST['L3']) && isset($_POST['L4']) && isset($_POST['L5']) && isset($_POST['L6']) && isset($_POST['L7']) && isset($_POST['L8']) && isset($_POST['L9'])) {

            $Ligne1 = $_REQUEST["L1"];
            $Ligne2 = $_REQUEST["L2"];
            $Ligne3 = $_REQUEST["L3"];
            $Ligne4 = $_REQUEST["L4"];
            $Ligne5 = $_REQUEST["L5"];
            $Ligne6 = $_REQUEST["L6"];
            $Ligne7 = $_REQUEST["L7"];
            $Ligne8 = $_REQUEST["L8"];
            $Ligne9 = $_REQUEST["L9"];

            require "connexionBase.php";
            $db = connexionBase();

            $req = $db->prepare('INSERT INTO `GrilleValide`(`R1`, `R2`, `R3`, `R4`, `R5`, `R6`, `R7`, `R8`, `R9`) VALUES (:L1, :L2, :L3, :L4, :L5, :L6, :L7, :L8, :L9)');
            $req->bindParam(':L1', $Ligne1);
            $req->bindParam(':L2', $Ligne2);
            $req->bindParam(':L3', $Ligne3);
            $req->bindParam(':L4', $Ligne4);
            $req->bindParam(':L5', $Ligne5);
            $req->bindParam(':L6', $Ligne6);
            $req->bindParam(':L7', $Ligne7);
            $req->bindParam(':L8', $Ligne8);
            $req->bindParam(':L9', $Ligne9);
            $req->execute();
            die("yes");
        }
    }

    function login(){
        if (isset($_POST['Email']) && isset($_POST['Password'])) {

            if ($_REQUEST["Email"] == "" || $_REQUEST["Password"] == "") {
                die("Empty");
            } else {
        
                $Email = $_REQUEST["Email"];
                $Password = $_REQUEST["Password"];

                require "connexionBase.php";
                $db = connexionBase();
            

                $sql = "SELECT Membre_ID, Mot_de_passe, Etat FROM `Membre` AS M WHERE M.Adresse_email = :mail";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':mail', $Email);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_OBJ);

            
                if ($user) {
                    
                    $status = $user->Etat;
                    $mdp = $user->Mot_de_passe;
                    $validPassword = password_verify($Password, $mdp);

                    if ($validPassword) {
                        if ($status == 0) {
                            die("Inactive");
                        } else {
                            $_SESSION["auth"] = "$Email";
                            die("Logged");
                        }
                    } else {
                        die("BadPassword");
                    }    

                
                }
                else {
                    die("NoUser");
                }
            }
        }
    }

    function logout() {
        $_SESSION = array();
        session_destroy();
        die("logoutok");
        header('Location: index.php');
    }

    function register() {

        if (isset($_POST['Username']) && isset($_POST['Password']) && isset($_POST['Email']) && isset($_POST['VPassword'])) {

            $Mail = $_REQUEST["Email"];
            $Username = $_REQUEST["Username"];
            $Password = $_REQUEST["Password"];
            $VPassword = $_REQUEST["VPassword"];

            $Cle = md5(microtime().rand());

            if ($Password === $VPassword) {

                $HashedP = password_hash($Password, PASSWORD_DEFAULT);
                
                require "connexionBase.php";
                $db = connexionBase();
        
                $sql = "SELECT `Membre_ID` FROM `Membre` AS M WHERE M.Adresse_email = :mail";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':mail', $Mail);
                $stmt->execute();
                $emailexist = $stmt->fetch(PDO::FETCH_OBJ);

                $sql2 = "SELECT `Membre_ID` FROM `Membre` AS M WHERE M.Identifiant = :user";
                $stmt2 = $db->prepare($sql2);
                $stmt2->bindParam(':user', $Username);
                $stmt2->execute();
                $userexist = $stmt2->fetch(PDO::FETCH_OBJ);
                

                if ($emailexist && $userexist) {
                    die("bothalreadyexist");
                } else if ($emailexist) {
                    die("mailalreadyexist");
                }else if ($userexist) {
                    die("useralreadyexist");
                } else {
                    // Créer le compte sans l'activer
                    $req = $db->prepare('INSERT INTO `Membre`(`Identifiant`, `Mot_de_passe`, `Adresse_email`, `Cle_de_verification`) VALUES (:user, :pass, :mail, :cle)');
                    $req->bindParam(':user', $Username);
                    $req->bindParam(':pass', $HashedP);
                    $req->bindParam(':mail', $Mail);
                    $req->bindParam(':cle', $Cle);
                    $req->execute();

                    // adresse MAIL OVH liée à l’hébergement.
                    $from  = "no-reply@tsimzuora.com";
                    ini_set("SMTP", "smtp.tsimzuora.com");   // Pour les hébergements mutualisés Windows de OVH
                
                    $JOUR  = date("Y-m-d");
                    $HEURE = date("H:i");
                    $Subject = "Verification de votre adresse email - $JOUR $HEURE.";
                
                    $mail_Data = "";
                    $mail_Data .= "<html> \n";
                    $mail_Data .= "<head> \n";
                    

                    $mail_Data .= "<title> [Tsimzuora] Verification de votre adresse email </title> \n";
                    $mail_Data .= "</head> \n";
                    $mail_Data .= "<body> \n";
                
                    $mail_Data .= "Tsimzuora.com : <b>$Subject </b> <br>";
                    $mail_Data .= "<br>";

                    $mail_Data .= " Bonjour $Username,";
                    $mail_Data .= "<br>";
                    $mail_Data .= "<br>";

                    $mail_Data .= " Ce mail vous a été envoyé suite à la demande de création de compte,vérifiez votre adresse email en cliquant ci-dessous pour finaliser la procédure.<br> \n";
                    $mail_Data .= "<br>\n";
                    $mail_Data .= " <a href='https://www.tsimzuora.com/compte/verification_compte.php?mail=$Mail&cle=$Cle'> https://www.tsimzuora.com/compte/verification_compte.php?mail=$Mail&cle=$Cle !</a> <br>\n";
                    $mail_Data .= "<br>\n";
                    $mail_Data .= "Si ce lien ne fonctionne pas, vous pouvez utiliser l'url ci-dessous : <br>\n";
                    $mail_Data .= "<br>\n";
                    $mail_Data .= "<a href='https://www.tsimzuora.com/compte/verification_compte.php'>https://www.tsimzuora.com/compte/verification_compte.php</a> <br> \n";
                    $mail_Data .= "<br>\n";
                    $mail_Data .= "avec les paramètres suivants : <br>\n";
                    $mail_Data .= "<br>\n";
                    $mail_Data .= " [Email] : $Mail <br>\n";
                    $mail_Data .= " [Cle] : $Cle <br>\n";
                    $mail_Data .= "<br>\n";

                    $mail_Data .= "</body> \n";
                    $mail_Data .= "</HTML> \n";
                
                    $headers  = "MIME-Version: 1.0 \n";
                    $headers .= "Content-type: text/html; charset=utf8 \n";
                    $headers .= "From: $from  \n";
                    $headers .= "Disposition-Notification-To: $from  \n";
                
                    // Message de Priorité haute
                    // -------------------------
                
                    $headers .= "X-Priority: 1  \n";
                    $headers .= "X-MSMail-Priority: High \n";
                    $CR_Mail = TRUE;
                    $to = $Mail;

                    $CR_Mail = @mail ($to, $Subject, $mail_Data, $headers);

                    if ($CR_Mail === FALSE) {
                        die("nsuccess");
                    }
                    else {
                        die("success");
                    }
                }
            } else {
                die("verifypassword");
            }
        }
    }


    function getquestion() {

        require "connexionBase.php";
        $db = connexionBase();
        
        $sqlall = "SELECT * FROM `QuizzQuestions`";
        $stmt = $db->prepare($sqlall);
        $stmt->execute();

        $questions = $stmt->fetchAll();
        
        echo(json_encode($questions));
    
    }

    function addquestion() {
        if (isset($_POST['Question']) && isset($_POST['Reponse']) && isset($_POST['Image'])) {

            $Question = $_REQUEST["Question"];
            $Reponse = $_REQUEST["Reponse"];
            $Image = $_REQUEST["Image"];

            require "connexionBase.php";
            $db = connexionBase();

            if ($Image == '') {
                $req = $db->prepare('INSERT INTO `QuizzQuestions`(`Question`, `Reponse`) VALUES (:Q, :R)');
                $req->bindParam(':Q', $Question);
                $req->bindParam(':R', $Reponse);
                $req->execute();
                die("yes");
            } else {
                $req = $db->prepare('INSERT INTO `QuizzQuestions`(`Question`, `Reponse`, `Image`) VALUES (:Q, :R, :I)');
                $req->bindParam(':Q', $Question);
                $req->bindParam(':R', $Reponse);
                $req->bindParam(':I', $Image);
                $req->execute();
                die("yes");
            }
        }
    }


    function modifquestion() {
        if (isset($_POST['ID']) && isset($_POST['Q']) && isset($_POST['R']) && isset($_POST['I'])) {

            $ID = $_REQUEST["ID"];
            $Question = $_REQUEST["Q"];
            $Reponse = $_REQUEST["R"];
            $Image = $_REQUEST["I"];

            require "connexionBase.php";
            $db = connexionBase();

            if ($Image == '') {
                $req = $db->prepare('UPDATE `QuizzQuestions` SET `Question`=:Q, `Reponse`=:R WHERE ID=:ID');
                $req->bindParam(':Q', $Question);
                $req->bindParam(':R', $Reponse);
                $req->bindParam(':ID', $ID);
                $req->execute();
                die("yes");
            } else {
                $req = $db->prepare('UPDATE `QuizzQuestions` SET `Question`=:Q, `Reponse`=:R, `Image`=:I WHERE ID=:ID');
                $req->bindParam(':Q', $Question);
                $req->bindParam(':R', $Reponse);
                $req->bindParam(':I', $Image);
                $req->bindParam(':ID', $ID);
                $req->execute();
                die("yes");
            }
        }
    }


    function delquestion() {
        if (isset($_POST['ID'])) {

            $ID = $_REQUEST["ID"];

            require "connexionBase.php";
            $db = connexionBase();

            $req = $db->prepare('DELETE FROM `QuizzQuestions` WHERE ID=:id');
            $req->bindParam(':id', $ID);
            $req->execute();
            die("yes");
        }
    }


    function allgrid() {

        require "connexionBase.php";
        $db = connexionBase();
        
        $sqlall = "SELECT * FROM `GrilleValide`";
        $stmt = $db->prepare($sqlall);
        $stmt->execute();
        $grille = $stmt->fetchAll();

        echo(json_encode($grille));

    }


?>