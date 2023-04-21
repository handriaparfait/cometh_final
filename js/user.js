/*
let sidebar = document.querySelector(".sidebar");
sidebar.classList.toggle("open");
let closeBtn = document.querySelector("#btn");
let searchBtn = document.querySelector(".bx-search");

closeBtn.addEventListener("click", () => {
    sidebar.classList.toggle("open");
    menuBtnChange();
});
*/


function menuBtnChange() {
    if (sidebar.classList.contains("open")) {
        document.getElementsByTagName('body')[0].style.marginLeft = "12%";
    } else {
        document.getElementsByTagName('body')[0].style.marginLeft = "5%";
    }
}

function startPlanning(idp) {
    jQuery.ajax({
        url: 'Users/startPlanning/' + idp,
        contentType: 'application/json',
        success: function (response) {
            //alert("Planning commencé");
            self.location.reload();
            /*Disable all other button*/
            const buttons = document.querySelectorAll(".buttonStartPlan");
            buttons.forEach(btn => btn.style.display = "none");
        },
        error: function (xhr) {
            alert("Erreur commencement planning");
        }
    });
}

function pausePlanning(idp) {
    jQuery.ajax({
        url: 'Users/pausePlanning/' + idp,
        contentType: 'application/json',
        success: function (response) {
            //alert("Planning en pause");
            self.location.reload();
            /*Disable all other button*/
            const buttons = document.querySelectorAll(".buttonStartPlan");
            buttons.forEach(btn => btn.style.display = "none");
        },
        error: function (xhr) {
            alert("Erreur commencement planning");
        }
    });
}

function endPlanning(idp) {
    jQuery.ajax({
        url: 'Users/endPlanning/' + idp,
        contentType: 'application/json',
        success: function (response) {
            //alert("Planning en pause");
            self.location.reload();
            /*Disable all other button*/
            const buttons = document.querySelectorAll(".buttonStartPlan");
            buttons.forEach(btn => btn.style.display = "none");
        },
        error: function (xhr) {
            alert("Erreur commencement planning");
        }
    });
}

function submit(idtask, status) {
    jQuery.ajax({
        url: 'Users/submit/' + idtask + "/" + status,
        contentType: 'application/json',
        success: function (response) {
            //self.location.reload();
        },
        error: function (xhr) {
            alert("Erreur commencement planning");
        }
    });
}

function showFormUser(firstClass, secondClass, cardClass) {
    document.getElementsByClassName(firstClass)[0].style.display = "none"; document.getElementsByClassName(secondClass)[0].style.display = "block";
    document.getElementsByClassName(cardClass)[0].style.backgroundColor = "rgba(161, 255, 175, 0.76)"; document.getElementsByClassName(cardClass)[0].style.transition = "all 3s";
}

function hideFormUser(firstClass, secondClass, cardClass) {
    document.getElementsByClassName(secondClass)[0].style.display = "block"; document.getElementsByClassName(firstClass)[0].style.display = "none";
    document.getElementsByClassName(cardClass)[0].style.backgroundColor = "white"; document.getElementsByClassName(cardClass)[0].style.transition = "all 3s";
}

function uploadPdf(id, idpl) {
    var formData = new FormData();
    formData.append("file", document.forms['form-upload-' + id + "-" + idpl]['file-upload-' + id + "-" + idpl].files[0]);
    jQuery.ajax({
        type: "POST",
        url: 'Users/uploadPdf/' + id + '/' + idpl,
        contentType: false,
        processData: false,
        data: formData,
        success: function (response) {
            alert("Mis à jour réussie");
        },
        error: function (xhr) {
            alert("Erreur de chargement du document PDF");
        }
    });
}

function saveUserInformation() {
    var usermail = document.getElementById('input-user-mail').value;
    var userpseudo = document.getElementById('input-user-pseudo').value;
    jQuery.ajax({
        url: 'Users/saveUserInformation/' + userpseudo + "/" + usermail,
        contentType: 'application/json',
        success: function (response) {
            self.location.reload();
        },
        error: function (xhr) {
            alert("Erreur sauvegarde !");
        }
    });
}

function downloadPdf(id, idpdf) {
    window.open("Users/downloadPdf/" + id + "/" + idpdf);
}


function affichertachemodal(id) {

    var myModaltache = document.getElementById("modalsoustache");
    var close = document.getElementById("fermeture");
    var todo = document.getElementById("todo");
    var projet = document.getElementById("projet");


    $.ajax({
        type: "POST",
        data: {
            'idtache': id
        },
        dataType: 'text',
        url: 'Users/get_file_tache',
        success: function (response) {

            console.log(response);

            var data = JSON.parse(response);
            // Accède à l'élément "get_projfile" du tableau
            var tacheFiles = data.get_tache_file;

            // Boucle sur les éléments du tableau et affiche la valeur de "nom_file"<a href="" type="file"></a>
            tacheFiles.forEach(function (file) {
                if (file.nom_file.split('.')[1].toLowerCase() == 'jpg') {
                    document.getElementById('showtachefile').innerHTML += '<div class="col-4"><label><i class="far fa-image" style="margin-left: 5px;display: inline-block; font-size : 35px"></i><span one style="word-wrap: break-word;height: 70px;width : 70px; overflow : hidden;display: block;"><a style="z-index: 10;color: black;position : relative; font-size:10px; width : 80px;" target="_blank" href="file/tache/' + file.hashcode + '/' + file.nom_file.split('.')[0] + '/' + file.nom_file + '">' + file.nom_file + '</a></span></label></div>';
                }
                else if (file.nom_file.split('.')[1].toLowerCase() == 'pdf') {
                    document.getElementById('showtachefile').innerHTML += '<div class="col-4"><label><i class="far fa-file-pdf" style="margin-left: 5px;display: inline-block;font-size : 35px"></i><span style="word-wrap: break-word;height: 70px;width : 70px; overflow : hidden;display: block;"><a style="z-index: 10;color: black;position : relative; font-size:10px; width : 80px;" target="_blank" href="file/tache/' + file.hashcode + '/' + file.nom_file.split('.')[0] + '/' + file.nom_file + '">' + file.nom_file + '</a></span></label></div>';
                }
                else {
                    document.getElementById('showtachefile').innerHTML += '<div class="col-4"><label><i class="far fa-file" style="margin-left: 5px;display: inline-block;font-size : 35px"></i><span style="word-wrap: break-word;height: 70px;width : 70px; overflow : hidden;display: block;"><a style="z-index: 10;color: black;position : relative; font-size:10px; width : 80px;" target="_blank" href="file/tache/' + file.hashcode + '/' + file.nom_file.split('.')[0] + '/' + file.nom_file + '">' + file.nom_file + '</a></span></label></div>';
                }

            });



            //document.getElementById('showtachebyid').innerHTML = response;

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Erreur AJAX : " + textStatus + ", " + errorThrown);
        }
    });

    $.ajax({
        type: "POST",
        data: {
            'idsoustache': id
        },
        dataType: 'text',
        url: 'Users/get_tache_by_id',
        success: function (response) {

            var data = JSON.parse(response);
            // Accède à l'élément "get_projfile" du tableau
            var tachebyid = data.gettache_byid;
            console.log(tachebyid);

            document.getElementById('recupidtache').value = id;

            document.getElementById('titre_tache').innerHTML = tachebyid[0].nom_tache;
            document.getElementById('dureetache').innerHTML = '<i class="fas fa-clock"></i> Durée tache : <b>' + tachebyid[0].duree + '</b>';
            document.getElementById('prioritetache').innerHTML = '<i class="fas fa-level-up-alt"></i> Priorité tache : <b>' + tachebyid[0].ordre_priori + '</b>';



            //document.getElementById('showtachebyid').innerHTML = response;

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Erreur AJAX : " + textStatus + ", " + errorThrown);
        }
    });

    myModaltache.style.display = "block";
    todo.style.display = "none";
    projet.style.display = "none";


    close.onclick = function () {
        myModaltache.style.display = "none";
        todo.style.display = "block";
        projet.style.display = "block";
        document.getElementById('showtachefile').innerHTML = '';
        self.location.reload();
    }

    window.onclick = function (event) {
        if (event.target == myModaltache) {
            myModaltache.style.display = "none";
            todo.style.display = "block";
            projet.style.display = "block";
            document.getElementById('showtachefile').innerHTML = '';
            self.location.reload();
        }
    }

}











function afficherprojmodal(id) {

    var myModalprojet = document.getElementById("modalprojet");
    var close = document.getElementById("fermetureproj");
    var todo = document.getElementById("todo");
    var projet = document.getElementById("projet");


    $.ajax({
        type: "POST",
        data: {
            'idproj': id
        },
        dataType: 'text',
        url: 'Users/idproj',
        success: function (response) {

            console.log(response);

            var data = JSON.parse(response);
            // Accède à l'élément "get_projfile" du tableau
            var projFiles = data.get_projfile;

            // Boucle sur les éléments du tableau et affiche la valeur de "nom_file"<a href="" type="file"></a>
            projFiles.forEach(function (file) {
                if (file.nom_file.split('.')[1].toLowerCase() == 'jpg') {
                    document.getElementById('showtprojfile').innerHTML += '<div class="col-4"><label><i class="far fa-image" style="margin-left: 5px;display: inline-block; font-size : 35px"></i><span one style="word-wrap: break-word;height: 70px;width : 70px; overflow : hidden;display: block;"><a style="z-index: 10;color: black;position : relative; font-size:10px; width : 80px;" target="_blank" href="file/tache/' + file.hashcode + '/' + file.nom_file.split('.')[0] + '/' + file.nom_file + '">' + file.nom_file + '</a></span></label></div>';
                }
                else if (file.nom_file.split('.')[1].toLowerCase() == 'pdf') {
                    document.getElementById('showtprojfile').innerHTML += '<div class="col-4"><label><i class="far fa-file-pdf" style="margin-left: 5px;display: inline-block;font-size : 35px"></i><span style="word-wrap: break-word;height: 70px;width : 70px; overflow : hidden;display: block;"><a style="z-index: 10;color: black;position : relative; font-size:10px; width : 80px;" target="_blank" href="file/tache/' + file.hashcode + '/' + file.nom_file.split('.')[0] + '/' + file.nom_file + '">' + file.nom_file + '</a></span></label></div>';
                }
                else {
                    document.getElementById('showtprojfile').innerHTML += '<div class="col-4"><label><i class="far fa-file" style="margin-left: 5px;display: inline-block;font-size : 35px"></i><span style="word-wrap: break-word;height: 70px;width : 70px; overflow : hidden;display: block;"><a style="z-index: 10;color: black;position : relative; font-size:10px; width : 80px;" target="_blank" href="file/tache/' + file.hashcode + '/' + file.nom_file.split('.')[0] + '/' + file.nom_file + '">' + file.nom_file + '</a></span></label></div>';
                }

            });



            //document.getElementById('showtachebyid').innerHTML = response;

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Erreur AJAX : " + textStatus + ", " + errorThrown);
        }
    });

    $.ajax({
        type: "POST",
        data: {
            'idprojet': id
        },
        dataType: 'text',
        url: 'Users/get_projet_by_id',
        success: function (response) {

            var data = JSON.parse(response);
            // Accède à l'élément "get_projfile" du tableau
            var projetbyid = data.getprojet_byid;

            document.getElementById('recupid').value = id;

            document.getElementById('titre_projet').innerHTML = projetbyid[0].nom_projet;
            document.getElementById('daterendu').innerHTML = '<i class="fas fa-clock"></i> Date rendu : <b>' + projetbyid[0].date_rendu; + '</b>';
            document.getElementById('adresseprojet').innerHTML = '<i class="fas fa-location"></i> Adresse du projet: <b>' + projetbyid[0].adresse_projet + '</b>';



            //document.getElementById('showtachebyid').innerHTML = response;

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Erreur AJAX : " + textStatus + ", " + errorThrown);
        }
    });

    myModalprojet.style.display = "block";
    todo.style.display = "none";
    projet.style.display = "none";


    close.onclick = function () {
        myModalprojet.style.display = "none";
        todo.style.display = "block";
        projet.style.display = "block";
        document.getElementById('showtprojfile').innerHTML = '';
        self.location.reload();
    }

    window.onclick = function (event) {
        if (event.target == myModalprojet) {
            myModalprojet.style.display = "none";
            todo.style.display = "block";
            projet.style.display = "block";
            document.getElementById('showtprojfile').innerHTML = '';
            self.location.reload();
        }
    }

}





$(document).ready(function () {
    document.getElementById('filetacheenvoye').addEventListener('submit', function (e) {
        e.preventDefault();
        fichier = $('#file-inputtache').prop('files')[0];
        id_tache = document.getElementById('recupidtache').value;
        console.log(fichier);
        formData = new FormData();
        formData.append('filetache', fichier);
        formData.append('id_tache', id_tache);
        var $filetache = $('#file-inputtache'),
            $label = $filetache.next('label'),
            $labelText = $label.find('span'),
            $labelRemove = $('i.ramove'),
            $labelcheck = $('i.check');
        $filetache.val("");
        $labelRemove.hide();
        $labelcheck.hide();
        $labelText.text("Ajouter");

        $.ajax({
            type: "POST",
            url: 'Users/fichier_tache',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                if (fichier.name.split('.')[1].toLowerCase() == 'jpg') {
                    document.getElementById('showtachefile').innerHTML += '<div class="col-4"><label><i class="far fa-image" style="margin-left: 5px;display: inline-block; font-size : 35px"></i><span style="word-wrap: break-word;height: 70px;width : 70px; overflow : hidden;display: block;"><a style="z-index: 10;color: black;position : relative; font-size:10px; width : 80px;" target="_blank" href="file/tache/' + response + '/' + fichier.name.split('.')[0] + '/' + fichier.name + '">' + fichier.name + '</a></span></label></div>';
                }
                else if (fichier.name.split('.')[1].toLowerCase() == 'pdf') {
                    document.getElementById('showtachefile').innerHTML += '<div class="col-4"><label><i class="far fa-file-pdf" style="margin-left: 5px;display: inline-block;font-size : 35px"></i><span style="word-wrap: break-word;height: 70px;width : 70px; overflow : hidden;display: block;"><a style="z-index: 10;color: black;position : relative; font-size:10px; width : 80px;" target="_blank" href="file/tache/' + response + '/' + fichier.name.split('.')[0] + '/' + fichier.name + '">' + fichier.name + '</a></span></label></div>';
                }
                else {
                    document.getElementById('showtachefile').innerHTML += '<div class="col-4"><label><i class="far fa-file" style="margin-left: 5px;display: inline-block;font-size : 35px"></i><span style="word-wrap: break-word;height: 70px;width : 70px; overflow : hidden;display: block;"><a style="z-index: 10;color: black;position : relative; font-size:10px; width : 80px;" target="_blank" href="file/tache/' + response + '/' + fichier.name.split('.')[0] + '/' + fichier.name + '">' + fichier.name + '</a></span></label></div>';
                }
            },
            error: function (error) {
                console.log(error);
            }


        });
    });

});




$(document).ready(function () {
    document.getElementById('fileprojenvoye').addEventListener('submit', function (e) {
        e.preventDefault();
        fichier = $('#file-inputproj').prop('files')[0];
        id_projet = document.getElementById('recupid').value;
        formData = new FormData();
        formData.append('file', fichier);
        formData.append('id_projet', id_projet);
        var $fileproj = $('#file-inputproj'),
            $label = $fileproj.next('label'),
            $labelText = $label.find('span'),
            $labelRemove = $('i.removeproj'),
            $labelcheck = $('i.check');
        $fileproj.val("");
        $labelText.text("Ajouter");
        $labelRemove.hide();
        $labelcheck.hide();
        $.ajax({
            type: "POST",
            url: 'Users/fichier_projet',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                if (fichier.name.split('.')[1].toLowerCase() == 'jpg') {
                    document.getElementById('showtprojfile').innerHTML += '<div class="col-4"><label><i class="far fa-image" style="margin-left: 5px;display: inline-block; font-size : 35px"></i><span style="word-wrap: break-word;height: 70px;width : 70px; overflow : hidden;display: block;"><a style="z-index: 10;color: black;position : relative; font-size:10px; width : 80px;" target="_blank" href="file/tache/' + response + '/' + fichier.name.split('.')[0] + '/' + fichier.name + '">' + fichier.name + '</a></span></label></div>';
                }
                else if (fichier.name.split('.')[1].toLowerCase() == 'pdf') {
                    document.getElementById('showtprojfile').innerHTML += '<div class="col-4"><label><i class="far fa-file-pdf" style="margin-left: 5px;display: inline-block;font-size : 35px"></i><span style="word-wrap: break-word;height: 70px;width : 70px; overflow : hidden;display: block;"><a style="z-index: 10;color: black;position : relative; font-size:10px; width : 80px;" target="_blank" href="file/tache/' + response + '/' + fichier.name.split('.')[0] + '/' + fichier.name + '">' + fichier.name + '</a></span></label></div>';
                }
                else {
                    document.getElementById('showtprojfile').innerHTML += '<div class="col-4"><label><i class="far fa-file" style="margin-left: 5px;display: inline-block;font-size : 35px"></i><span style="word-wrap: break-word;height: 70px;width : 70px; overflow : hidden;display: block;"><a style="z-index: 10;color: black;position : relative; font-size:10px; width : 80px;" target="_blank" href="file/tache/' + response + '/' + fichier.name.split('.')[0] + '/' + fichier.name + '">' + fichier.name + '</a></span></label></div>';
                }
            },
            error: function (error) {
                console.log(error);
            }


        });
    });

});