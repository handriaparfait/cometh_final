<?php

?>

<link rel="stylesheet" href="css/main.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<script src="js/calendar.js"></script>

<body>
    <!-- DEBUT -->
    <div class="calendar-body">
        <div style="display: inline-flex;">
            <!-- DESSINER CALENDRIER -->
            <div class="content-calendar-list-projet">
                <h2 class="NoteCalendrierHedbomadaire"> Le calendrier hebdomadaire de cette semaine </h2>
                <div class="action-calendar-hebdo">
                    <button class="buttonPlan buttonEmptyTableHebdo buttongray " name="<?php /*echo $legende ?>" id="<?php echo $jour[$i+1]*/ ?>" onclick="javascript:emptyCalendar(1)" > Vider le calendrier hebdomadaire <i class='fas fa-trash'> </i></button>
                    <!--<button class="buttonPlan buttonArchiverTableHebdo buttongray" name="<?php /*echo $legende ?>" id="<?php echo $jour[$i+1]*/ ?>" onclick="javascript:archiver(1)" > Archivage manuelle <i class='fa-solid fa-file-export'> </i></button> -->
                    <!--<button class="buttonPlan buttonArchiverTableHebdo buttongray" name="<?php /*echo $legende ?>" id="<?php echo $jour[$i+1]*/ ?>" onclick="//javascript:archiver()" > Voir les archives hebdomadaires <i class='fa-solid fa-box-archive'> </i></button> -->
                </div>
                <table class="tableHebdomadaire">
                    <?php //showcalendar() 
                    ?>
                    <?php
                    #Jour de la semain
                    $jour = array(null, "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
                    ?>
                    <tr>
                        <th> Tableau hebdomadaire</th>
                        <?php
                        for ($x = 1; $x < 8; $x++) { #Afficher jour de la semaine
                        ?>
                            <th>
                                <?php echo $jour[$x] ?>
                            </th>
                        <?php } ?>
                    </tr>
                    <?php
                    for ($j = 0; $j < 2; $j += 0.5) {
                    ?>
                        <tr>
                            <?php
                            for ($i = 0; $i < 7; $i++) {
                                $heure = str_replace(".5", ":30", $j);
                                if ($i == 0) {
                                    $heure = str_replace(".5", ":30", $j);
                                    #Afficher matin
                                    if ($j < 1) {
                                        $legende = "matin";
                                        if (substr($heure, -3, 3) != ":30") echo "<td class=\"time\" rowspan=\"2\">Matin</td>";
                                    }
                                    #Afficher soir
                                    else {
                                        $legende = "soir";
                                        if (substr($heure, -3, 3) != ":30") echo "<td class=\"time\" rowspan=\"2\">Soir</td>";
                                    }
                                }
                                #Afficher le contenu des semaines
                                ?>
                                <td <?php echo "name=". $jour[$i+1]  ."_". $legende;
                                    if (substr($heure, -3, 3) != ":30"){
                                         echo " style=\"border-bottom:hidden\"";
                                    }  
                                    else{ 
                                        echo " style=\"vertical-align:bottom\"" ;
                                    }?>>
                                    <?php
                                    foreach($planningweekly as $planning){
                                        if($planning->{'jour'} == $jour[$i + 1]){
                                            if (substr($heure, -3, 3) != ":30"){  #afficher les tâches
                                                if($planning->{'horaire'} == $legende){?>
                                                    <div class='post-it' contenteditable>
                                                    <i class="fa-solid fa-angles-right"style='display:inline-flex'>
                                                        <h3 id= <?php echo $planning->{'id_tache'} ?> ><?php 
                                                            echo "&nbsp&nbsp&nbsp&nbsp" 
                                                            . $planning->{'nom_tache'};
                                                            echo "<br>";  ?>
                                                        </h3>
                                                    </i>
                                                    </div>
                                                <?php
                                                }
                                            }
                                        }
                                    }
                                    if (substr($heure, -3, 3) == ":30"){  #afficher des boutons
                                    ?>
                                        <script> var listunderstain = <?php echo json_encode($underStains); ?>; </script>
                                        <button class="buttonPlan buttonblack" name="<?php echo $legende ?>" id="<?php echo $jour[$i+1] ?>" onclick="javascript:afficherSousTaches(listunderstain,this.id,this.name,1)"> Ajouter <i class='fas fa-plus'> </i></button>
                                        <button class="buttonPlan" name="<?php echo $legende ?>" id="<?php echo $jour[$i+1] ?>" onclick="javascript:afficherSousTachesSupp(this.id,this.name,1)" > Retirer <i class='fas fa-minus'> </i></button>
                                        <!--<button class="buttonPlan" name="<?php /*echo $legende ?>" id="<?php echo $jour[$i+1]*/ ?>" onclick="javascript:afficherSousTachesSupp(this.id,this.name)" > Vider colonne <i class='fas fa-remove'> </i></button> -->
                                    <?php
                                    }
                                    ?>
                                </td>
                            <?php 
                            } 
                            ?>
                        </tr> <?php
                    } ?>
                </table>
            </div>
            <!-- FIN DESSINER CALENDRIER -->
            <!-- DEBUT BUDGET PREVISIONNEL -->
            <div class="information_calendar_hebdo" >
                    <div class="card understain budgetPrevisionnel">
                        <div class="container understain-list">
                            <br>
                            <h4>
                                <b>
                                    <i style="color:#338fd7;" class='fas fa-tasks fa-lg'></i>
                                    <p style="color:#338fd7; display:initial;"><?php echo "&nbsp Estimation du chiffre d'affaire"; ?> </p>
                                    <!-- affichage des sous tâches -->
                                    <div>
                                        <i>
                                            <li>
                                                Profit d'une tâche : 
                                                <?php
                                                    echo " " . ($users[0]->{'profit_per_task'})
                                                ?>
                                                &nbsp;&nbsp;<button class="buttonPlan buttonblack" onclick="javascript:changeProfitPerTask()"> <b>Modifier</b> <i class='fas fa-edit fa-xl'> </i></button>
                                            </li>
                                            <li>
                                                Profit prévisionnel : 
                                                <?php
                                                    $profitUneTache = ($users[0]->{'profit_per_task'});
                                                    $nombreTache = 0;
                                                    foreach($planningweekly as $task){
                                                        $nombreTache++;
                                                    }
                                                    $profitPrev = $nombreTache * $profitUneTache;
                                                    echo $nombreTache * $profitUneTache . " euros";
                                                ?>
                                            </li>
                                        </i>
                                    </div>
                                    <i style="color:#338fd7;" class='fas fa-tasks fa-lg'></i>
                                    <p style="color:#338fd7; display:initial;" > <?php echo "&nbsp Chiffre d'affaire réel "; ?> </p>
                                    <div>
                                        <i>
                                            <li>
                                                Profit réel : 
                                                <?php
                                                $profitUneTache = ($users[0]->{'profit_per_task'});
                                                $nombreTache = 0;
                                                foreach($planningPrev as $task){
                                                    $nombreTache++;
                                                }
                                                $profitReel = $nombreTache * $profitUneTache;
                                                $styleColor = 'color:#32de84;';
                                                if($profitReel < $profitPrev){
                                                    $styleColor = 'color:#fd5c63;'; 
                                                }
                                                echo  "<p style='display:initial;". $styleColor ."'>" . $profitReel . " euros" ."<p>";

                                                ?>
                                            </li>
                                        </i>
                                    </div>
                                </b>
                            </h4>
                        </div>
                        <div class="container understain-list">
                            <h4><b>
                            <i style="color:#338fd7;" class='fas fa-tasks fa-lg' ></i>
                                    <p style="color:#338fd7; display:initial;"> <?php echo "&nbsp Liste des archives prévisionnelles"; ?> </p>
                                    <!-- affichage des sous tâches -->
                                    <?php foreach($archivesByDate as $archiveData){ 
                                        echo "<li>" . ($archiveData->{'date'});
                                            echo "&nbsp;&nbsp;<button class='buttonPlan buttonblack' onclick='javascript:detailArchive(\"". ($archiveData->{'date'}) ."\")'> <b>Télécharger</b> <i class='fas fa-download fa-xl'> </i></button>";                            
                                            echo "&nbsp;&nbsp;<button class='buttonPlan buttonblack' onclick='javascript:retirerArchive(\"". ($archiveData->{'date'}) ."\")'> <b></b> <i class='fas fa-trash fa-xl'> </i>.</button>";                            
                                        echo "</li>";
                                    }?>
                                    <!-- fin affichage de sous tâches -->
                                    <br>
                                </b></h4>
                        </div>
                    </div>
            </div>
            <!-- FIN BUDGET PREVISIONNEL -->    
    </div>
    <!-- FIN -->


<!-- DESSINER CALENDRIER PREVISIONNEL -->
    <div class="content-calendar-list-projet-prev">
        <h2 class="NoteCalendrierHedbomadaire"> Le calendrier prévisionnel de cette semaine </h2>
            <div class="action-calendar-hebdo">
                <button class="buttonPlan buttonEmptyTableHebdo buttongray " name="<?php /*echo $legende ?>" id="<?php echo $jour[$i+1]*/ ?>" onclick="javascript:emptyCalendar(0)" > Vider le calendrier previsionnel &nbsp;<i class='fas fa-trash'> </i></button>
                <button class="buttonPlan buttonArchiverTableHebdo buttongray " name="<?php /*echo $legende ?>" id="<?php echo $jour[$i+1]*/ ?>" onclick="javascript:archiver(0)" > Archivage manuelle <i class='fa-solid fa-file-export'> </i></button>
                <!--<button class="buttonPlan buttonArchiverTableHebdo buttongray " name="<?php /*echo $legende ?>" id="<?php echo $jour[$i+1]*/ ?>" onclick="//javascript:archiver()" > Voir les archives prévisionnels <i class='fa-solid fa-box-archive'> </i></button> -->
            </div>
            <table class="tablePrevisionnel">
                    <?php //showcalendar() 
                    ?>
                    <?php
                    #Jour de la semain
                    $jour = array(null, "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
                    ?>
                    <tr>
                        <th> Tableau prévisionnel</th>
                        <?php
                        for ($x = 1; $x < 8; $x++) { #Afficher jour de la semaine
                        ?>
                            <th>
                                <?php echo $jour[$x] ?>
                            </th>
                        <?php } ?>
                    </tr>
                    <?php
                    for ($j = 0; $j < 2; $j += 0.5) {
                    ?>
                    <tr>
                            <?php
                            for ($i = 0; $i < 7; $i++) {
                                $heure = str_replace(".5", ":30", $j);
                                if ($i == 0) {
                                    $heure = str_replace(".5", ":30", $j);
                                    #Afficher matin
                                    if ($j < 1) {
                                        $legende = "matin";
                                        if (substr($heure, -3, 3) != ":30") echo "<td class=\"time\" rowspan=\"2\">Matin</td>";
                                    }
                                    #Afficher soir
                                    else {
                                        $legende = "soir";
                                        if (substr($heure, -3, 3) != ":30") echo "<td class=\"time\" rowspan=\"2\">Soir</td>";
                                    }
                                }
                                #Afficher le contenu des semaines
                                ?>
                                <td
                                <?php echo "name=". $jour[$i+1]  ."_". $legende;
                                    if (substr($heure, -3, 3) != ":30"){
                                         echo " style=\"border-bottom:hidden\"";
                                    }  
                                    else{ 
                                        echo " style=\"vertical-align:bottom\"" ;
                                    }?>>
                                    <?php
                                    foreach($planningPrev as $planning){
                                        if($planning->{'jour'} == $jour[$i + 1]){
                                            if (substr($heure, -3, 3) != ":30"){  #afficher les tâches
                                            if($planning->{'horaire'} == $legende){?>
                                                <div class='post-it' contenteditable>
                                                    <i class="fa-solid fa-angles-right"style='display:inline-flex'>
                                                        <h3 id= <?php echo $planning->{'id_tache'} ?> ><?php 
                                                            echo "&nbsp&nbsp&nbsp&nbsp" 
                                                            . $planning->{'nom_tache'};
                                                            echo "<br>";  ?>
                                                        </h3>
                                                    </i>
                                                </div>
                                            <?php
                                            }}
                                        }
                                    }
                                    if (substr($heure, -3, 3) == ":30"){  #afficher des boutons
                                    ?>
                                        <script> var listunderstain = <?php echo json_encode($underStains); ?>; </script>
                                        <button class="buttonPlan buttonblack" name="<?php echo $legende ?>" id="<?php echo $jour[$i+1] ?>" onclick="javascript:afficherSousTaches(listunderstain,this.id,this.name,0)"> Ajouter <i class='fas fa-plus'> </i></button>
                                        <button class="buttonPlan" name="<?php echo $legende ?>" id="<?php echo $jour[$i+1] ?>" onclick="javascript:afficherSousTachesSupp(this.id,this.name,0)" > Retirer <i class='fas fa-minus'> </i></button>
                                        <!--<button class="buttonPlan" name="<?php /*echo $legende ?>" id="<?php echo $jour[$i+1]*/ ?>" onclick="javascript:afficherSousTachesSupp(this.id,this.name)" > Vider colonne <i class='fas fa-remove'> </i></button> -->
                                    <?php
                                    }
                                    ?>
                                </td>
                            <?php 
                            } 
                            ?>
                    </tr> <?php
                            } ?>
            </table>
    </div>
<!-- FIN DESSINER CALENDRIER PREVISIONNEL -->  

    <?php
        /*
        $file = "test.txt";
        $txt = fopen($file, "w") or die("Unable to open file!");
        fwrite($txt, "lorem ipsum");
        fclose($txt);
        
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        header("Content-Type: text/plain");
        readfile($file);
        */
    ?>

</div>
<!-- FIN BUDGET PREVISIONNEL -->
          
    

</body>