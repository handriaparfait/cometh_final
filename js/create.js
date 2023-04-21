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

/*function tache(nom_tache, duree, id_projet, priori) {

    console.log(typeof(nom_tache));

    $.ajax({
        type: "POST",
        url: 'Users/add',
        dataType: 'json',
        data: { 'nom_tache': nom_tache, 'duree': duree, 'priori': priori, 'id_projet': id_projet },
        success: function (data) {
            self.location.href = "users";
            console.log(data);
        },
        error: function (error) {
            self.location.href = "users";
            console.log(error);
        }


    });


};*/



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
/*

function fichiertache() {
    $(document).on('submit', '#envoyerfile', function (e) {
        e.preventDefault();
        fichier = $('#filetache').prop('files')[0];
        id_tache = document.getElementById('recupidtache').value;
        var formData = new FormData();
        formData.append('filetache', fichier);
        formData.append('id_tache', id_tache);
        $.ajax({
            type: "POST",
            url: 'Users/fichier_tache',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log(error);
            }


        });
    });


}*/



function supprimertache() {
    id_tache = document.getElementById('recupidtache').value;
    $.ajax({
        type: "POST",
        url: 'Users/supprimertache',
        dataType: 'json', // <-- what to expect back from the PHP script, if anything
        data: { 'id': id_tache },
        success: function (data) {
            console.log(data);
            self.location.href = "users";
        },
        error: function (error) {
            self.location.href = "users";

        }


    });


}

function supprimerprojet() {
    id_projet = document.getElementById('recupid').value;
    $.ajax({
        type: "POST",
        url: 'Users/supprimerprojet',
        dataType: 'json', // <-- what to expect back from the PHP script, if anything
        data: { 'id': id_projet },
        success: function (data) {
            console.log(data);
            self.location.href = "users";
        },
        error: function (error) {
            self.location.href = "users";

        }


    });
    $.ajax({
        type: "POST",
        url: 'Users/supprimertouttache',
        dataType: 'json', // <-- what to expect back from the PHP script, if anything
        data: { 'id': id_projet },
        success: function (data) {
            console.log(data);
            self.location.href = "users";
        },
        error: function (error) {
            self.location.href = "users";

        }


    });



}

function modifiertache() {
    id_tache = document.getElementById('recupidtache').value;
    const container = document.getElementById("tachedata");
    const container1 = document.getElementById('tachetitre');
    const modcontainer = document.getElementById('moddtache');
    const supptache = document.getElementById('supptache');
    const modiftache = document.getElementById('modiftache');
    const title = document.getElementById('titre_tache');
    const inputtitre = document.createElement("input");
    const valtitre = document.getElementById('titre_tache').textContent;
    const input1 = document.createElement("input");
    const input2 = document.createElement("input");
    const duree = document.getElementById('dureetache');
    const valduree = document.getElementById('dureetache').textContent;
    const priorite = document.getElementById('prioritetache');
    const valpriorite = document.getElementById('prioritetache').textContent;
    inputtitre.style.width = '95%';
    container1.replaceChild(inputtitre, title);
    inputtitre.placeholder = valtitre;
    container.replaceChild(input1, duree);
    const br2 = document.createElement("br");
    container.appendChild(br2);
    container.replaceChild(input2, priorite);
    input1.placeholder = valduree;
    input2.placeholder = valpriorite;
    document.getElementById('zonefichier').style.display = "none";
    const btn = document.createElement("i");
    btn.className = "fas fa-check";
    btn.style.marginLeft = '5px';

    modcontainer.appendChild(btn);
    modcontainer.removeChild(supptache);
    modcontainer.removeChild(modiftache);

    /*filezone = document.getElementById('filetacheUploadForm');
    filezone.style.display = "none";

    filezone1 = document.getElementById('showtachefile');
    filezone1.style.display = "none";*/



    btn.addEventListener("click", function () {

        newtitre = "";
        newduree = "";
        newpriorite = "";

        if (inputtitre.value == "") {
            newtitre = inputtitre.placeholder;
        }
        else {
            newtitre = inputtitre.value;
        }
        if (input1.value == "") {
            newduree = input1.placeholder.split(":")[1];
        }
        else {
            newduree = input1.value;
        }

        if (input2.value == "") {
            newpriorite = input2.placeholder.split(":")[1];
        }
        else {
            newpriorite = input2.value;
        }

        zonenewtitre = document.createElement('h5');
        zonenewtitre.className = 'modal-title align-right';
        zonenewtitre.innerText = newtitre;
        zonenewtitre.id = 'titre_tache';
        zonenewtitre.style.width = '95%';
        container1.replaceChild(zonenewtitre, inputtitre);
        zonenewduree = document.createElement('p');
        zonenewduree.id = 'dureetache';
        zonenewduree.innerHTML = '<i class="fas fa-clock"></i> Durée tache: <b>' + newduree + '</b>';
        container.replaceChild(zonenewduree, input1);
        zonenewprioite = document.createElement('p');
        zonenewprioite.id = 'prioritetache';
        zonenewprioite.innerHTML = '<i class="fas fa-level-up-alt"></i> Priorité tache: <b>' + newpriorite+ '</b>';
        container.replaceChild(zonenewprioite, input2);
        /*filezone.style.display = "block";
        filezone1.style.display = "block";*/

        modcontainer.removeChild(btn);
        modcontainer.appendChild(supptache);
        modcontainer.appendChild(modiftache);
        
        document.getElementById('zonefichier').style.display = "block";

        $.ajax({
            type: "POST",
            data: {
                'id_tache': id_tache,
                'titre': newtitre,
                'duree': newduree,
                'priori': newpriorite
            },
            url: "Users/edit_tache",
            dataType: 'json',
            success: function (response) {
                /*filezone.style.display = "none";*/
                /*newsupptache = document.createElement('i');
                newmodiftache = document.createElement('i');
                newsupptache.className = 'fas fa-trash-alt';
                newsupptache.id = 'supptache';
                newsupptache.style.marginRight = '5px';
                newsupptache.onclick = function supprimertache() { };

                newsupptache.addEventListener('click', function supprimertache() { });
                newmodiftache.className = 'fas fa-edit';
                newmodiftache.id = 'modiftache';
                newmodiftache.addEventListener('click', function modifiertache() { });


                
                modcontainer.appendChild(newsupptache);
                modcontainer.appendChild(newmodiftache);*/


            },
            error: function (errorThrown) {
            }
        });
    });
    /*$('#Modalsoustache').on('hidden.bs.modal', function(e) {
        window.location.reload();

    });*/
}


function modifierprojet() {
    id_projet = document.getElementById('recupid').value;
    const container = document.getElementById("projetdata");
    const container1 = document.getElementById('projettitre');
    const modcontainer = document.getElementById('moddprojet');
    const suppprojet = document.getElementById('suppprojet');
    const modifprojet = document.getElementById('modifprojet');
    const title = document.getElementById('titre_projet');  
    const inputtitre = document.createElement("input");
    const valtitre = document.getElementById('titre_projet').textContent;
    const input1 = document.createElement("input");
    const input2 = document.createElement("input");
    const daterendu = document.getElementById('daterendu');
    const valdaterendu = document.getElementById('daterendu').textContent;
    const adresseproj = document.getElementById('adresseprojet');
    const valadresseproj = document.getElementById('adresseprojet').textContent;
    inputtitre.style.width = '95%';
    container1.replaceChild(inputtitre, title);
    inputtitre.placeholder = valtitre;
    container.replaceChild(input1, daterendu);
    const br2 = document.createElement("br");
    container.appendChild(br2);
    container.replaceChild(input2, adresseproj);
    input1.placeholder = valdaterendu;
    input2.placeholder = valadresseproj;
    document.getElementById('zonefichierproj').style.display = "none";
    const btn = document.createElement("i");
    btn.className = "fas fa-check";
    btn.style.marginLeft = '5px';

    modcontainer.appendChild(btn);
    modcontainer.removeChild(suppprojet);
    modcontainer.removeChild(modifprojet);



    btn.addEventListener("click", function () {

        newtitre = "";
        newdaterendu = "";
        newadresseproj = "";

        if (inputtitre.value == "") {
            newtitre = inputtitre.placeholder;
        }
        else {
            newtitre = inputtitre.value;
        }
        if (input1.value == "") {
            newdaterendu = input1.placeholder.split(":")[1];
        }
        else {
            newdaterendu = input1.value;
        }

        if (input2.value == "") {
            newadresseproj = input2.placeholder.split(":")[1];
        }
        else {
            newadresseproj = input2.value;
        }

        zonenewtitre = document.createElement('h5');
        zonenewtitre.className = 'modal-title align-right';
        zonenewtitre.innerText = newtitre;
        zonenewtitre.id = 'titre_projet';
        zonenewtitre.style.width = '95%';
        container1.replaceChild(zonenewtitre, inputtitre);
        zonenewdaterendu = document.createElement('p');
        zonenewdaterendu.id = 'daterendu';
        zonenewdaterendu.innerHTML = '<i class="fas fa-clock"></i> Date rendu : <b>' + newdaterendu + '</b>';
        container.replaceChild(zonenewdaterendu, input1);
        zonenewadresseproj = document.createElement('p');
        zonenewadresseproj.id = 'adresseprojet';
        zonenewadresseproj.innerHTML = '<i class="fas fa-location"></i> Adresse du projet : <b>' + newadresseproj+ '</b>';
        container.replaceChild(zonenewadresseproj, input2);
        /*filezone.style.display = "block";
        filezone1.style.display = "block";*/

        modcontainer.removeChild(btn);
        modcontainer.appendChild(suppprojet);
        modcontainer.appendChild(modifprojet);
        
        document.getElementById('zonefichierproj').style.display = "block";

        $.ajax({
            type: "POST",
            data: {
                'id_projet': id_projet,
                'titre': newtitre,
                'daterendu': newdaterendu,
                'adresseproj': newadresseproj
            },
            url: "Users/edit_projet",
            dataType: 'json',
            success: function (response) {
                filezone.style.display = "none";

            },
            error: function (errorThrown) {

            }
        });
    });
    /*$('#ModalSlide').on('hidden.bs.modal', function (e) {
        window.location.reload();

    });*/
}
