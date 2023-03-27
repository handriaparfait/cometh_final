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

function showFormUser(firstClass,secondClass,cardClass) {
    document.getElementsByClassName(firstClass)[0].style.display = "none"; document.getElementsByClassName(secondClass)[0].style.display = "block";
    document.getElementsByClassName(cardClass)[0].style.backgroundColor = "rgba(161, 255, 175, 0.76)"; document.getElementsByClassName(cardClass)[0].style.transition = "all 3s";
}

function hideFormUser(firstClass,secondClass,cardClass) {
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




