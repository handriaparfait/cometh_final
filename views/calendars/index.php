<?php
    function showcalendar(){
        #Jour de la semain
        $jour = array(null, "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
        #Remplissage du tableau
        $rdv["Dimanche"]["matin"] = "PIC 2";
        $rdv["Lundi"]["soir"] = "PLANNING TEST 1";
        #Titre tableau
        echo "<tr><th> Demi journée</th>";
        #Afficher jour de la semain
        for($x = 1; $x < 8; $x++)
            echo "<th>".$jour[$x]."</th>";
        echo "</tr>";
        #Remplir le tableau
        for($j = 0; $j < 2; $j += 0.5) {
            echo "<tr>";
            for($i = 0; $i < 7; $i++) {
                $heure = str_replace(".5", ":30", $j);
                if($i == 0){
                    $heure = str_replace(".5", ":30", $j);
                    #Afficher matin
                    if($j < 1){ 
                        $legende = "matin";
                        if(substr($heure,-3,3) != ":30") echo "<td class=\"time\" rowspan=\"2\">Matin</td>";
                    }
                    #Afficher soir
                    else{
                        $legende = "soir";
                        if(substr($heure,-3,3) != ":30") echo "<td class=\"time\" rowspan=\"2\">Soir</td>";
                    }
                    
                }
                #Afficher le contenu des semaines
                echo "<td>";
                    if(isset($rdv[$jour[$i+1]][$legende])) {
                        if(substr($heure,-3,3) != ":30")
                        echo $rdv[$jour[$i+1]][$legende];
                    }
                echo "</td>";
            }
            echo "</tr>";
        }
    }
?>

<link rel="stylesheet" href="css/main.css">
<body>   

  <div class="content-calendar-list-projet">
      <!-- DESSINER CALENDRIER -->
      <table>
        <?php showcalendar() ?>
      </table>
      <!-- FIN DESSINER CALENDRIER -->

      <!-- DEBUT LISTE DES PROJETS -->
      <div class="card task">
          <div class="container task-list">
            <br>
            <h4><b>
                <i class='fas fa-tasks fa-lg' ></i>
                <?php echo "&nbsp Liste des projets"; ?>
            <br>
            </b></h4>
          </div>
      </div>
      <!-- FIN LISTE DES PROJETS -->
  </div>

</body>