function login(username, password) {
    //alert(username + " " + password);
    jQuery.ajax({
        url: 'Logins/login/' + username + '/' + password,
        contentType: 'application/json',
        success: function (response) {
            self.location.href = "users";
        },
        error: function (xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Connection échouée',
                text: 'Identifiant inconnu ou mot de passe invalide',
              });
        }
    });
}

function deconnexion(){
    jQuery.ajax({
        url: 'Logins/deconnexion',
        contentType: 'application/json',
        success: function (response) {
            self.location.href = "/cometh/";
        },
        error: function (xhr) {
            //Afficher swal
            Swal.fire({
                icon: 'error',
                title: 'Deconnexion échouée',
                text: 'Erreur lors de la tentative de deconnexion',
              });
        }
    });
}

function signIn(){
    
}
