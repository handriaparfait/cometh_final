function create(nom_projet, date_rendu, adresse_proj) {

    $.ajax({
        type: "POST",
        url: 'Users/create',
        dataType: 'json',
        data: { 'nom_projet': nom_projet, 'date_rendu': date_rendu, 'adresse_proj': adresse_proj },
        success: function (data) {
            self.location.href = "users";
        },
        error: function (error) {
            self.location.href = "users";
        }


    });

};

function tache(nom_tache, duree, id_projet, priori) {
    $.ajax({
        type: "POST",
        url: 'Users/add',
        dataType: 'json',
        data: { 'nom_tache': nom_tache, 'duree': duree, 'priori': priori, 'id_projet': id_projet },
        success: function (data) {
            self.location.href = "users";
        },
        error: function (error) {
            self.location.href = "users";
        }


    });



};



function fichierprojet() {
    $(document).on('submit', '#fileUploadForm', function (e) {
        fichier = $('#file').prop('files')[0];
        id_projet = document.getElementById('recupid').value;
        var formData = new FormData();
        formData.append('file', fichier);
        formData.append('id_projet', id_projet);
        console.log(formData);
        $.ajax({
            type: "POST",
            url: 'Users/fichier_projet',
            dataType: 'json',
            processData: false,
            contentType: false, // <-- what to expect back from the PHP script, if anything
            data: formData,
            success: function (data) {
                console.log(data);
            },
            error: function (error) {
            }


        });
    });


}


function fichiertache() {
    $(document).on('submit', '#filetacheUploadForm', function (e) {
        fichier = $('#filetache').prop('files')[0];
        id_tache = document.getElementById('recupidtache').value;
        var formData = new FormData();
        formData.append('filetache', fichier);
        formData.append('id_tache', id_tache);
        console.log(formData);
        $.ajax({
            type: "POST",
            url: 'Users/fichier_tache',
            dataType: 'json',
            processData: false,
            contentType: false, // <-- what to expect back from the PHP script, if anything
            data: formData,
            success: function (data) {
                console.log(data);
            },
            error: function (error) {
            }


        });
    });


}

