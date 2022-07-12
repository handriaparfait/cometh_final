<?php
    function convert($hour){
        if($hour == null) return "00h00";
        else return "" . $hour . "";
    }

    function isAdmin($admin){
        if($admin == 1) return "Administrateur";
        else return "Utilisateur";
    }

    function currentPlan($plan){
        if($plan == "false") return "Aucun commencé" ;
        else{
            $text = $plan[0]->{"plan_name"} . " <small><i> (". $plan[0]->{"plan_date"}  ." à " . $plan[0]->{"plan_adresse"} . ") </i></small>";
            return $text;
        }
    }

    function buttonDisabled($idpl,$currentpl,$ispaused){
        //var_dump($idpl);
        //var_dump($currentpl[0]);
        //var_dump($ispaused);
        if($currentpl == "false") return "";
        else if($currentpl[0]->{"plan_id"} == $idpl){
            if($currentpl[0]->{'ispaused'} == 1) return "";
            else return "disabled";
        }
        else{
            return "disabled";
        }
    }

    function buttonDisabled2($currentpl){
        if($currentpl[0]->{'ispaused'} == 1) return "disabled";
        else return "";
    }

    function currentPlanPauseClass($plan){
        if($plan[0]->{"ispaused"} == 1) return "buttonPlan blocked";
        else return "buttonPlan pause";
    }

    function currentPlanEndClass($plan){
        if($plan[0]->{"ispaused"} == 1) return "buttonPlan blocked";
        else return "buttonPlan end";
    }

    function currentPlanText($plan){
        if($plan == "false") return "Commencer";
        else if($plan[0]->{"ispaused"} == 1) return "Reprendre";
        else return "Commencer";
    }

    function currentPlanClass($plan,$idplan,$plan2){
        if($plan != null){
            if($plan == $idplan){
                if($plan2[0]->{"ispaused"} == 0) return "buttonPlan blocked";
                else return "buttonPlan"; 
            }
            return "buttonPlan blocked";  
        } 
        else return "buttonPlan";
    }

    function taskClass($level){
        if($level == "PR") return "prioritaire";
        else if($level == "AF") return "afaire";
        else if($level == "LB") return "libre";
    }

    function taskLevelName($level){
        if($level == "PR") return "Prioritaire";
        else if($level == "AF") return "A faire";
        else if($level == "LB") return "Libre";
    }



?>

<link rel="stylesheet" href="css/main.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<body>

<div class="card infouser">

  <div class="container">
  <br>
    <h4><b>
        <i class='fas fa-user' ></i>
        <?php echo "&nbsp Informations"; ?>
        <button class="buttonPlan buttonchangeinfo buttongreen"> Modifier <i class='fas fa-edit'> </i></button>
        <br>
    </b></h4>
  <img src="images/profile.jpg" alt="Avatar">
    <h4><b>
        <i class='far fa-envelope fa-lg' ></i>
        <?php echo "&nbsp" . ($users[0]->{'email'}) ?>
        <br></b></h4>
        <p class="fonction"><?php echo isAdmin($users[0]->{'admin'})?></p>
        <br><b><h4>
        <i class='far fa-clock fa-lg' ></i>
        <?php echo "&nbspHoraires de travail :"?>
    </b></h4>
    <p class="horaires">
        <?php echo "Matin (Début) : " . convert(($users[0]->{'h_debut1'})) ?>  
        <br>
        <?php echo "Matin (Fin) : " . convert(($users[0]->{'h_fin1'})) ?>    
        <br>
        <?php echo "Soir (Début) : " . convert(($users[0]->{'h_debut2'})) ?>  
        <br>
        <?php echo "Soir (Fin) : " . convert(($users[0]->{'h_fin2'})) ?>  
        <br>
    </p>
    <h4><b><br>
        <i class="fas fa-calculator fa-lg"></i>
        <?php echo "&nbspPlanning en cours" ?>
    </b></h4>
        <p class="currentplan">
            <?php echo currentPlan($currentplanning) ?>
            <?php if(currentPlan($currentplanning) != "Aucun commencé") { ?>
                    <button class="<?php echo currentPlanPauseClass($currentplanning)?>" onclick="javascript:pausePlanning(<?php echo ($users[0]->{'current_plan'})?>)" <?php echo buttonDisabled2($currentplanning) ?>> Pause</button>
                    <button class="<?php echo currentPlanEndClass($currentplanning) ?>" onclick="javascript:endPlanning(<?php echo ($users[0]->{'current_plan'})?>)" <?php echo buttonDisabled2($currentplanning) ?>> Fin</button>
            <?php } ?>
        </p>
  </div>
</div>


<div class="card planning">
  <div class="container">
  <br>
    <h4><b>
        <i class='far fa-calendar fa-lg' ></i>
        <?php echo "Les plannings" ?>
        <button class="buttonPlan buttonaddplanning buttongreen"> Ajouter <i class='fas fa-plus'> </i></button>
        <br></b></h4>
        
        <b><h4>
    </b></h4>
    <ul class="listPlans">
        <?php foreach($plannings as $planning){ $finished = date("Ym",strtotime(($planning->{'plan_date'}))); ?>
            <?php if((date("Ym",time()) > $finished)){ ?> <p class="planmonth2"><?php echo " Passés"?></p> <?php } ?>
            <?php if((date("Ym",time()) == $finished)){ ?> <p class="planmonth"><?php echo " Ce mois"?></p> <?php } ?>
            <?php if((date("Ym",time()) < $finished)){ ?> <p class="planmonth3"><?php echo " Futur"?></p> <?php } ?>
           
            
            <li>
                <?php echo ($planning->{'plan_name'}) ?> 
                
                <!--PDF1-->
                <button id="button-pdf-file-1" onclick="javascript:downloadPdf('1',<?php echo ($planning->{'plan_id'}) ?>)" title="<?php  echo ($planning->{'pdf1_name'})  ?>"><i class="far fa-file-pdf fa-2xl" style="color:red" ></i></button>
                <form id='form-upload-1-<?php echo ($planning->{'plan_id'}) ?>'>
                <label for="file-upload-1-<?php echo ($planning->{'plan_id'}) ?>" class="custom-file-upload">
                    <i class="fa fa-pen-to-square"></i>
                </label>
                <input name="myfile" id="file-upload-1-<?php echo ($planning->{'plan_id'}) ?>" accept="application/pdf" type="file" onchange="javascript:uploadPdf('1',<?php echo ($planning->{'plan_id'}) ?>)"/>
                </form>
                
                <!--PDF2-->
                <button onclick="javascript:downloadPdf('2',<?php echo ($planning->{'plan_id'}) ?>)"  title="<?php  echo ($planning->{'pdf2_name'})  ?>"><i class="far fa-file-pdf fa-2xl" style="color:red"></i></button>
                <form id='form-upload-2-<?php echo ($planning->{'plan_id'}) ?>'>
                <label for="file-upload-2-<?php echo ($planning->{'plan_id'}) ?>" class="custom-file-upload">
                    <i class="fa fa-pen-to-square"></i>
                </label>
                <input  id="file-upload-2-<?php echo ($planning->{'plan_id'}) ?>" type="file" accept="application/pdf" onchange="javascript:uploadPdf('2',<?php echo ($planning->{'plan_id'}) ?>)"/>
                </form>

                <!--PDF3-->
                <button onclick="javascript:downloadPdf('3',<?php echo ($planning->{'plan_id'}) ?>)" title="<?php  echo ($planning->{'pdf3_name'})  ?>"><i class="far fa-file-pdf fa-2xl" style="color:red"></i></button>
                <form id='form-upload-3-<?php echo ($planning->{'plan_id'}) ?>'>
                <form id='form-upload-3-<?php echo ($planning->{'plan_id'}) ?>'>
                <label for="file-upload-3-<?php echo ($planning->{'plan_id'}) ?>" class="custom-file-upload">
                    <i class="fa fa-pen-to-square"></i>
                </label>
                <input  id="file-upload-3-<?php echo ($planning->{'plan_id'}) ?>" type="file" accept="application/pdf" onchange="javascript:uploadPdf('3',<?php echo ($planning->{'plan_id'}) ?>)"/>
                </form>

                <!--COMMENCER-->
                <button class="<?php echo currentPlanClass(($users[0]->{'current_plan'}), ($planning->{'plan_id'}), $currentplanning) ?>" role="button" onclick="javascript:startPlanning(<?php echo ($planning->{'plan_id'}) ?>)" <?php echo buttonDisabled(($planning->{'plan_id'}),($currentplanning),($currentplanning)) ?>> <?php echo currentPlanText($currentplanning) ?> </button >
                <ul class="subListPlan">
                    <?php echo date('m-Y',strtotime($planning->{'plan_date'})) . " à " . ($planning->{'plan_adresse'}) ?>
                </ul>
                <br>
            </li>
        <?php } ?>
    </ul>

  </div>
</div>

<div class="card task">
  <div class="container">
    <br>
    <h4><b>
        <i class='fas fa-tasks fa-lg' ></i>
        <?php echo "&nbsp Tâches"; ?>
        <button class="buttonPlan buttonaddtask buttongreen"> Ajouter <i class='fas fa-plus'> </i></button>
        <br>
    </b></h4>
        <ul class="listTask">
            <?php foreach($tasks as $task){ ?>
                <li>
                    <input type="checkbox" id="tsk-<?php echo $task->{"task_id"} ?>">
                    <label class="<?php echo taskClass($task->{"task_level"}) ?> tasklabel">
                    <?php echo taskLevelName($task->{"task_level"}) ?>
                    </label>
                    <?php echo $task->{"task_name"} ?>
                </li>
            <?php } ?>
        </ul>
  </div>
</div>

<div class="card compta">
  <div class="container">
    <br>
    <h4><b>
        <i class='fas fa-money-bill-alt' ></i>
        <?php echo "&nbsp Comptabilité"; ?>
        <button class="buttonPlan buttonaddspent buttongreen"> Dépense <i class='fas fa-plus'> </i></button>
        <p>
            Solde : 3,000,00 €
        </p>
        <br>
    </b></h4>
  </div>
</div>





</body>