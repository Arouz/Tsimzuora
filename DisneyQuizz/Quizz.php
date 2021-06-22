<?php

// clé API du Bot à modifier
define('TOKEN', '848689743:AAEvO5aX734IHiYVOa8XmJpVsTlH75teaUc');
// Info BDD
require "../lib/connexionBase.php";

// récupération des données envoyées par Telegram
$content = file_get_contents('php://input');
$update = json_decode($content, true);

$Id_du_chat = $update['message']['chat']['id'];
$Nom_du_joueur = $update['message']['from']['first_name'];
$Pseudo_du_joueur = $update['message']['from']['username'];
$Id_du_joueur = $update['message']['from']['id'];
$Message = $update['message']['text'];

/////////////////////////////
// Fichier de log

$ToLogFile = $Id_du_chat . ' / ' . $Id_du_joueur . ' / ' . $Pseudo_du_joueur . ' / ' . $Nom_du_joueur . ' : ' . $Message;
$log_filename = "log";
if (!file_exists($log_filename)) 
{
    // create directory/folder uploads.
    mkdir($log_filename, 0777, true);
}
$log_file_data = $log_filename.'/log_' . date('d-M-Y') . '.log';
// if you don't add `FILE_APPEND`, the file will be erased each time you add a log
file_put_contents($log_file_data, $ToLogFile . "\n", FILE_APPEND);

//
/////////////////////////////

function sendMessage($chat_id, $text) {
    $texte = '*'.$text.'*';
    $emoticons = "\ud83d\udda5\ufe0f";
    $q = http_build_query([
        'chat_id' => $chat_id,
        'text' => json_decode('"'.$emoticons.'"').' '.$texte.' '.json_decode('"'.$emoticons.'"')
        ]);
    file_get_contents('https://api.telegram.org/bot'.TOKEN.'/sendMessage?parse_mode=markdown&'.$q);
}

function sendPhoto($chat_id, $photo){
    file_get_contents('https://api.telegram.org/bot'.TOKEN.'/sendPhoto?chat_id='.$chat_id.'&photo='.$photo);
}

function sendVideo($chat_id, $video){
    file_get_contents('https://api.telegram.org/bot'.TOKEN.'/sendPhoto?chat_id='.$chat_id.'&video='.$video);
}

/// Commande du quizz

// l'utilisateur crée le quizz
if(preg_match('/^\/qcreate/', $Message)) {
    //sendMessage($Id_du_chat, $Pseudo_du_joueur . $Round_max . $Id_du_chat); 
    $Round_max = preg_replace('/^\/qcreate /', '', $Message);
    if ($Round_max > 50){
        $Round_max = 50;
        sendMessage($Id_du_chat, 'Maximum round is 50 !');
    }
    CreateQuizz($Id_du_chat, $Pseudo_du_joueur, $Round_max, $Id_du_joueur, $Nom_du_joueur);
}
// l'utilisateur lance le quizz
else if(preg_match('/^\/qgo/', $Message)) {
    StartQuizz($Id_du_chat);
}
// l'utilisateur arrete le quizz
else if(preg_match('/^\/qstop/', $Message)) {
    EndQuizz($Id_du_chat);
}
// l'utilisateur se déclare joueur
else if(preg_match('/^\/qup/', $Message)) {
    AddPlayer($Id_du_chat, $Pseudo_du_joueur, $Id_du_joueur, $Nom_du_joueur);
}
else if(preg_match('/^\/qinfo/', $Message)) {
    information($Id_du_chat);
}
else if(preg_match('/^\/qrank/', $Message)) {
    ranking($Id_du_chat);
}
else {
    Outoftry($Id_du_chat, $Pseudo_du_joueur, $Id_du_joueur, $Nom_du_joueur, $Message);
}


function CreateQuizz($Id_du_chat, $Pseudo_du_joueur, $Round_max, $Id_du_joueur, $Nom_du_joueur) {

    $db = connexionBase();

    // Selectionne la question avec l'id tirée au hasard
    $str_requete = "SELECT * FROM `QuizzParties` WHERE IDR='$Id_du_chat'";
    // Execute la requete
    $result = $db->query($str_requete);
    $compteur = $result->rowCount();
    
    if ($compteur >= 1){
        sendMessage($Id_du_chat, 'The game has already started.'); 
    } else {

        if ($Round_max < 1) {
            $Round_max = 10;
        }

        $IDR = $Id_du_chat;
        $NDR = 1;
        $RM = $Round_max;

        $reqp = $db->prepare('INSERT INTO `QuizzParties`(`IDR`, `NDR`, `RM`) VALUES (:IDR, :NDR, :RM)');
        $reqp->bindParam(':IDR', $Id_du_chat);
        $reqp->bindParam(':NDR', $NDR);
        $reqp->bindParam(':RM', $RM);
        $reqp->execute();

        $reqj = $db->prepare('INSERT INTO `QuizzJoueurs`(`ID_du_joueur`, `Nom_du_joueur`, `ID_de_la_partie`) VALUES (:IDJ, :NDJ, :IDR)');
        $reqj->bindParam(':IDJ', $Id_du_joueur);

        if ($Pseudo_du_joueur == '')
            $reqj->bindParam(':NDJ', $Nom_du_joueur);
        else 
            $reqj->bindParam(':NDJ', $Pseudo_du_joueur);
        
        $reqj->bindParam(':IDR', $Id_du_chat);
        $reqj->execute();
        
        $req2 = $db->prepare('INSERT INTO `QuizzEnCours`(`IDR`) VALUES (:IDR)');
        $req2->bindParam(':IDR', $Id_du_chat);
        $req2->execute();

        sendMessage($Id_du_chat, 'The game has been created with success.'); 
    }
}

function StartQuizz($Id_du_chat){
    
    $db = connexionBase();
    // Obtient le nombre de question disponible dans la base de données
    $str_requete = "SELECT * FROM `QuizzQuestions`";
    $result = $db->query($str_requete);
    $NombreQuestion = $result->rowCount();
    $AQuestions = $result->fetchAll();

    $Question_deja_tombe = "SELECT * FROM `QuizzParties` WHERE IDR = :idr";
    $qdtq = $db->prepare($Question_deja_tombe);
    $qdtq->bindParam(':idr', $Id_du_chat);
    $qdtq->execute();
    $qdtr = $qdtq->fetch(PDO::FETCH_OBJ);

    
    if ($qdtr){
        $QDT = $qdtr->QDT;
        $NDR = $qdtr->NDR;
        $RM = $qdtr->RM;

        //Vérifie le nombre de round restant
        if ($NDR < $RM) {

            $QDTArray = preg_split ("/\,/", $QDT);  
            $TailleTableau = sizeof($QDTArray);

            if ($TailleTableau <= $NombreQuestion) {
                
                $invalide = true;
                while ($invalide) {
                    // Choisi un numero entre 1 et le max de question
                    $NumeroQuestion = (rand(1, $NombreQuestion));
                    $invalide = false;
                    for ($i=0; $i < $TailleTableau; $i++) { 
                        if($AQuestions[$NumeroQuestion]['ID'] == $QDTArray[$i]){
                            $invalide = true;
                        }
                    }
                }

                // Ajoute le numéro de la nouvelle question à la liste des questions déjà tombées
                $QDT .=  $AQuestions[$NumeroQuestion]['ID'].",";
                $NDR+=1;
                // Modifie la table comportant les qdt
                $QDTR = 'UPDATE `QuizzParties` SET `QDT`=:QDT, `NDR`=:NDR WHERE IDR=:IDR';
                $qdti = $db->prepare($QDTR);
                $qdti->bindParam(':IDR', $Id_du_chat);
                $qdti->bindParam(':QDT', $QDT);
                $qdti->bindParam(':NDR', $NDR);
                $qdti->execute();

                $Q = $AQuestions[$NumeroQuestion]['Question'];
                $R = $AQuestions[$NumeroQuestion]['Reponse'];
                $P = $AQuestions[$NumeroQuestion]['Image'];
                
                $emoteQ = "\u2753";
                
                sendMessage($Id_du_chat, json_decode('"'.$emoteQ.'"').$Q.json_decode('"'.$emoteQ.'"'));

                if ($P != "")
                    sendPhoto($Id_du_chat, $P);


                // Met à jour la table quizzencours avec la question sélectionnée
                $QECU = 'UPDATE `QuizzEnCours` SET `Question`=:Q, `Reponse`=:R WHERE IDR=:IDR';
                $qecur = $db->prepare($QECU);
                $qecur->bindParam(':IDR', $Id_du_chat);
                $qecur->bindParam(':Q', $Q);
                $qecur->bindParam(':R', $R);
                $qecur->execute();

            } else {
                $str_requete = "SELECT * FROM `QuizzParties` WHERE IDR='$Id_du_chat'";
                // Execute la requete
                $result = $db->query($str_requete);
                $compteur = $result->rowCount();
            
                $str_requete2 = "SELECT * FROM `QuizzEnCours` WHERE IDR='$Id_du_chat'";
                // Execute la requete
                $result2 = $db->query($str_requete2);
                $compteur2 = $result2->rowCount();
            
                if ($compteur >= 1 && $compteur2 >= 1){
            
                    $req2 = $db->prepare("DELETE FROM `QuizzEnCours` WHERE IDR=:IDR");
                    $req2->bindParam(':IDR', $Id_du_chat);
                    $req2->execute();

                    $delplayer = $db->prepare("DELETE FROM `QuizzJoueurs` WHERE ID_de_la_partie=:IDLP");
                    $delplayer->bindParam(':IDLP', $Id_du_chat);
                    $delplayer->execute(); 

                    $req = $db->prepare("DELETE FROM `QuizzParties` WHERE IDR=:IDR");
                    $req->bindParam(':IDR', $Id_du_chat);
                    $req->execute();
            
                    sendMessage($Id_du_chat, "All the questions were given, the game is over.");
                } else {
                    sendMessage($Id_du_chat, 'No on-going game.');
                }
            }
        } else {

            $Joueurs = "SELECT * FROM `QuizzJoueurs` WHERE ID_de_la_partie=:IDP";
            $JW = $db->prepare($Joueurs);
            $JW->bindParam(':IDP', $Id_du_chat);
            $JW->execute();
            $AllPlayer = $JW->fetchAll();
        
            $NbJoueurs = count($AllPlayer);
            $MaxPoints = 0;
        
            for ($i=0; $i < $NbJoueurs; $i++) { 
                if ($AllPlayer[$i]['Point_du_joueur'] > $MaxPoints) {
                    $Winner = $AllPlayer[$i]['Nom_du_joueur'];
                    $MaxPoints = $AllPlayer[$i]['Point_du_joueur'];
                }
                sendMessage($Id_du_chat, $AllPlayer[$i]['Nom_du_joueur'] . ' : '. $AllPlayer[$i]['Point_du_joueur'] . ' points !');
            }

            $EmoteWinner = "\ud83e\udd47";
            // Annonce le vainqueur et son nombre de points
            sendMessage($Id_du_chat, json_decode('"'.$EmoteWinner.'"').'The winner is '. $Winner . ' with '. $MaxPoints . ' points !');

            // Supprime la partie de la base de données
            $str_requete = "SELECT * FROM `QuizzParties` WHERE IDR='$Id_du_chat'";
            // Execute la requete
            $result = $db->query($str_requete);
            $compteur = $result->rowCount();
        
            $str_requete2 = "SELECT * FROM `QuizzEnCours` WHERE IDR='$Id_du_chat'";
            // Execute la requete
            $result2 = $db->query($str_requete2);
            $compteur2 = $result2->rowCount();
        
            if ($compteur >= 1 && $compteur2 >= 1){
        
                $req2 = $db->prepare("DELETE FROM `QuizzEnCours` WHERE IDR=:IDR");
                $req2->bindParam(':IDR', $Id_du_chat);
                $req2->execute();

                $delplayer = $db->prepare("DELETE FROM `QuizzJoueurs` WHERE ID_de_la_partie=:IDLP");
                $delplayer->bindParam(':IDLP', $Id_du_chat);
                $delplayer->execute(); 

                $req = $db->prepare("DELETE FROM `QuizzParties` WHERE IDR=:IDR");
                $req->bindParam(':IDR', $Id_du_chat);
                $req->execute();
        
                sendMessage($Id_du_chat, "Game successfully complete.");
            } else {
                sendMessage($Id_du_chat, 'No on-going game.');
            }

        }
        
    } else {
        sendMessage($Id_du_chat, 'No game linked to this group has been found.'); 
    }
}

// Mise à jour
function EndQuizz($Id_du_chat) {

    $db = connexionBase();

    $str_requete = "SELECT * FROM `QuizzParties` WHERE IDR='$Id_du_chat'";
    // Execute la requete
    $result = $db->query($str_requete);
    $compteur = $result->rowCount();

    $str_requete2 = "SELECT * FROM `QuizzEnCours` WHERE IDR='$Id_du_chat'";
    // Execute la requete
    $result2 = $db->query($str_requete2);
    $compteur2 = $result2->rowCount();

    if ($compteur >= 1 && $compteur2 >= 1){

        $req2 = $db->prepare("DELETE FROM `QuizzEnCours` WHERE IDR=:IDR");
        $req2->bindParam(':IDR', $Id_du_chat);
        $req2->execute();

        $delplayer = $db->prepare("DELETE FROM `QuizzJoueurs` WHERE ID_de_la_partie=:IDLP");
        $delplayer->bindParam(':IDLP', $Id_du_chat);
        $delplayer->execute(); 

        $req = $db->prepare("DELETE FROM `QuizzParties` WHERE IDR=:IDR");
        $req->bindParam(':IDR', $Id_du_chat);
        $req->execute();

        sendMessage($Id_du_chat, 'Game over.');

    } else if ($compteur >= 1){

        $delplayer = $db->prepare("DELETE FROM `QuizzJoueurs` WHERE ID_de_la_partie=:IDLP");
        $delplayer->bindParam(':IDLP', $Id_du_chat);
        $delplayer->execute(); 

        $req = $db->prepare("DELETE FROM `QuizzParties` WHERE IDR=:IDR");
        $req->bindParam(':IDR', $Id_du_chat);
        $req->execute();

        sendMessage($Id_du_chat, 'Game over.');

    } else if ($compteur2 >= 1){

        $req2 = $db->prepare("DELETE FROM `QuizzEnCours` WHERE IDR=:IDR");
        $req2->bindParam(':IDR', $Id_du_chat);
        $req2->execute();

        $delplayer = $db->prepare("DELETE FROM `QuizzJoueurs` WHERE ID_de_la_partie=:IDLP");
        $delplayer->bindParam(':IDLP', $Id_du_chat);
        $delplayer->execute(); 

        sendMessage($Id_du_chat, 'Game over.');
    } else {
        sendMessage($Id_du_chat, 'No on-going game.');
    }
}

// Mise à jour
function AddPlayer($Id_du_chat, $Pseudo_du_joueur, $Id_du_joueur, $Nom_du_joueur) {

    $db = connexionBase();

    $str_requete = "SELECT * FROM `QuizzJoueurs` WHERE ID_de_la_partie = :idr AND ID_du_joueur = :idj";
    $stmt = $db->prepare($str_requete);
    $stmt->bindParam(':idr', $Id_du_chat);
    $stmt->bindParam(':idj', $Id_du_joueur);
    $stmt->execute();
    $stmtp = $stmt->fetch(PDO::FETCH_OBJ);

    if ($stmtp){

        sendMessage($Id_du_chat, 'Impossible sign in.');

    } else {

        $stmt1 = $db->prepare('INSERT INTO `QuizzJoueurs`(`ID_du_joueur`, `Nom_du_joueur`, `ID_de_la_partie`) VALUES (:IDJ, :NDJ, :IDR)');
        $stmt1->bindParam(':IDJ', $Id_du_joueur);

        if ($Pseudo_du_joueur == '')
            $stmt1->bindParam(':NDJ', $Nom_du_joueur);
        else 
            $stmt1->bindParam(':NDJ', $Pseudo_du_joueur);

        $stmt1->bindParam(':IDR', $Id_du_chat);
        $stmt1->execute();
        sendMessage($Id_du_chat, 'Successful registration.');

    }
}

function Reponse($Id_du_chat, $Message, $Pseudo_du_joueur, $Id_du_joueur, $Nom_du_joueur) {

    $db = connexionBase();

    if ($Pseudo_du_joueur == '')
        $NmduJoueur = $Nom_du_joueur;
    else 
        $NmduJoueur = $Pseudo_du_joueur;

    $Quizzencours = "SELECT * FROM `QuizzEnCours` WHERE IDR = :idr";
    $qdtqe = $db->prepare($Quizzencours);
    $qdtqe->bindParam(':idr', $Id_du_chat);
    $qdtqe->execute();
    $QuestionReponse = $qdtqe->fetch(PDO::FETCH_OBJ);

    if ($QuestionReponse) {
    
        $Rep = $QuestionReponse->Reponse;
        ////////////////////////////////////////////////////////////////////////
        // Modifier la façon dont sont verifier les réponses

        // Methode basique avec 25% de marge d'erreur si le mot a au moins 7 caractères 
        ////////////////////////////////////
        $RepArray = preg_split ("/\,/", $Rep);  
        $TailleTableauRep = sizeof($RepArray);
        $Bonnerep = false;

        // Si la réponse du joueur correspond à 75% de la bonne réponse alors le point lui est accordé
        for ($i=0; $i < $TailleTableauRep; $i++) { 
            $Reps = strtolower($RepArray[$i]);
            $Mess = strtolower($Message);
            similar_text($Mess, $Reps, $pourcent);
            if ($Mess == $Reps)
                $Bonnerep = true;   
            else if ($pourcent > 75 && count($Reps) > 6)
                $Bonnerep = true;
        }

        // Methode avancée sans marge d'erreur
        if ($Bonnerep == false) {

            ////////////////////////////////////
            $MultiBReponse = preg_split ("/\,/", $Rep); // Réponse simple
            $TTBRM = sizeof($MultiBReponse);

            if ($TTBRM == 0)
                array_push($MultiBReponse, $Rep);
            
            $TTBRM = sizeof($MultiBReponse);

            $MultiReponseEspace = preg_split ("/\s+/", $Message);
            $TTMRE = sizeof($MultiReponseEspace);

            $MultiReponseVirgule = preg_split ("/\,/", $Message);  
            $TTMRV = sizeof($MultiReponseVirgule);

            $Similarite = 0;

            // Si les tableaux ont plus de deux réponses
            if ($TTMRE > 0 || $TTMRV > 0){
                for ($l=0; $l < $TTBRM; $l++) { 
                    $ToSplit = $MultiBReponse[$l];

                    $ReponseParEspace = preg_split ("/\s+/", $ToSplit);
                    $TTBR = sizeof($ReponseParEspace);

                    // Si le tableau de bonne réponse avec espace est plus grand que celui des virgules 
                    if ($TTMRE > $TTMRV) 
                        $TTM = $TTMRE;
                    else 
                        $TTM = $TTMRV;
                    

                    for ($i=0; $i < $TTM; $i++) { 
                        for ($j=0; $j < $TTBR ; $j++) { 
                            //$MRE = strtolower(preg_replace('/\s+/', '', $MultiReponseEspace[$i]));

                            if ($TTMRE > $TTMRV)
                                $MR = strtolower(preg_replace('/\s+/', '', $MultiReponseEspace[$i]));
                            else 
                                $MR = strtolower(preg_replace('/\s+/', '', $MultiReponseVirgule[$i]));

                            $MBR = strtolower(preg_replace('/\s+/', '', $ReponseParEspace[$j]));

                            if ($MR == $MBR) {

                                // Si la partie de réponse est valide alors on augmente le nombre de similarité qui si elle atteint le nombre de réponse attendu accorde le point au joueur
                                $Similarite+=1;

                                // Obtient les informations liées au joueur
                                $Rreponse_du_joueur = "SELECT * FROM `QuizzJoueurs` WHERE ID_du_joueur=:IDJ AND ID_de_la_partie=:IDP";
                                $Rrdj = $db->prepare($Rreponse_du_joueur);
                                $Rrdj->bindParam(':IDJ', $Id_du_joueur);
                                $Rrdj->bindParam(':IDP', $Id_du_chat);
                                $Rrdj->execute();
                                $IRrdj = $Rrdj->fetch(PDO::FETCH_OBJ);
                        
                                // Obtient la chaine de bonne réponse du joueur via l'objet reçu par la requete
                                $Allrep = $IRrdj->Reponse_du_joueur;

                                // Créer un tableau correspondant à la chaine de bonne réponse du joueur
                                $Array_Reponse_du_joueur = preg_split ("/\,/", $Allrep);  
                                
                                
                                $SARDJ = sizeof($Array_Reponse_du_joueur);
                                $Dejadanslesreponses = false;

                                //$key = array_search('green', $array); // $key = 2;
                                //$ChaineRep .= $Array_Reponse_du_joueur[$k].',';
                                if ($SARDJ > 0) {

                                    for ($k=0; $k < $SARDJ; $k++) { 
                                        if ($Array_Reponse_du_joueur[$k] != '')
                                            $ChaineRep .= $Array_Reponse_du_joueur[$k].',';
                                    }

                                    // Vérifie que la partie de réponse valide n'est pas déjà dans la base de données 
                                    $key = array_search($MR, $Array_Reponse_du_joueur);
                                    if ($key != false){
                                        $Dejadanslesreponses = true;
                                    }
                                }


                                // Si la partie de réponse n'est pas déjà enregistré dans la base de données
                                if ($Dejadanslesreponses == false){
                                    $ListeRep = $ChaineRep.$MR;
                                    $TPRu = $db->prepare('UPDATE `QuizzJoueurs` SET `Reponse_du_joueur`=:RDJ WHERE ID_du_joueur=:IDJ AND ID_de_la_partie=:IDP');
                                    $TPRu->bindParam(':RDJ', $ListeRep);
                                    $TPRu->bindParam(':IDJ', $Id_du_joueur);
                                    $TPRu->bindParam(':IDP', $Id_du_chat);
                                    $TPRu->execute();
                                }
                                $ChaineRep = '';
                            }
                        }
                    }

                    if ($Similarite >= $TTBR && $TTBR > 1) {
                        $Bonnerep = true;
                    } else {
                        // vérifie si la chaine de reponse du joueur correspond à celle des bonnes réponses
                        $VerifValide = "SELECT * FROM `QuizzJoueurs` WHERE ID_du_joueur=:IDJ AND ID_de_la_partie=:IDP";
                        $Rvv = $db->prepare($VerifValide);
                        $Rvv->bindParam(':IDJ', $Id_du_joueur);
                        $Rvv->bindParam(':IDP', $Id_du_chat);
                        $Rvv->execute();
                        $IRvv = $Rvv->fetch(PDO::FETCH_OBJ);
                
                        $ARdj = $IRvv->Reponse_du_joueur;
                        $Array_Reponse_du_joueur = preg_split ("/\,/", $ARdj);  

                        $TTARDJ = sizeof($Array_Reponse_du_joueur);
                        $Similarite = 0;

                        for ($i=0; $i < $TTARDJ; $i++) { 
                            for ($j=0; $j < $TTBR ; $j++) { 
                                $ARDJ = strtolower(preg_replace('/\s+/', '', $Array_Reponse_du_joueur[$i]));
                                $AMBR = strtolower(preg_replace('/\s+/', '', $ReponseParEspace[$j]));
                                if ($ARDJ == $AMBR) {
                                    $Similarite+=1;
                                }
                            }
                        }

                        if ($Similarite >= $TTBR && $TTBR > 1) {
                            $Bonnerep = true;
                        }
                    }
                }
            }
        }
        ////////////////////////////////////////////////////////////////////////
        // Accorde le point au joueur 
        // JBR = JoueurBonneReponse ; IJBR = InfoJoueurBonneReponse ; JBRP JoueurBonneReponsePoint
        $JoueurBR = "SELECT * FROM `QuizzJoueurs` WHERE ID_du_joueur=:IDJ AND ID_de_la_partie=:IDP";
        $JBR = $db->prepare($JoueurBR);
        $JBR->bindParam(':IDJ', $Id_du_joueur);
        $JBR->bindParam(':IDP', $Id_du_chat);
        $JBR->execute();
        $IJBR = $JBR->fetch(PDO::FETCH_OBJ);

        $JNBT = intval($IJBR->Try_du_joueur);

        if ($Bonnerep && $JNBT > 0){

            // Reset les try
            ResetTry($Id_du_chat);
            //
            
            $EmoteGG = "\u2705";

            sendMessage($Id_du_chat, json_decode('"'.$EmoteGG.'"').' Good answer '.$NmduJoueur.' ! '.json_decode('"'.$EmoteGG.'"'));

            $JBRP = intval($IJBR->Point_du_joueur);
            $JBRP+=1;

            // Met à jour la table quizzencours avec la question sélectionnée
            $APJR = 'UPDATE `QuizzJoueurs` SET `Point_du_joueur`=:PDJ WHERE ID_du_joueur=:IDJ AND ID_de_la_partie=:IDP';
            $APJ = $db->prepare($APJR);
            $APJ->bindParam(':PDJ', $JBRP);
            $APJ->bindParam(':IDJ', $Id_du_joueur);
            $APJ->bindParam(':IDP', $Id_du_chat);
            $APJ->execute();

            /////// QSTART
            StartQuizz($Id_du_chat);


        } else if ($JNBT > 0) {

            $JNBT-=1;
            // try_du_joueur - 1

            // Met à jour la table quizzencours avec la question sélectionnée
            $TDJR = 'UPDATE `QuizzJoueurs` SET `Try_du_joueur`=:TDJ WHERE ID_du_joueur=:IDJ AND ID_de_la_partie=:IDP';
            $TDJ = $db->prepare($TDJR);
            $TDJ->bindParam(':TDJ', $JNBT);
            $TDJ->bindParam(':IDJ', $Id_du_joueur);
            $TDJ->bindParam(':IDP', $Id_du_chat);
            $TDJ->execute();
            
        }
    } 
}

function ranking($Id_du_chat){

    $db = connexionBase();

    $rank = $db->prepare("SELECT * FROM `QuizzJoueurs` WHERE ID_de_la_partie=:IDP");
    $rank->bindParam(':IDP', $Id_du_chat);
    $rank->execute();
    $rankp = $rank->fetchAll();
    
    $NbJoueurs = count($rankp);

    if ($NbJoueurs > 0){
        for ($i=0; $i < $NbJoueurs; $i++) { 
            sendMessage($Id_du_chat, $rankp[$i]['Nom_du_joueur'] . ' : '. $rankp[$i]['Point_du_joueur'] . ' points !');
        }
    } else {
        sendMessage($Id_du_chat, 'No game linked to this group has been found.');
    }
}


function information($Id_du_chat){
    sendMessage($Id_du_chat, ' /qcreate [NumberofRound] (without the parenthesis) to create a game.');
    sendMessage($Id_du_chat, ' /qup to sign in (except for the creator of the game).');
    sendMessage($Id_du_chat, ' /qgo to start the quizz or to skip a question.');
    sendMessage($Id_du_chat, ' /qstop to stop a round.');
    sendMessage($Id_du_chat, ' /qrank to show the ranking during the ongoing game.');
}

function Outoftry($Id_du_chat, $Pseudo_du_joueur, $Id_du_joueur, $Nom_du_joueur, $Message) {
    
    $db = connexionBase();

    $oot = $db->prepare("SELECT * FROM `QuizzJoueurs` WHERE ID_de_la_partie=:IDP");
    $oot->bindParam(':IDP', $Id_du_chat);
    $oot->execute();
    $ootp = $oot->fetchAll();
    
    $JoueurSansTry = 0;

    $NbJoueurs = count($ootp);

    if ($NbJoueurs > 0){
        for ($i=0; $i < $NbJoueurs; $i++) { 
            if ($ootp[$i]['Try_du_joueur'] == 0)
                $JoueurSansTry +=1;
        }
        if ($JoueurSansTry == $NbJoueurs){
            StartQuizz($Id_du_chat);
        } else {
            Reponse($Id_du_chat, $Message, $Pseudo_du_joueur, $Id_du_joueur, $Nom_du_joueur);
        }
    }

}

function ResetTry($Id_du_chat){

    $db = connexionBase();
    $TPR = $db->prepare("SELECT * FROM `QuizzJoueurs` WHERE ID_de_la_partie=:IDP");
    $TPR->bindParam(':IDP', $Id_du_chat);
    $TPR->execute();
    $TPRp = $TPR->fetchAll();
    $try5 = 5;
    $NbJoueurs = count($TPRp);

    if ($NbJoueurs > 0){
        for ($i=0; $i < $NbJoueurs; $i++) { 
            $idjoueur = $TPRp[$i]['ID_du_joueur'];
            $TPRu = $db->prepare('UPDATE `QuizzJoueurs` SET `Try_du_joueur`=:TDJ, `Reponse_du_joueur`=null WHERE ID_du_joueur=:IDJ AND ID_de_la_partie=:IDP');
            $TPRu->bindParam(':TDJ', $try5);
            $TPRu->bindParam(':IDJ', $idjoueur);
            $TPRu->bindParam(':IDP', $Id_du_chat);
            $TPRu->execute();
        }
    }
}

?>