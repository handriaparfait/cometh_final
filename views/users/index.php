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
        if($plan == null) return "Aucun commencé" ;
        else return $plan;
    }

    function currentPlanClass($plan){
        if($plan == null) return "buttonStartPlan";
        else return "buttonBlockedPlan";
    }

    function buttonDisabled($btn){
        if($btn == null) return "";
        else return "disabled";
    }

?>

<link rel="stylesheet" href="css/main.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<body>

<div class="card">
  <img src="images/profile.jpg" alt="Avatar">
  <div class="container">
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
            <?php echo currentPlan(($users[0]->{'current_plan'})) ?>  
            <br>
        </p>
  </div>
</div>


<div class="card planning">
  <div class="container">
  <br>
    <h4><b>
        <i class='far fa-calendar fa-lg' ></i>
        <?php echo "Les plannings" ?>
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
                <label for="file-upload-3-<?php echo ($planning->{'plan_id'}) ?>" class="custom-file-upload">
                    <i class="fa fa-pen-to-square"></i>
                </label>
                <input  id="file-upload-3-<?php echo ($planning->{'plan_id'}) ?>" type="file" accept="application/pdf" onchange="javascript:uploadPdf('3',<?php echo ($planning->{'plan_id'}) ?>)"/>
                </form>

                <!--COMMENCER-->
                <button class="<?php echo currentPlanClass(($users[0]->{'current_plan'})) ?>" role="button" onclick="javascript:startPlanning(<?php echo ($planning->{'plan_id'}) ?>)" <?php echo buttonDisabled(($users[0]->{'current_plan'})) ?>> Commencer </button >
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
        <br>
    </b></h4>
  </div>
</div>

</body>