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

    function displayPlans(){

    }
?>

<link rel="stylesheet" href="css/main.css">
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
        <p class="planmonth"><?php echo "Ce mois"?></p>
        <b><h4>
    </b></h4>
    <ul class="listPlans">
        <?php foreach($plannings as $planning){ ?>
            <li>
                <?php echo ($planning->{'plan_name'}) ?> 
                <button><i class="far fa-file-pdf fa-2xl" style="color:red" ></i></button>
                <button><i class="far fa-file-pdf fa-2xl" style="color:red"></i></button>
                <ul class="subListPlan">
                    <?php echo ($planning->{'plan_date'} . " à " . $planning->{'plan_adresse'} ) ?> 
                </ul>
                <br>
            </li>
        <?php } ?>
    </ul>
    <br>
     <p class="planmonth2"><?php echo "Passés"?></p>
    <br>
     <p class="planmonth3"><?php echo "Futur"?></p>
  </div>
</div>



</body>