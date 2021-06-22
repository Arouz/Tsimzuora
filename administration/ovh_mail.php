<?php

    session_start();
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'sendmail':
                SendMail();
                break;

            default : 
                die($_POST['action']);
                break;
        }
    }

    function SendMail() {
        if (isset($_POST['sujet']) && isset($_POST['message']) && isset($_POST['niveau'])) {
            
            $mess = $_POST['message'];
            $suj = $_POST['sujet'];
            $niv = $_POST['niveau'];

            // adresse MAIL OVH liée à l’hébergement.
            $from  = "no-reply@tsimzuora.com";
            ini_set("SMTP", "smtp.tsimzuora.com");   // Pour les hébergements mutualisés Windows de OVH
        
            // *** Laisser tel quel
            $JOUR  = date("Y-m-d");
            $HEURE = date("H:i");
            $Subject = "$suj - $JOUR $HEURE";
        
            $mail_Data = "";
            $mail_Data .= "<html> \n";
            $mail_Data .= "<head> \n";
            $mail_Data .= "<title> $suj </title> \n";
            $mail_Data .= "</head> \n";
            $mail_Data .= "<body> \n";
        
            $mail_Data .= "Newsletter Tsimzuora.com  : <b>$Subject </b> <br> \n";
            $mail_Data .= "<br> \n";
            $mail_Data .= "$mess <br> \n";
            $mail_Data .= "</body> \n";
            $mail_Data .= "</HTML> \n";
        
            $headers  = "MIME-Version: 1.0 \n";
            $headers .= "Content-type: text/html; charset=iso-8859-1 \n";
            $headers .= "From: $from  \n";
            $headers .= "Disposition-Notification-To: $from  \n";
        
            // Message de Priorité haute
            // -------------------------
        
            $headers .= "X-Priority: 1  \n";
            $headers .= "X-MSMail-Priority: High \n";
            $CR_Mail = TRUE;


            require "../lib/connexionBase.php";
            $db = connexionBase();
        
            if ($niv == '4') {
                $str_requete = "SELECT `Adresse_email` FROM `Membre`";
            } else {
                $str_requete = "SELECT `Adresse_email` FROM `Membre` AS M WHERE M.Niveau='$niv'"; 
            }
            
            $result = $db->query($str_requete);
            $compteur = $result->rowCount();
        
            
            if ($compteur >= 1) {
                //$to    = "arouzmist@tsimzuora.com, cointe.remi@gmail.com, cointe.remig@gmail.com";
                while ($admail = $result->fetch(PDO::FETCH_OBJ)) {
                    $to = $admail->Adresse_email;
                    $CR_Mail = @mail ($to, $Subject, $mail_Data, $headers);
                }
            }
    
            if ($CR_Mail === FALSE) {
                die("nsuccess");
            }
            else {
                die("success");
            }

        }
    }
    
   
?>