function afficherSousTaches(understains, day, hourly,ishebdo) {
    console.log(understains);
    let index = 0;
    var swal_html =   "<div style='display:inline-grid; margin-top:-15px;'> <p style='font-style:italic' > (Selectionner la sous tâche à ajouter) </p><br><br>";
    understains.forEach(element =>
        swal_html += "<button class='buttonPlan buttonblack' onclick='javascript:ajouterSousTaches(" + understains[index]["id_tache"] + ",/" + day + "/,/" + hourly + "/,/" + ishebdo + "/)'>"
        + "" + understains[index++]["nom_tache"] + "" 
        + "</button>"
        + "<br>");
    swal_html += "</div>";
    Swal.fire({
        title: "Ajouter une sous-tache <br> dans le calendrier",
        html: swal_html,
        width: 600,
        customClass : "swal_cometh_calendar",
        showCancelButton: false,
        showCloseButton: true,
        showConfirmButton: false,
        footer : "<br>"
    })    
}

function afficherSousTachesSupp(day, hourly,ishebdo) {
    let index = 0;
    var swal_html = "<div style='display:inline-grid; margin-top:-15px'> <p style='font-style:italic' > (Selectionner la sous tâche à retirer) </p><br><br>";
    var understains = $(".tableHebdomadaire tr td[name=" + day + "_" + hourly + "] i h7").get();
    if(ishebdo == 0){
        understains = $(".tablePrevisionnel tr td[name=" + day + "_" + hourly + "] i h7").get();
    }
    console.log(understains);
    understains.forEach(element =>
        swal_html += "<button class='buttonPlan buttonblack' onclick='javascript:retirerSousTache(" + element.id + ",/" + day + "/,/" + hourly + "/,/" + ishebdo + "/)'>"
        + element.innerText
        + "</button>"
        + "<br>"
        );
    swal_html += "</div>";
    Swal.fire({
        title: "Retirer une sous-tache <br> dans le calendrier",
        html: swal_html,
        width: 600,
        customClass : "swal_supp_cometh_calendar",
        showCancelButton: false,
        showCloseButton: true,
        showConfirmButton: false,
        footer : "<br>"
    })
}

function detailArchive(id){
    id = id.replaceAll(" ","s").replaceAll("-","t").replaceAll(":","d");
    jQuery.ajax({
        url: 'Calendars/detailArchive/' + id,
        contentType: 'application/json',
        success: function (response) {
            successFire();
            window.open("Calendars/detailArchive/" + id);
        },
        error: function (xhr) {
            errorFire();
        }
    });
}

function retirerArchive(id){
    id = id.replaceAll(" ","s").replaceAll("-","t").replaceAll(":","d");
    jQuery.ajax({
        url: 'Calendars/retirerArchive/' + id,
        contentType: 'application/json',
        success: function (response) {
            self.location.reload();
        },
        error: function (xhr) {
            self.location.reload();
        }
    });
}

function retirerSousTache(id, day, hourly,ishebdo) {
    jQuery.ajax({
        url: 'Calendars/removeUnderstain/' + day + "/" + hourly + "/" + id + "/" + ishebdo,
        contentType: 'application/json',
        success: function (response) {
            self.location.reload();
        },
        error: function (xhr) {
            self.location.reload();
        }
    });
}

function successFire(){
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
    Toast.fire({
        icon: 'success',
        title: 'Operation réussie'
    });
}

function errorFire(){
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
    Toast.fire({
        icon: 'error',
        title: 'Erreur action impossible'
    });
}

function ajouterSousTaches(id, day, hourly, ishebdo) {
    jQuery.ajax({
        url: 'Calendars/addUnderStain/' + day + "/" + hourly + "/" +id + "/" +ishebdo,
        contentType: 'application/json',
        success: function (response) {
            self.location.reload();            
            successFire();
        },
        error: function (xhr) {
            self.location.reload();           
            successFire();
        }
    });
    
}

function emptyCalendar(ishebdo) {
    jQuery.ajax({
        url: 'Calendars/emptyCalendar/'+ishebdo,
        contentType: 'application/json',
        success: function (response) {
            self.location.reload();
        },
        error: function (xhr) {
            self.location.reload();
        }
    });
}

function archiver(ishebdo){
    jQuery.ajax({
        url: 'Calendars/archiver/'+ishebdo,
        contentType: 'application/json',
        success: function (response) {
            self.location.reload();
        },
        error: function (xhr) {
            self.location.reload();
        }
    });
    emptyCalendar(ishebdo);
}


function changeProfitPerTask() {
    Swal.fire({
        title: "Profit sur une tache",
        text: "Entrer le montant du profit pour une tache",
        input: 'text',
        showCancelButton: true
    }).then((result) => {
        if (result.value) {
            Swal.fire("Modification reussie", "Le nouveau profit d'une tache est de <b>" + result.value + "</b> euros.", "success");
            submitnewProfit(result.value);
        }
    });
}

function submitnewProfit(profit) {
    jQuery.ajax({
        url: 'Calendars/submitnewProfit/' + profit,
        contentType: 'application/json',
        success: function (response) {
            self.location.reload();
        },
        error: function (xhr) {
            self.location.reload();
        }
    });
}
