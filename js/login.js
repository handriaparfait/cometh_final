function login(username, password) {
    //alert(username + " " + password);
    jQuery.ajax({
        url: 'Logins/login/' + username + '/' + password,
        contentType: 'application/json',
        success: function (response) {
            self.location.href = "users";
        },
        error: function (xhr) {
            alert("Mot de passe ou identifiant invalide");
        }
    });
}