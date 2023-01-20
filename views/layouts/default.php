<!--  HEADER  -->
<link rel="stylesheet" href="css/navlateral.css">
<link rel="stylesheet" href="font-awesome/css/all.css">
<link rel="stylesheet" href="font-awesome/css/all.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<header>
  <div class="sidebar">
    <div class="logo-details">
      <i class='fas fa-tools'></i>
        <div class="logo_name">COMETH outils</div>
        <i id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li>
        <a href="users">
          <i class='fas fa-calendar'></i>
          <span class="links_name">Tableau de bord</span>
        </a>
         <span class="tooltip">Tableau de bord</span>
      </li>
      <li>
       <a href="calendars">
         <i class='fas fa-file-invoice' ></i>
         <span class="links_name">Calendrier hebdo</span>
       </a>
       <span class="tooltip">Calendrier hebdomadaire</span>
     </li>
     <!--
      <li>
       <a href="#">
         <i class='fas fa-money-bill-alt' ></i>
         <span class="links_name">Comptabilité</span>
       </a>
       <span class="tooltip">Comptabilité</span>
     </li>
     <li>
       <a href="#">
         <i class='fas fa-server' ></i>
         <span class="links_name">Banque de données</span>
       </a>
       <span class="tooltip">Banque de données</span>
     </li>
     <li>
       <a href="#">
         <i class='fas fa-mail-bulk' ></i>
         <span class="links_name">Messagerie</span>
       </a>
       <span class="tooltip">Messagerie</span>
     </li>
     <li>
       <a href="#">
         <i class='fas fa-users' ></i>
         <span class="links_name">Listes utilisateurs</span>
       </a>
       <span class="tooltip">Listes utilisateurs</span>
     </li>
     <li>
       <a href="#">
         <i class='fas fa-ad' ></i>
         <span class="links_name">Gestion commercial</span>
       </a>
       <span class="tooltip">Gestion commercial</span>
     </li>
     <li>
       <a href="#">
         <i class='fas fa-cog' ></i>
         <span class="links_name">Paramètres</span>
       </a>
       <span class="tooltip">Paramètres</span>
     </li>
     -->
     <li class="profile">
         <div class="profile-details">
           <img src="images/profile.jpg" alt="profileImg">
           <div class="name_job">
             <div class="name"><?php echo ($users[0]->{'name'}) ?></div>
             <div class="job">Administrateur</div>
           </div>
         </div>
         <i class='fas fa-sign-out' id="log_out" ></i>
     </li>
    </ul>
  </div>
  <script src="js/user.js"></script>
</header>

<main style="display:inline-flex;justify-content: space-evenly;">

	<?= $content ?>

</main>


<footer>
	<!-- <p>&copy; 2022</p> -->
</footer>