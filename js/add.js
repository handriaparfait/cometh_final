function tache(nom_tache, duree,id_projet, priori) {
    $.ajax({
        type : "POST",
        url: 'Users/add',
        dataType:'json',
        data: {'nom_tache': nom_tache, 'duree' : duree, 'id_projet' : id_projet, 'priori': priori,},
        success: function (data) {
            self.location.href = "users";
        },
        error: function (error) {
            self.location.href = "users";
        }
        
        
    });

    
    
}



