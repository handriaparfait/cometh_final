<!--  HEADER  -->

<link rel="stylesheet" href="font-awesome/css/all.css">
<link rel="stylesheet" href="font-awesome/css/all.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<style>

  html,
  body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
  }

  a {
    text-decoration: none;
  }

  .text-light {
    font-weight: 300;
  }

  .text-bold {
    font-weight: bold;
  }

  .row {
    display: flex;
  }

  .row--align-v-center {
    align-items: center;
  }

  .row--align-h-center {
    justify-content: center;
  }

  .grid {
    position: relative;
    display: grid;
    grid-template-columns: 100%;
    grid-template-rows: 50px 1fr 50px;
    grid-template-areas: "header" "main" "footer";
    height: 100vh;
    overflow-x: hidden;
  }

  .grid--noscroll {
    overflow-y: hidden;
  }

  .header {
    grid-area: header;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #f9fafc;
  }

  .header__menu {
    position: fixed;
    padding: 13px;
    left: 12px;
    background-color: #dadae3;
    border-radius: 50%;
    z-index: 1;
  }

  .header__menu:hover {
    cursor: pointer;
  }

  .header__search {
    margin-left: 55px;
    font-size: 20px;
    color: #777;
  }

  .header__input {
    border: none;
    background: transparent;
    padding: 12px;
    font-size: 20px;
    color: #777;
  }

  .header__input:focus {
    outline: none;
    border: none;
  }

  .header__avatar {
    background-size: cover;
    background-repeat: no-repeat;
    border-radius: 50%;
    border: 2px solid rgba(255, 255, 255, 0.2);
    position: relative;
    margin: 0 26px;
    width: 35px;
    height: 35px;
    cursor: pointer;
  }

  .header__avatar:after {
    position: absolute;
    content: "";
    width: 6px;
    height: 6px;
    background: none;
    border-left: 2px solid #777;
    border-bottom: 2px solid #777;
    transform: rotate(-45deg) translateY(-50%);
    top: 50%;
    right: -18px;
  }

  .dropdown {
    position: absolute;
    top: 54px;
    right: -16px;
    width: 220px;
    height: auto;
    z-index: 1;
    background-color: #fff;
    border-radius: 4px;
    visibility: hidden;
    opacity: 0;
    transform: translateY(-10px);
    transition: all 0.3s;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.16), 0 0 0 1px rgba(0, 0, 0, 0.08);
  }

  .dropdown__list {
    margin: 0;
    padding: 0;
    list-style-type: none;
  }

  .dropdown__list-item {
    padding: 12px 24px;
    color: #777;
    text-transform: capitalize;
  }

  .dropdown__list-item:hover {
    background-color: rgba(0, 0, 0, 0.1);
  }

  .dropdown__icon {
    color: #1bbae1;
  }

  .dropdown__title {
    margin-left: 10px;
  }

  .dropdown:before {
    position: absolute;
    content: "";
    top: -6px;
    right: 30px;
    width: 0;
    height: 0;
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-bottom: 6px solid #fff;
  }

  .dropdown--active {
    visibility: visible;
    opacity: 1;
    transform: translateY(0);
  }

  .sidenav {
    position: fixed;
    grid-area: sidenav;
    height: 100%;
    overflow-y: auto;
    overflow-x: hidden;
    background-color: #394263;
    color: #fff;
    width: 240px;
    transform: translateX(-245px);
    transition: all 0.6s ease-in-out;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.16), 0 0 0 1px rgba(0, 0, 0, 0.08);
    z-index: 2;
  }

  .sidenav__brand {
    position: relative;
    display: flex;
    align-items: center;
    padding: 0 16px;
    height: 50px;
    background-color: rgba(0, 0, 0, 0.15);
  }

  .sidenav__brand-icon {
    margin-top: 2px;
    font-size: 14px;
    color: rgba(255, 255, 255, 0.5);
  }

  .sidenav__brand-close {
    position: absolute;
    right: 8px;
    top: 8px;
    visibility: visible;
    color: rgba(255, 255, 255, 0.5);
    cursor: pointer;
  }

  .sidenav__brand-link {
    font-size: 18px;
    font-weight: bold;
    color: #fff;
    margin: 0 15px;
    letter-spacing: 1.5px;
  }

  .sidenav__profile {
    display: flex;
    align-items: center;
    min-height: 90px;
    background-color: rgba(255, 255, 255, 0.1);
  }

  .sidenav__profile-avatar {
    background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/1609106/headshot.png");
    background-size: cover;
    background-repeat: no-repeat;
    border-radius: 50%;
    border: 2px solid rgba(255, 255, 255, 0.2);
    height: 64px;
    width: 64px;
    margin: 0 15px;
  }

  .sidenav__profile-title {
    font-size: 17px;
    letter-spacing: 1px;
  }

  .sidenav__arrow {
    position: absolute;
    content: "";
    width: 6px;
    height: 6px;
    top: 50%;
    right: 20px;
    border-left: 2px solid rgba(255, 255, 255, 0.5);
    border-bottom: 2px solid rgba(255, 255, 255, 0.5);
    transform: translateY(-50%) rotate(225deg);
  }

  .sidenav__sublist {
    list-style-type: none;
    margin: 0;
    padding: 10px 0 0;
  }

  .sidenav--active {
    transform: translateX(0);
  }

  .navList {
    width: 240px;
    padding: 0;
    margin: 0;
    background-color: #394263;
    list-style-type: none;
  }

  .navList__heading {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 16px 3px;
    color: rgba(255, 255, 255, 0.5);
    text-transform: uppercase;
    font-size: 15px;
  }

  .navList__subheading {
    position: relative;
    padding: 10px 30px;
    color: #fff;
    font-size: 16px;
    text-transform: capitalize;
  }

  .navList__subheading-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    color: rgba(255, 255, 255, 0.5);
    width: 12px;
  }

  .navList__subheading-title {
    margin: 0 15px;
  }

  .navList__subheading:after {
    position: absolute;
    content: "";
    height: 6px;
    width: 6px;
    top: 17px;
    right: 25px;
    border-left: 1px solid rgba(255, 255, 255, 0.5);
    border-bottom: 1px solid rgba(255, 255, 255, 0.5);
    transform: rotate(225deg);
    transition: all 0.2s;
  }

  .navList__subheading:hover {
    background-color: #303753;
    cursor: pointer;
  }

  .navList__subheading--open {
    background-color: #303753;
  }

  .navList__subheading--open:after {
    transform: rotate(315deg);
  }

  .navList .subList {
    padding: 0;
    margin: 0;
    list-style-type: none;
    background-color: #262c43;
    visibility: visible;
    overflow: hidden;
    max-height: 200px;
    transition: all 0.4s ease-in-out;
  }

  .navList .subList__item {
    padding: 8px;
    text-transform: capitalize;
    padding: 8px 30px;
    color: #d3d3d3;
  }

  .navList .subList__item:first-child {
    padding-top: 15px;
  }

  .navList .subList__item:hover {
    background-color: rgba(255, 255, 255, 0.1);
    cursor: pointer;
  }

  .navList .subList--hidden {
    visibility: hidden;
    max-height: 0;
  }

  .main {
    grid-area: main;
    padding-top: 10px;
    color: #394263;
  }

  .main__cards {
    column-count: 1;
    column-gap: 20px;
    margin: 20px;
  }

  .main-header {
    position: relative;
    display: flex;
    justify-content: space-between;
    height: 250px;
    color: #fff;
    background-size: cover;
    background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/1609106/lake-shadow-water.jpg");
    margin-bottom: 20px;
  }

  .main-header__intro-wrapper {
    display: flex;
    flex: 1;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    height: 160px;
    padding: 12px 30px;
    background: rgba(255, 255, 255, 0.12);
    font-size: 26px;
    letter-spacing: 1px;
  }

  .main-header__welcome {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .main-header__welcome-title {
    margin-bottom: 8px;
    font-size: 26px;
  }

  .main-header__welcome-subtitle {
    font-size: 18px;
  }

  .quickview {
    display: grid;
    grid-auto-flow: column;
    grid-gap: 60px;
  }

  .quickview__item {
    display: flex;
    align-items: center;
    flex-direction: column;
  }

  .quickview__item-total {
    margin-bottom: 2px;
    font-size: 32px;
  }

  .quickview__item-description {
    font-size: 16px;
    text-align: center;
  }

  .main-overview {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(265px, 1fr));
    grid-auto-rows: 94px;
    grid-gap: 30px;
    margin: 20px;
  }

  .overviewCard {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px;
    background-color: #fff;
    transform: translateY(0);
    transition: all 0.3s;
  }

  .overviewCard-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 60px;
    width: 60px;
    border-radius: 50%;
    font-size: 21px;
    color: #fff;
  }

  .overviewCard-icon--document {
    background-color: #e67e22;
  }

  .overviewCard-icon--calendar {
    background-color: #27ae60;
  }

  .overviewCard-icon--mail {
    background-color: #e74c3c;
  }

  .overviewCard-icon--photo {
    background-color: #af64cc;
  }

  .overviewCard-description {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .overviewCard-title {
    font-size: 18px;
    color: #1bbae1;
    margin: 0;
  }

  .overviewCard-subtitle {
    margin: 2px;
    color: #777;
  }

  .overviewCard:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 5px rgba(0, 0, 0, 0.1);
    cursor: pointer;
  }

  .card {
    display: flex;
    flex-direction: column;
    width: 100%;
    background-color: #fff;
    margin-bottom: 20px;
    -webkit-column-break-inside: avoid;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    border-radius: 10px;
  }

  .card:hover {
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
  }

  .card__header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 50px;
    background-color: #394263;
    color: #fff;
  }

  .card__header-title {
    margin: 0 20px;
    font-size: 20px;
    letter-spacing: 1.2px;
  }

  .card__header-link {
    font-size: 16px;
    color: #1bbae1;
    letter-spacing: normal;
    display: inline-block;
  }

  .card__main {
    position: relative;
    background-color: #fff;
  }

  .card__main:after {
    content: "";
    position: absolute;
    top: 0;
    left: 120px;
    bottom: 0;
    width: 2px;
    background-color: #f0f0f0;
  }

  .card__photo:hover {
    transform: scale(1.1);
    cursor: pointer;
  }

  .card__photo-wrapper {
    overflow: hidden;
  }

  .card__row {
    position: relative;
    display: flex;
    flex: 1;
    margin: 15px 0 20px;
  }

  .card__icon {
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    content: "";
    width: 30px;
    height: 30px;
    top: 0;
    left: 121px;
    transform: translateX(-50%);
    border-radius: 50%;
    color: #fff;
    background-color: #1bbae1;
    z-index: 1;
  }

  .card__row:nth-child(even) .card__icon {
    background-color: #e74c3c;
  }

  .card__time {
    display: flex;
    flex: 1;
    justify-content: flex-end;
    max-width: 80px;
    margin-left: 15px;
    text-align: right;
    font-size: 14px;
    line-height: 2;
  }

  .card__detail {
    display: flex;
    flex: 1;
    flex-direction: column;
    padding-left: 12px;
    margin-left: 48px;
    transform: translateX(0);
    transition: all 0.3s;
  }

  .card__description {
    width: 95%;
  }

  .card__description:hover {
    background-color: #f0f0f0;
    transform: translateX(4px);
    cursor: pointer;
  }

  .card__source {
    line-height: 1.8;
    color: #1bbae1;
  }

  .card__note {
    margin: 10px 0;
    color: #777;
  }

  .card--finance {
    position: relative;
  }

  .settings {
    display: flex;
    margin: 8px;
    align-self: flex-start;
    background-color: rgba(255, 255, 255, 0.5);
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 2px;
  }

  .settings__block {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 4px;
    color: #394263;
    font-size: 11px;
  }

  .settings__block:not(:last-child) {
    border-right: 1px solid rgba(0, 0, 0, 0.1);
  }

  .settings__icon {
    padding: 0px 3px;
    font-size: 12px;
  }

  .settings__icon:hover {
    background-color: rgba(255, 255, 255, 0.8);
    cursor: pointer;
  }

  .settings:hover {
    background-color: #fff;
    cursor: pointer;
  }

  .documents {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(105px, 1fr));
    grid-auto-rows: 214px;
    grid-gap: 12px;
    height: auto;
    background-color: #fff;
  }

  .document {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 15px 0 0;
    flex-direction: column;
  }

  .document__img {
    width: 105px;
    height: 136px;
    background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/1609106/doc-1.png");
    background-size: cover;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);
    cursor: pointer;
    transition: transform 0.3s ease;
  }

  .document__img:hover {
    transform: translateY(-4px);
  }

  .document__title {
    margin: 8px 0 2px;
    color: #777;
  }

  .document__date {
    font-size: 10px;
  }

  #chartdiv {
    width: 100%;
    height: 300px;
    font-size: 11px;
    min-width: 0;
  }

  .footer {
    grid-area: footer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 16px;
    color: #777;
    background-color: #fff;
  }

  .footer__copyright {
    color: #1bbae1;
  }

  .footer__icon {
    color: #e74c3c;
  }

  .footer__signature {
    color: #1bbae1;
    cursor: pointer;
    font-weight: bold;
  }

  @media only screen and (min-width: 1550px) {
    .grid {
      display: grid;
      grid-template-columns: 240px calc(100% - 240px);
      grid-template-rows: 50px 1fr 50px;
      grid-template-areas: "sidenav header" "sidenav main" "sidenav footer";
      height: 100vh;
    }

    .sidenav {
      position: relative;
      transform: translateX(0);
    }

    .sidenav__brand-close {
      visibility: hidden;
    }

    .main-header__intro-wrapper {
      padding: 0 30px;
    }

    .header__menu {
      display: none;
    }

    .header__search {
      margin-left: 20px;
    }

    .header__avatar {
      width: 40px;
      height: 40px;
    }
  }

  @media only screen and (min-width: 65.625em) {

    .main-header__intro-wrapper {
      flex-direction: row;
    }

    .main-header__welcome {
      align-items: flex-start;
    }
  }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

<body>
  <div class="row" style="margin-right: 0;">
    <div class="col-2">
      <div class="grid">
        <header class="header" style="margin-bottom : 100px; position : fixed; width: 100%; z-index: 20; background-color: #394263; height: 70px;">
          <i class="fas fa-bars header__menu"></i>
          <div class="header__search">
            <input class="header__input" placeholder="Search..." />
          </div>
          <div class="header__avatar">
            <div class="im-prof">
              <img src="https://i.pinimg.com/736x/27/cd/7f/27cd7f91d768f1e85aa8d7484f303fae.jpg" alt="" style="height: 40px; width: 40px; border-radius: 50%;">

            </div>
            <div class="dropdown">
              <ul class="dropdown__list">
                <li class="dropdown__list-item">
                  <span class="dropdown__icon"><i class="far fa-user"></i></span>
                  <span class="dropdown__title">Mon compte</span>
                </li>
                <li class="dropdown__list-item">
                  <span class="dropdown__icon"><i class="fas fa-sign-out-alt"></i></span>
                  <span class="dropdown__title">Se deconnecter</span>
                </li>
              </ul>
            </div>
          </div>
        </header>

        <aside class="sidenav" style="z-index: 100; position: fixed;">
          <div class="sidenav__brand" style="padding: 10px; height: 70px;">
            <div class="logo" >
              <img src="https://img.freepik.com/vecteurs-premium/caricature-batiments-etat-reel_18591-40701.jpg?w=2000" style="height: 50px; width: 50px; border-radius: 50%;" alt="logo">
            </div>

            <a class="sidenav__brand-link" href="#">COMETH<span class="text-light" style="font-size: small;"> Outils</span></a>
            <i class="fas fa-times sidenav__brand-close"></i>
          </div>
          <div class="row row--align-v-center row--align-h-center">
            <ul class="navList">
              <li>
                <a href="users" style="text-decoration: none;">
                  <div class="navList__subheading row row--align-v-center">
                    <span class="navList__subheading-title">Dashboard</span>
                  </div>
                </a>
              </li>
              <li>
                <a href="calendars" style="text-decoration: none;">
                  <div class="navList__subheading row row--align-v-center">
                    <span class="navList__subheading-title">Calendriers</span>
                  </div>
                </a>

              </li>
            </ul>
          </div>
        </aside>
      </div>
    </div>
    <div class="col-10" style="position: relative; margin-top:70px;">
      <div class="main">
        <?= $content ?>
      </div>
    </div>
  </div>
</body>

<script src="js/user.js"></script>


<footer>
  </footer-->

  <script>
    /* Scripts for css grid dashboard */

    $(document).ready(() => {
      addResizeListeners();
      setSidenavListeners();
      setUserDropdownListener();
      renderChart();
      setMenuClickListener();
      setSidenavCloseListener();
    });

    // Set constants and grab needed elements
    const sidenavEl = $('.sidenav');
    const gridEl = $('.grid');
    const SIDENAV_ACTIVE_CLASS = 'sidenav--active';
    const GRID_NO_SCROLL_CLASS = 'grid--noscroll';

    function toggleClass(el, className) {
      if (el.hasClass(className)) {
        el.removeClass(className);
      } else {
        el.addClass(className);
      }
    }

    // User avatar dropdown functionality
    function setUserDropdownListener() {
      const userAvatar = $('.header__avatar');

      userAvatar.on('click', function(e) {
        const dropdown = $(this).children('.dropdown');
        toggleClass(dropdown, 'dropdown--active');
      });
    }

    // Sidenav list sliding functionality
    function setSidenavListeners() {
      const subHeadings = $('.navList__subheading');
      console.log('subHeadings: ', subHeadings);
      const SUBHEADING_OPEN_CLASS = 'navList__subheading--open';
      const SUBLIST_HIDDEN_CLASS = 'subList--hidden';

      subHeadings.each((i, subHeadingEl) => {
        $(subHeadingEl).on('click', (e) => {
          const subListEl = $(subHeadingEl).siblings();

          // Add/remove selected styles to list category heading
          if (subHeadingEl) {
            toggleClass($(subHeadingEl), SUBHEADING_OPEN_CLASS);
          }

          // Reveal/hide the sublist
          if (subListEl && subListEl.length === 1) {
            toggleClass($(subListEl), SUBLIST_HIDDEN_CLASS);
          }
        });
      });
    }

    function toggleClass(el, className) {
      if (el.hasClass(className)) {
        el.removeClass(className);
      } else {
        el.addClass(className);
      }
    }

    // If user opens the menu and then expands the viewport from mobile size without closing the menu,
    // make sure scrolling is enabled again and that sidenav active class is removed
    function addResizeListeners() {
      $(window).resize(function(e) {
        const width = window.innerWidth;
        console.log('width: ', width);

        if (width > 750) {
          sidenavEl.removeClass(SIDENAV_ACTIVE_CLASS);
          gridEl.removeClass(GRID_NO_SCROLL_CLASS);
        }
      });
    }

    // Menu open sidenav icon, shown only on mobile
    function setMenuClickListener() {
      $('.header__menu').on('click', function(e) {
        console.log('clicked menu icon');
        toggleClass(sidenavEl, SIDENAV_ACTIVE_CLASS);
        toggleClass(gridEl, GRID_NO_SCROLL_CLASS);
      });
    }

    // Sidenav close icon
    function setSidenavCloseListener() {
      $('.sidenav__brand-close').on('click', function(e) {
        toggleClass(sidenavEl, SIDENAV_ACTIVE_CLASS);
        toggleClass(gridEl, GRID_NO_SCROLL_CLASS);
      });
    }
  </script>