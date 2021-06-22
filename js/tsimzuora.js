$(document).ready(function(){
    $('.login').click(function(){
        let Email = $('#Email').val();
        let Password = $('#Password').val();
        let Action = 'login';
        let ajaxurl = 'https://www.tsimzuora.com/lib/ajax.php',
        datax =  {'action': Action, 'Email': Email, 'Password': Password};
        $.post(ajaxurl, datax, function (data) {
            if (data == "Logged") {
                $("#SuccessLogin").slideDown(500).delay(2500).slideUp(900);
                setTimeout(() => {
                    window.location.href = "https://www.tsimzuora.com/";
                }, 3000);
            } else if (data == "Empty") {
                $("#Error").text("Vérifiez que tous les champs sont remplis.");
                $("#Error").slideDown(500).delay(2500).slideUp(900);
            } else if (data == "Inactive") {
                $("#Error").text("Vous devez activer votre compte via l'email qui vous à été envoyé.");
                $("#Error").slideDown(500).delay(2500).slideUp(900);
            } else if (data == "NoUser") {
                $("#Error").text("Aucun compte n'est lié à ce mail.");
                $("#Error").slideDown(500).delay(2500).slideUp(900);
            } else if (data == "BadPassword") {
                $("#Error").text("Mot de passe incorrect.");
                $("#Error").slideDown(500).delay(2500).slideUp(900);
            }
        });
    });
});

$(document).ready(function(){
    $('.logout').click(function(){
        let Action = 'logout';
        let ajaxurl = 'https://www.tsimzuora.com/lib/ajax.php',
        datax =  {'action': Action};
        $.post(ajaxurl, datax, function (data) {
            if (data == "logoutok") {
                window.location.href = "https://www.tsimzuora.com/";
            }
            else 
                $("#Lerror").slideDown(500).delay(2500).slideUp(900);
        });
    });
});


$(document).ready(function(){
    $('.register').click(function(){
        let Action = 'register';
        let ajaxurl = 'https://www.tsimzuora.com/lib/ajax.php';
        let Email = $('#Email').val();
        let Username = $('#Username').val();
        let Password = $('#Password').val();
        let VPassword = $('#VPassword').val();
        let datax =  {'action': Action, 'Email': Email, 'Password': Password, 'VPassword': VPassword, 'Username': Username};
        $.post(ajaxurl, datax, function (data) {
            if (data == "success") {
                $("#SuccessRegister").slideDown(500).delay(2500).slideUp(900);
                setTimeout(() => {
                    window.location.href = "https://www.tsimzuora.com/";
                }, 3000);
            } else  if (data == "bothalreadyexist") {
                $("#Error").text("Cet email et cet utilisateur sont déjà enregistrés.")
                $("#Error").slideDown(500).delay(2500).slideUp(900);
            } else  if (data == "mailalreadyexist") {
                $("#Error").text("Cet email est déjà enregistré.");
                $("#Error").slideDown(500).delay(2500).slideUp(900);
            } else if (data == "useralreadyexist") { 
                $("#Error").text("Cet utilisateur est déjà enregistré.");
                $("#Error").slideDown(500).delay(2500).slideUp(900);
            } else if (data == "verifypassword"){
                $("#Error").text("La comfirmation du mdp doit être similaire au mdp.");
                $("#Error").slideDown(500).delay(2500).slideUp(900);
            }    
        });
    });
});