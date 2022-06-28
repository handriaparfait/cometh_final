function login(username, password) {
    alert(username + " " + password);
    $.ajax({
        type: 'GET',
        url: 'Logins/login/' + username + '/' + password,
        dataType: 'json',
        complete: function (xhr) {
            if (xhr.status == 200)
                self.location.href = "users";
            else if (xhr.status == 401)
                alert("Connexion error !");
        }
    });
}