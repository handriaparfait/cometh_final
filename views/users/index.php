<?php


function convert($hour)
{
    if ($hour == null) return "00h00";
    else return "" . $hour . "";
}

function isAdmin($admin)
{
    if ($admin == 1) return "Administrateur";
    else return "Utilisateur";
}

function currentPlan($plan)
{
    if ($plan == "false") return "Aucun commencé";
    else {
        $text = $plan[0]->{"plan_name"} . " <small><i> (" . $plan[0]->{"plan_date"}  . " à " . $plan[0]->{"plan_adresse"} . ") </i></small>";
        return $text;
    }
}

function buttonDisabled($idpl, $currentpl, $ispaused)
{
    //var_dump($idpl);
    //var_dump($currentpl[0]);
    //var_dump($ispaused);
    if ($currentpl == "false") return "";
    else if ($currentpl[0]->{"plan_id"} == $idpl) {
        if ($currentpl[0]->{'ispaused'} == 1) return "";
        else return "disabled";
    } else {
        return "disabled";
    }
}

function buttonDisabled2($currentpl)
{
    if ($currentpl[0]->{'ispaused'} == 1) return "disabled";
    else return "";
}

function currentPlanPauseClass($plan)
{
    if ($plan[0]->{"ispaused"} == 1) return "buttonPlan blocked";
    else return "buttonPlan pause";
}

function currentPlanEndClass($plan)
{
    if ($plan[0]->{"ispaused"} == 1) return "buttonPlan blocked";
    else return "buttonPlan end";
}

function currentPlanText($plan)
{
    if ($plan == "1") return "Reprendre";
    else return "Commencer";
}

function currentPlanClass($plan, $idplan, $plan2)
{
    if ($plan != null) {
        if ($plan == $idplan) {
            if ($plan2[0]->{"ispaused"} == 0) return "buttonPlan blocked";
            else return "buttonPlan";
        }
        return "buttonPlan blocked";
    } else return "buttonPlan";
}

function taskClass($level)
{
    if ($level == "PR") return "prioritaire";
    else if ($level == "AF") return "afaire";
    else if ($level == "LB") return "libre";
}

function taskLevelName($level)
{
    if ($level == "PR") return "Prioritaire";
    else if ($level == "AF") return "A faire";
    else if ($level == "LB") return "Libre";
}

function boxchecked($status)
{
    if ($status == "1") return "checked";
    else return "";
}



?>

<style>
    .rond {
        height: 8px;
        width: 8px;
        border-radius: 50%;
        background-color: red;
        display: inline-block;
    }

    .container-fluid {
        height: 100%;
        overflow-y: hidden;
        overflow-x: hidden;
    }

    /*.profil {
        border: 0.01px solid rgba(0, 0, 0, 0.2);
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s all;
        border-radius: 0 0 10px 10px;
        background-color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
        width: 75%;
    }

    .profil:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }

    .profil .avatar img {
        border-radius: 50%;
        border: 4px solid #17a589;
    }

    .profil .title {
        font-size: 26px;
        margin-top: 18px;
        color: #17a589;
    }

    .profil .description {
        font-size: 17px;
        margin-top: 18px;
        color: #64707d;
    }

    .profil .social ul {
        margin-top: 22px;
        list-style-type: none;
    }

    .profil .social ul li {
        display: inline;
        font-size: 22px;
        cursor: pointer;
        color: #17a589;
    }

    .row {
        padding-right: 20px;
    }*/

    /*

    #profil {
        padding-top: 25px;
        text-align: center;
        z-index: 10;
    }
*/
    /*#compta {
        padding-top: 25px;
        grid-area: b;
        position: absolute;
        right: 80%;
    }
*/
    #todo {
        position: absolute;
        width: 27%;
        height: 450px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        left: 0;
        z-index: 1000;
    }

    #todo:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }

    #projet {
        position: absolute;
        width: 65%;
        left: 30%;
        z-index: 1000;

    }

    #projetheader {
        cursor: move;
        color: #fff;
    }

    /*#comptaheader {
        cursor: move;
        z-index: 10;
        color: #fff;
    }

    #profilheader {
        padding: 10px;
        cursor: move;
        z-index: 10;
        color: #fff;
    }*/

    .ok {
        /*display: grid;
        grid-template-columns: repeat(7, 1fr);
        grid-template-rows: repeat(8, 1fr);
        gap: 1em 1em;
        grid-auto-flow: row;
        padding: 1rem;
        grid-template-areas:
            "c c d d"*/
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        padding: 30px;
    }







    /*
    .modal-dialog {
        max-width: 20%;
    }

    .modal-dialog-slideout {
        min-height: 50%;
        margin: 0 0 0 auto;
        background: #fff;
    }






    .modal.fade .modal-dialog.modal-dialog-slideout {
        -webkit-transform: translate(100%, 0)scale(1);
        transform: translate(100%, 0)scale(1);
    }

    .modal.fade.show .modal-dialog.modal-dialog-slideout {
        -webkit-transform: translate(0, 0);
        transform: translate(0, 0);
        display: flex;
        align-items: stretch;
        -webkit-box-align: stretch;
        height: 50%;
    }

    .modal.fade.show .modal-dialog.modal-dialog-slideout .modal-body {
        overflow-y: auto;
        overflow-x: hidden;
    }

    .modal-dialog-slideout .modal-content {
        border: 0;
    }

    .modal-dialog-slideout .modal-header,
    .modal-dialog-slideout .modal-footer {
        height: 4rem;
        display: block;
    }


    .modal-content {
        -webkit-border-radius: 10px !important;
        -moz-border-radius: 10px !important;
        border-radius: 10px !important;
    }*/

    #soustacheline:after {
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        width: 1px;
        background-color: #f0f0f0;
        left: 170px;
        height: 10000%;
    }

    #projetline:after {
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        width: 1px;
        background-color: #f0f0f0;
        left: 180px;
        height: 10000%;
    }

    .modalsoustache {
        display: none;
        /* Masquer la modale par défaut */
        position: fixed;
        /* Position fixe */
        z-index: 100;
        /* Z-index élevé */
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        /* Ajouter un défilement si nécessaire */
        background-color: rgba(0, 0, 0, 0.4);
        /* Faites en sorte que le fond soit sombre et translucide */
    }

    .soustachemodal {
        background-color: white;
        border-radius: 10px;
        opacity: 1;
        margin: 15% auto;
        margin-left: 25%;
        /* Centrer la modale */
        border: 1px solid #888;
        width: 50%;
        height: 500px;
        /* Largeur de la modale */
    }

    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    #fermeture:hover,
    #fermeture:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    #showtachefile::-webkit-scrollbar {
        display: none;
        /* Safari and Chrome */
    }


    .modalprojet {
        display: none;
        /* Masquer la modale par défaut */
        position: fixed;
        /* Position fixe */
        z-index: 100;
        /* Z-index élevé */
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        /* Ajouter un défilement si nécessaire */
        background-color: rgba(0, 0, 0, 0.4);
        /* Faites en sorte que le fond soit sombre et translucide */
    }

    .projetmodal {
        background-color: white;
        border-radius: 10px;
        opacity: 1;
        margin: 15% auto;
        margin-left: 25%;
        /* Centrer la modale */
        border: 1px solid #888;
        width: 50%;
        height: 500px;
        /* Largeur de la modale */
    }

    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    #fermetureproj:hover,
    #fermetureproj:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    #showtprojfile::-webkit-scrollbar {
        display: none;
        /* Safari and Chrome */
    }

    @media screen and (min-width: 992px) {

        /* Règles CSS pour l'affichage sur un grand écran */
        .ok {
            display: inline-flex;
        }
    }

    /* Pour un écran de largeur comprise entre 768px et 991px */
    @media screen and (min-width: 768px) and (max-width: 991px) {
        /* Règles CSS pour l'affichage sur un écran moyen */

    }

    /* Pour un écran de largeur inférieure ou égale à 767px */
    @media screen and (max-width: 767px) {

        /* Règles CSS pour l'affichage sur un petit écran */
        #todo {
            display: inline;
        }

        #projet {
            display: block;
        }
    }
</style>


<!--link rel="stylesheet" href="css/main.css"-->
<script type="text/javascript" src="js/create.js"></script>
<script type="text/javascript" src="js/add.js"></script>


<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



<body>

    <div class="container-fluid ok">
        <!--div id="profil">
            <div class="profil" style="padding: 0; height: 450px; position: absolute; cursor: pointer; user-select: none; border-radius: 10px;">
                <div style="height: 50px; background-color: #394263; color: white;text-align: left; font-size: 24px; padding: 2%; border-radius: 10px 10px 0 0;" id="profilheader">
                    Profil
                </div>
                <div class="avatar" style="text-align: left; padding : 10px">
                    <img src="images/profile.jpg" style="width: 80px; height: 80px;">
                </div>
                <div class="title" style="text-align: left; padding : 10px; margin-top: 0; margin-bottom: 0;">
                    <p><!--?php echo "&nbsp" . ($users[0]->{'name'}) ?></p>
                </div>
                <hr>
                <div class="description" style="margin-left: 5%; margin-top: 0;">
                    <p style="text-align: left;"> <strong>Horraire de travail</strong> </p>
                    <div style="text-align: left;">
                        Matin (début) :
                        <br>
                        Matin (fin) :
                    </div>
                </div>
                <hr>
                <div class="social">
                    <ul>
                        <li><i class="fab fa-facebook"></i></li>
                        <li><i class="fab fa-twitter"></i></li>
                        <li><i class="fab fa-github"></i></li>
                        <li><i class="fab fa-dev"></i></li>
                        <li><i class="fas fa-link"></i></li>
                    </ul>
                </div>
            </div>
        </div-->
        <!--div id="compta">
            <div class="profil" style="padding: 0; height: 450px; position: absolute; cursor: pointer; user-select: none; border-radius: 10px;">
                <div style="height: 50px; background-color: #394263; color: white;text-align: left; font-size: 24px;border-radius: 10px 10px 0 0; padding: 2%; margin-bottom: 10px;" id="comptaheader">
                    Comptabilité
                </div>
                <div class="avatar" style="text-align: right; height: 400px; margin-right: 10px;">
                    <button type="button" class="btn btn-secondary">Crédit</button> <button type="button" class="btn btn-danger">Débit</button>
                </div>
            </div>
        </div-->



        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #2B3467; color :white;">
                        <h4 class="modal-title w-100 ">Créer un projet</h4>
                        <button type="button" style="color : white;" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" style=" text-align: left;">

                        <div class="container">

                            <div class="form-group row">
                                <label for="id" class="col-sm-4 col-form-label" style="font-size: 16px; color: black;">Nom du projet</label>
                                <div class="col-sm-8" style="margin-top: 4px;">
                                    <input type="text" id="nom_projet" required />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="id" class="col-sm-4 col-form-label" style="font-size: 16px; color: black;">Date de rendu</label>
                                <div class="col-sm-8" style="margin-top: 4px;">
                                    <input type="date" id="date_rendu" required />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="id" class="col-sm-4 col-form-label" style="font-size: 16px; color: black;">Adresse du projet</label>
                                <div class="col-sm-8" style="margin-top: 4px;">
                                    <input type="text" id="adresse_proj" required />
                                </div>
                            </div>
                            <br>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="create(document.getElementById('nom_projet').value,
                                                                                                                    document.getElementById('date_rendu').value,
                                                                                                                    document.getElementById('adresse_proj').value)">Enregistrer</button><button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="modalprojet" class="modalprojet">
            <div class="projetmodal" style=" background: #EEEEEE;">

                <div class="headproj" id="projettitre" style="width: 100%; padding: 20px; display: inline-flex; color: White; background-color: #2B3467; border-radius: 10px 10px 0 0;">
                    <h5 class="modal-title align-right" id="titre_projet" style="width: 95%; overflow: hidden;">vzvzvzv</h5>
                    <div style="display: inline-flex; margin-top: 5px;" id="moddprojet">
                        <i id="suppprojet" class="fas fa-trash-alt" style="margin-right: 5px;" onclick="supprimerprojet()"></i>
                        <i id="modifprojet" class="fas fa-edit" onclick="modifierprojet()"></i>
                    </div>
                </div>

                <div class="content-body" style="padding: 20px; height: 340px;">
                    <p id='recupid' style="display: none;" name='recupid' value=""></p>
                    <div class="container">
                        <div class="row">
                            <div class="col-4" id="projetdata">
                                <p id="daterendu"></p>
                                <p id="adresseprojet"></p>
                            </div>


                            <div class="col-8" id="zonefichierproj" style="padding : 5%; width: 100%; height: 300px;  border-radius: .5em; box-shadow: inset -12px -12px 12px rgba(255, 255, 255, 1),  inset 12px 12px 12px rgba(0, 0, 0, 0.3);">
                                <!--form id="filetacheUploadForm" action="#" method="post" enctype="multipart/form-data">
                                    <input type="file" id="filetache" name="filetache">
                                    <input type="submit" onclick="fichiertache()" name="submit" value="ajouter">
                                </form-->
                                <div style="display: inline-flex;">
                                    <div class="row">
                                        <div class="col-8">
                                            <h5>Liste des fichiers</h5>

                                        </div>
                                        <div class="col-4" style="text-align: right;">
                                            <form id="fileprojenvoye" enctype="multipart/form-data">
                                                <input type="file" id="file-inputproj" style="display: none;">
                                                <label for="file-inputproj">
                                                    <i class="fas fa-download"></i>
                                                    <span style="font-size: 12px;">Ajouter</span>
                                                </label>
                                                <i class="fa fa-times-circle removeproj" style="margin-left: 5px;cursor:pointer;display:none;vertical-align:middle;"></i>
                                                <button style="background: none; padding: 0; border: none;" type="submit" id="completed-task" class="fabutton">
                                                    <i class="fas fa-check check" id="envoyerfileproj" style="margin-left: 5px;cursor:pointer;display:none;vertical-align:middle;"></i>
                                                </button>

                                            </form>
                                        </div>
                                    </div>

                                </div>

                                <hr>
                                <div class="row" id="showtprojfile" style="height: 120px; overflow-y: scroll">

                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <hr>


                <div class="foot">
                    <button style="margin-left: 2%;" class="btn btn-secondary" id="fermetureproj">Fermer</button>
                </div>
            </div>
        </div>









        <div id="modalsoustache" class="modalsoustache">
            <div class="soustachemodal" style=" background: #EEEEEE;">

                <div class="headtache" id="tachetitre" style="width: 100%; padding: 20px; display: inline-flex; color: White; background-color: #2B3467; border-radius: 10px 10px 0 0;">
                    <h5 class="modal-title align-right" id="titre_tache" style="width: 95%; overflow: hidden;">vzvzvzv</h5>
                    <div style="display: inline-flex; margin-top: 5px;" id="moddtache">
                        <i id="supptache" class="fas fa-trash-alt" style="margin-right: 5px;" onclick="supprimertache()"></i>
                        <i id="modiftache" class="fas fa-edit" onclick="modifiertache()"></i>
                    </div>
                </div>

                <div class="content-body" style="padding: 20px; height: 340px;">
                    <p id='recupidtache' style="display: none;" name='recupidtache' value=""></p>
                    <div class="container">
                        <div class="row">
                            <div class="col-4" id="tachedata">
                                <p id="dureetache"></p>
                                <p id="prioritetache"></p>
                            </div>


                            <div class="col-8" id="zonefichier" style="padding : 5%; width: 100%; height: 300px;  border-radius: .5em; box-shadow: inset -12px -12px 12px rgba(255, 255, 255, 1),  inset 12px 12px 12px rgba(0, 0, 0, 0.3);">
                                <!--form id="filetacheUploadForm" action="#" method="post" enctype="multipart/form-data">
                                    <input type="file" id="filetache" name="filetache">
                                    <input type="submit" onclick="fichiertache()" name="submit" value="ajouter">
                                </form-->
                                <div style="display: inline-flex;">
                                    <div class="row">
                                        <div class="col-8">
                                            <h5>Liste des fichiers</h5>

                                        </div>
                                        <div class="col-4" style="text-align: right;">
                                            <form id="filetacheenvoye" enctype="multipart/form-data">
                                                <input type="file" id="file-inputtache" style="display: none;">
                                                <label for="file-inputtache">
                                                    <i class="fas fa-download"></i>
                                                    <span style="font-size: 12px;">Ajouter</span>
                                                </label>
                                                <i class="fa fa-times-circle ramove" style="margin-left: 5px;cursor:pointer;display:none;vertical-align:middle;"></i>
                                                <button style="background: none; padding: 0; border: none;" type="submit" id="completed-task" class="fabutton">
                                                    <i class="fas fa-check check" id="envoyerfile" style="margin-left: 5px;cursor:pointer;display:none;vertical-align:middle;"></i>
                                                </button>

                                            </form>
                                        </div>
                                    </div>

                                </div>

                                <hr>
                                <div class="row" id="showtachefile" style="height: 120px; overflow-y: scroll">

                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <hr>


                <div class="foot">
                    <button style="margin-left: 2%;" class="btn btn-secondary" id="fermeture">Fermer</button>
                </div>
            </div>
        </div>
        <div id="todo" style="padding: 0; height: 450px; position: absolute; cursor: pointer; user-select: none; border-radius: 10px;">
            <div class="">
                <div style="height: 50px; background-color: #394263; color: white;text-align: left; font-size: 24px;border-radius: 10px 10px 0 0; padding: 2%; cursor: move;">
                    To Do List
                </div>
                <div class="avatar" style="text-align: left; height: 380px; margin-left: 10px; background-color: white; padding: 10px;">
                    <div id="todolist">
                        <button id="bouutn">+</button>

                    </div>
                </div>
            </div>
        </div>

        <div id="projet" style="height: 450px; cursor: pointer; position: absolute; user-select: none;">
            <div class="mmain__cards">
                <div class="card" style="border-radius: 10px;">
                    <div class="card__header style=" style="border-radius: 10px 10px 0 0 !important ;" id="projetheader">
                        <div class="card__header-title text-light"><strong>Projet</strong>
                        </div>
                        <div class="settings">
                            <div class="settings__block" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></div>
                        </div>
                    </div>
                    <div class="card__main" style="height: 400px; overflow-y: scroll; overflow-x: hidden; padding: 10px; border-radius: 10px;">
                        <?php foreach ($projet as $project) : ?>
                            <div class="card__row">
                                <div class="card__icon" style="left: 150px;" onclick="afficherprojmodal(<?php echo $project->id; ?>)" data-designid="<?php echo $project->id; ?>"><i class="fas fa-file"></i></div>
                                <div class="card__time">
                                    <div class="text-bold">
                                        <p style="font-size: small; color: black; width: 80px; overflow: hidden; position: relative; text-align: left;" onclick="alert('<?php echo $project->nom_projet; ?>');"><?php echo $project->nom_projet; ?></p>
                                    </div>
                                </div>
                                <div class="card__detail">
                                    <div class="card__source text-bold" style="width: 511px; overflow: hidden;">----------------------------------------------------------------------------</div>
                                    <?php foreach ($tache as $taches) : ?>
                                        <?php if ($project->id == $taches->id_projet) : ?>
                                            <div style="display: inline;" class="card__description" onclick="affichertachemodal(<?php echo $taches->id_tache; ?>)" data-designid="<?php echo $taches->id_tache; ?>">
                                                <div class="rond"></div> <?php echo $taches->nom_tache ?>
                                            </div>

                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                                <div>
                                    <div style="cursor: pointer;" class="settings__block" data-toggle="modal" data-designid="<?php echo $project->id; ?>" data-target="#second_modal"><i class="fas fa-plus"></i></div>
                                </div>
                            </div>
                            <!--div class="modal fade" id="Modalsoustache" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-slideout" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" id="tachetitre" style="background-color: #2B3467; color :white; display: inline-flex;">
                                            <h5 class="modal-title align-right" id="titre_tache"></h5>
                                            <div>
                                                <i class="fas fa-trash-alt" style='font: size 14px; margin-right: 5px;' onclick="supprimertache()"></i>
                                                <i class="fas fa-edit" style='font: size 14px;' onclick="modifiertache()"></i>
                                            </div>



                                        </div>
                                        <div class="modal-body" id="soustacheline" style="display: flex;">


                                            <div id="tachedata" style="width: 35%; font-size: 14px;">
                                                <p id='recupidtache' name='recupidtache' value=""></p>

                                                <!--p id="dureetache"></p>
                                                <p id="prioritetache"></p>

                                            </div>

                                            <div style="width: 65%; font-size: 13px; padding: 10px;">
                                                <form id="filetacheUploadForm" action="" method="post" enctype="multipart/form-data">
                                                    <input type="file" id="filetache" name="filetache">
                                                    <input type="submit" onclick="fichiertache()" name="submit" value="ajouter">
                                                </form>
                                                <!--div id="showtachefile">

                                                </div>
                                            </div>



                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function affichersoustache(id) {
                                    $.ajax({
                                        type: "POST",
                                        data: {
                                            'idtache': id
                                        },
                                        dataType: 'text',
                                        url: 'Users/get_file_tache',
                                        success: function(response) {

                                            console.log(response);

                                            var data = JSON.parse(response);
                                            // Accède à l'élément "get_projfile" du tableau
                                            var tacheFiles = data.get_tache_file;

                                            // Boucle sur les éléments du tableau et affiche la valeur de "nom_file"<a href="" type="file"></a>
                                            tacheFiles.forEach(function(file) {
                                                document.getElementById('showtachefile').innerHTML += '<span style="text-align: center"><i style="font-size: 100px;" class="fas fa-file"> </i><a style="z-index: 10;color: white;left: -25%; position : relative; top : -15%; font-size:10px; width : 80px;" target="_blank" href="file/tache/' + file.hashcode + '/' + file.nom_file.split('.')[0] + '/' + file.nom_file + '">' + file.nom_file + '</a></span><br>';
                                            });



                                            //document.getElementById('showtachebyid').innerHTML = response;

                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
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
                                        success: function(response) {

                                            var data = JSON.parse(response);
                                            // Accède à l'élément "get_projfile" du tableau
                                            var tachebyid = data.gettache_byid;
                                            console.log(tachebyid);

                                            document.getElementById('titre_tache').innerHTML = tachebyid[0].nom_tache;
                                            document.getElementById('dureetache').innerHTML = 'Durée tache: ' + tachebyid[0].duree;
                                            document.getElementById('prioritetache').innerHTML = 'Priorité tache: ' + tachebyid[0].ordre_priori;



                                            //document.getElementById('showtachebyid').innerHTML = response;

                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
                                            console.log("Erreur AJAX : " + textStatus + ", " + errorThrown);
                                        }
                                    });
                                }
                            </script-->

                            <!--div class="modal fade" id="ModalSlide" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-slideout" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" id="titreprojet" style="background-color: #2B3467; color: white; display: inline-flex;">
                                            <h5 class="modal-title align-right" id="titre_projet" style="width: 370px; height: 30px; overflow: hidden;"></h5>
                                            <div>
                                                <i class="fas fa-trash-alt" style='font: size 14px; margin-right: 5px;' onclick="supprimerprojet()"></i>
                                                <i class="fas fa-edit" style='font: size 14px;' onclick="modifierprojet()"></i>
                                            </div>
                                        </div>
                                        <div class="modal-body" id="projetline" style="display: flex;">


                                            <div id="projetdata" style="width: 40%; font-size: 13px;">
                                                <p id='recupid' name='recupid' value=""></p>
                                                <p id="daterendu"></p>
                                                <p id="adresse_du_projet"></p>
                                            </div>
                                            <div style="width: 60%; font-size: 13px;padding: 10px;">
                                                <form id="fileUploadForm" action="" method="post" enctype="multipart/form-data">
                                                    <input type="file" id="file" name="file">
                                                    <input type="submit" onclick="fichierprojet()" name="submit" value="ajouter">
                                                </form>

                                                <div id="showprjfile" style="display: inline;">

                                                </div>
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function afficherDiv(id) {
                                    $.ajax({
                                        type: "POST",
                                        data: {
                                            'idprojet': id
                                        },
                                        dataType: 'text',
                                        url: 'Users/get_projet_by_id',
                                        success: function(response) {

                                            var data = JSON.parse(response);
                                            // Accède à l'élément "get_projfile" du tableau
                                            var projetbyid = data.getprojet_byid;
                                            console.log(projetbyid[0].date_rendu);

                                            document.getElementById('titre_projet').innerHTML = projetbyid[0].nom_projet;
                                            document.getElementById('daterendu').innerHTML = 'Date rendu: ' + projetbyid[0].date_rendu;
                                            document.getElementById('adresse_du_projet').innerHTML = 'Adresse du projet: ' + projetbyid[0].adresse_projet;



                                            //document.getElementById('showtachebyid').innerHTML = response;

                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
                                            console.log("Erreur AJAX : " + textStatus + ", " + errorThrown);
                                        }
                                    });
                                    var div = document.getElementById("monDiv");
                                    div.style.display = "block";
                                    $.ajax({
                                        type: "POST",
                                        data: {
                                            'idproj': id
                                        },
                                        dataType: 'text',
                                        url: 'Users/idproj',
                                        success: function(response) {
                                            console.log(response);

                                            var data = JSON.parse(response);
                                            // Accède à l'élément "get_projfile" du tableau
                                            var projFiles = data.get_projfile;

                                            // Boucle sur les éléments du tableau et affiche la valeur de "nom_file"<a href="" type="file"></a>
                                            projFiles.forEach(function(file) {
                                                document.getElementById('showprjfile').innerHTML += '<span style="text-align: center"><i style="font-size: 100px;" class="fas fa-file"> </i><a style="z-index: 10;color: white;left: -28%; position : relative; top : -10%; font-size:10px; width : 80px;" target="_blank" href="file/projet/' + file.hashcode + '/' + file.nom_file.split('.')[0] + '/' + file.nom_file + '">' + file.nom_file + '</a> </span> <br>';
                                            });
                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
                                            console.log("Erreur AJAX : " + textStatus + ", " + errorThrown);
                                        }
                                    });
                                    document.getElementById('showprjfile').innerHTML = '';
                                }
                            </script-->
                            <div id="monDiv" style="display:none;">

                                <p id="idprojet"></p>


                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!--div class="card__row">
                                <div class="card__icon"><i class="fas fa-book"></i></div>
                                <div class="card__time">
                                    <div class="text-bold">Nom Projet 2</div>
                                </div>
                                <div class="card__detail">
                                    <div class="card__source text-bold">------------------</div>
                                    <div class="card__description">Sous tache 1</div>
                                    <div class="card__description">Sous tache 2</div>
                                </div>
                            </div>
                            <div class="card__row">
                                <div class="card__icon"><i class="fas fa-book"></i></div>
                                <div class="card__time">
                                    <div class="text-bold">Nom Projet 3</div>
                                </div>
                                <div class="card__detail">
                                    <div class="card__source text-bold">------------------</div>
                                    <div class="card__description">Sous tache 1</div>
                                    <div class="card__description">Sous tache 2</div>
                                </div>
                            </div-->
                </div>
            </div>

        </div>
        <div class="modal fade" id="second_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #2B3467; color :white;">
                        <h4 class="modal-title w-100 ">Créer une sous-tâche</p>
                        </h4>
                        <p id='recupid' value=""></p>

                        <button type="button" class="close" style="color : white;" data-dismiss="modal">&times;</button>
                    </div>

                    <form>
                        <div class="modal-body" style=" text-align: left;">
                            <!-- adding Bootstrap Form here -->

                            <div class="form-group row">
                                <label for="nom_tache" class="col-sm-4 col-form-label" style="font-size: 16px; color: black;">Nom de la sous-tâche</label>
                                <div class="col-sm-8" style="margin-top: 4px;">
                                    <input type="text" id="nom_tache" required />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="duree" class="col-sm-4 col-form-label" style="font-size: 16px; color: black;">Durée estimée :</label>
                                <div class="col-sm-8" style="margin-top: 4px;">
                                    <input type="text" name="duree" id="duree" placeholder="....1/2j" style="width: 150px;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="priori" class="col-sm-4 col-form-label" style="font-size: 16px; color: black;">Ordre de priorité : </label>
                                <div class="col-sm-8" style="margin-top: 4px;">
                                    <select name="priori" id="priori">
                                        <option value="élevé">Elevé</option>
                                        <option value="moyen">Moyen</option>
                                        <option value="faible">Faible</option>
                                    </select>
                                </div>
                            </div>


                            <br>
                            <br>

                            <div style="right:10px; position: absolute; padding: 10px;">
                                <button style="margin-right: 5px;" type="button" class="btn btn-secondary" onclick="tache(document.getElementById('nom_tache').value,
                                                                                                            document.getElementById('duree').value,
                                                                                                            document.getElementById('recupid').value,
                                                                                                            document.getElementById('priori').value)">Enregistrer</button><button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                            </div>
                            <br>
                            <br>
                    </form>
                </div>

            </div>
        </div>
        <div id="modo" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Modal body text goes here.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #2B3467; color :white;">
                        <h4 class="modal-title w-100 ">Créer un projet</h4>
                        <button type="button" style="color : white;" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" style=" text-align: left;">

                        <div class="container">

                            <div class="form-group row">
                                <label for="id" class="col-sm-4 col-form-label" style="font-size: 16px; color: black;">Nom du projet</label>
                                <div class="col-sm-8" style="margin-top: 4px;">
                                    <input type="text" id="nom_projet" required />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="id" class="col-sm-4 col-form-label" style="font-size: 16px; color: black;">Date de rendu</label>
                                <div class="col-sm-8" style="margin-top: 4px;">
                                    <input type="date" id="date_rendu" required />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="id" class="col-sm-4 col-form-label" style="font-size: 16px; color: black;">Adresse du projet</label>
                                <div class="col-sm-8" style="margin-top: 4px;">
                                    <input type="text" id="adresse_proj" required />
                                </div>
                            </div>
                            <br>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="create(document.getElementById('nom_projet').value,
                                                                                                                    document.getElementById('date_rendu').value,
                                                                                                                    document.getElementById('adresse_proj').value)">Enregistrer</button><button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div-->
    </div> <!-- /.main-cards -->





</body>
<script>
    function dragElement(elmnt) {
        var pos1 = 0,
            pos2 = 0,
            pos3 = 0,
            pos4 = 0;
        if (document.getElementById(elmnt.id + "header")) {
            document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
        } else {
            elmnt.onmousedown = dragMouseDown;
        }

        function dragMouseDown(e) {
            e = e || window.event;
            e.preventDefault();
            pos3 = e.clientX;
            pos4 = e.clientY;
            document.onmouseup = closeDragElement;
            document.onmousemove = elementDrag;
        }

        function elementDrag(e) {
            e = e || window.event;
            e.preventDefault();
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
            elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
        }

        function closeDragElement() {
            document.onmouseup = null;
            document.onmousemove = null;
        }
    }
</script>
<script>
    $(document).ready(function() {

        dragElement(document.getElementById("todo"));
        dragElement(document.getElementById("projet"));

        const element = document.querySelector("#todo");

        element.addEventListener("mouseover", maFonction);

        function maFonction() {
            // Code à exécuter en réponse à l'événement "dblclick"
            document.getElementById('projet').style.zIndex = '1';
            document.getElementById('todo').style.zIndex = '10';
        }

        const element1 = document.querySelector("#projet");

        element1.addEventListener("mouseover", maFonction1);

        function maFonction1() {
            // Code à exécuter en réponse à l'événement "dblclick"
            document.getElementById('projet').style.zIndex = '10';
            document.getElementById('todo').style.zIndex = '1';
        }




    });
</script>



<!--div class="card compta">

        < ADD CREDIT >
        <div class="container credit-add">
            <br>
            <h4><b>
                    <p class="retour-info-user" onclick="javascript:hideFormUser('credit-add','compta-list','compta')">
                        <i class='fas fa-angle-left'></i>
                        <?php echo "&nbsp Retour"; ?>
                    </p>
                    <button class="buttonPlan buttonsaveinfo buttongreen"> Enregistrer <i class='fas fa-save'> </i></button>
                </b></h4>
            <br>
            <div class="form-add-credit">
                <p>Motif</p><input type="text" class="input-user-mail" name="n-input-user-mail">
                <br>
                <p>Montant (crédit)</p><input type="text" class="input-user-mail" name="n-input-user-mail">
                <br>
                <p>Facture
                    <button onclick="" title="Ajouter une facture"><i class="far fa-file-pdf fa-2xl" style="color:red"></i></button>
                    <label class="add-receive">
                        <i class="fa fa-pen-to-square"></i>
                    </label>
                </p>
            </div>
            <br>
        </div>
        <END ADD CREDIT>

        <ADD DEBIT>
        <div class="container debit-add">
            <br>
            <h4><b>
                    <p class="retour-info-user" onclick="">
                        <i class='fas fa-angle-left'></i>
                        <!--?php echo "&nbsp Retour"; ?>
                    </p>
                    <button class="buttonPlan buttonsaveinfo buttongreen"> Enregistrer <i class='fas fa-save'> </i></button>
                </b></h4>
            <br>
            <div class="form-add-debit">
                <p>Motif</p><input type="text" class="input-user-mail" name="n-input-user-mail">
                <br>
                <p>Montant (débit)</p><input type="text" class="input-user-mail" name="n-input-user-mail">
                <br>
                <p>Facture
                    <button onclick="" title="Ajouter une facture"><i class="far fa-file-pdf fa-2xl" style="color:red"></i></button>
                    <label class="add-receive">
                        <i class="fa fa-pen-to-square"></i>
                    </label>
                </p>
            </div>
            <br>
        </div>
        < END ADD DEBIT-->

<!--div class="container compta-list">
            <br>
            <h4><b>
                    <i class='fas fa-money-bill-alt'></i>
                    <!--?php echo "&nbsp Comptabilité"; ?>
                    <div class="buttons-compta">
                        <button onclick="javascript:hideFormUser('compta-list','credit-add','compta')" class="buttonPlan buttonaddspent buttongreen"> Crédit <i class='fas fa-minus'> </i></button>
                        <button class="buttonPlan buttonadddebit"> Débit <i class='fas fa-plus'> </i></button>
                    </div>
                    <p class="solde">
                        Solde : 0,000,99 €
                    </p>
                    <br>
                </b></h4>
            <h3>
                <!--?php echo "&nbsp Liste des dépenses"; ?-->
<!--/h3>
        </div>
    </div-->

<script>

</script>
<script>
    $(document).ready(function() {
        $('#second_modal').on('hidden.bs.modal', function(e) {
            var designid = 0; //get the id
            document.getElementById('recupid').value = 0;
        });
        $('#second_modal').on('show.bs.modal', function(e) {

            var designid = $(e.relatedTarget).data('designid'); //get the id
            var dataString = 'designid=' + designid;
            document.getElementById('recupid').value = designid;

        });
        $('#second_modal').on('shown.bs.modal', function(e) {

            var designid = $(e.relatedTarget).data('designid'); //get the id
            var dataString = 'designid=' + designid;
            document.getElementById('recupid').value = designid;

        });


    });
    $(document).ready(function() {
        $('#modalprojet').on('show.bs.modal', function(e) {
            var designid = $(e.relatedTarget).data('designid');
            document.getElementById('recupid').value = designid;
        });
        $('#Modalsoustache').on('show.bs.modal', function(e) {
            var soustacheid = $(e.relatedTarget).data('soustacheid');
            document.getElementById('recupidtache').value = soustacheid;

        });
        $('#Modalsoustache').on('hidden.bs.modal', function(e) {
            window.location.reload();

        });
        $('#modalprojet').on('hidden.bs.modal', function(e) {
            window.location.reload();

        });

        var $filetache = $('#file-inputtache'),
            $labeltache = $filetache.next('label'),
            $labelTexttache = $labeltache.find('span'),
            $labelRemovetache = $('i.ramove'),
            $labelchecktache = $('i.check'),
            labelDefaulttache = $labelTexttache.text();


        // on file change
        $filetache.on('change', function(event) {
            var fileName = $filetache.val().split('\\').pop();
            if (fileName) {

                $labelTexttache.text(fileName);
                $labelRemovetache.show();
                $labelchecktache.show();
            } else {
                $labelTexttache.text(labelDefaulttache);
                $labelRemovetache.hide();
                $labelchecktache.hide();
            }
        });

        // Remove file   
        $labelRemovetache.on('click', function(event) {
            $filetache.val("");
            $labelTexttache.text(labelDefault);
            $labelRemovetache.hide();
            $labelchecktache.hide();
            console.log($filetache)
        });
        //-------------------------------------------------------------------------------------------------


        var $fileproj = $('#file-inputproj'),
            $label = $fileproj.next('label'),
            $labelText = $label.find('span'),
            $labelRemove = $('i.removeproj'),
            $labelcheck = $('i.check'),
            labelDefault = $labelText.text();

        // on file change
        $fileproj.on('change', function(event) {
            var fileName = $fileproj.val().split('\\').pop();
            if (fileName) {

                $labelText.text(fileName);
                $labelRemove.show();
                $labelcheck.show();
            } else {
                $labelText.text(labelDefault);
                $labelRemove.hide();
                $labelcheck.hide();
            }
        });

        // Remove file   
        $labelRemove.on('click', function(event) {
            $fileproj.val("");
            $labelText.text(labelDefault);
            $labelRemove.hide();
            $labelcheck.hide();
            console.log($fileproj)
        });


    });
</script>

<script>
    const container = document.getElementById("todolist");
    const btn = document.getElementById("bouutn");

    btn.addEventListener("click", function() {
        const input = document.createElement("input");
        container.replaceChild(input, btn);

        input.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                const br2 = document.createElement("br");

                const label = document.createElement("label");
                label.textContent = input.value;

                const checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.checked = false;

                container.appendChild(checkbox);
                container.appendChild(label);

                container.appendChild(br2);

                const newBtn = document.createElement("button");
                newBtn.textContent = "+";
                newBtn.addEventListener("click", function() {
                    container.replaceChild(input, newBtn);
                    input.value = "";
                    input.focus();
                });

                container.appendChild(newBtn);
                container.removeChild(input);
            }
        });

        input.focus();
    });
</script>