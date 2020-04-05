<!-- partial:partials/_navbar.html -->
<header class="mdc-top-app-bar">
    <div class="mdc-top-app-bar__row">
      <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
        <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button sidebar-toggler">menu</button>
        <span class="mdc-top-app-bar__title">Greetings Feyi!</span>
        <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon search-text-field d-none d-md-flex">
          <i class="material-icons mdc-text-field__icon">search</i>
          <input class="mdc-text-field__input" id="text-field-hero-input">
          <div class="mdc-notched-outline">
            <div class="mdc-notched-outline__leading"></div>
            <div class="mdc-notched-outline__notch">
              <label for="text-field-hero-input" class="mdc-floating-label">Search..</label>
            </div>
            <div class="mdc-notched-outline__trailing"></div>
          </div>
        </div>
      </div>
      <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end mdc-top-app-bar__section-right">
        <div class="menu-button-container menu-profile d-none d-md-block">
          <button class="mdc-button mdc-menu-button">
            <span class="d-flex align-items-center">
              <span class="figure">
                <img src="images/faces/face1.jpg" alt="user" class="user">
              </span>
              <span class="user-name">Feyi</span>
            </span>
          </button>
          <div class="mdc-menu mdc-menu-surface" tabindex="-1">
            <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
              <li class="mdc-list-item" role="menuitem">
                <div class="item-thumbnail item-thumbnail-icon-only">
                  <i class="mdi mdi-account-edit-outline text-primary"></i>
                </div>
                <div class="item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="item-subject font-weight-normal">Edit profile</h6>
                </div>
              </li>
              <li class="mdc-list-item" role="menuitem">
                <div class="item-thumbnail item-thumbnail-icon-only">
                  <i class="mdi mdi-settings-outline text-primary"></i>                      
                </div>
                <div class="item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="item-subject font-weight-normal">Logout</h6>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="divider d-none d-md-block"></div>
        <div class="menu-button-container d-none d-md-block">
          <button class="mdc-button mdc-menu-button">
            <i class="mdi mdi-settings"></i>
          </button>
          <div class="mdc-menu mdc-menu-surface" tabindex="-1">
            <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
              <li class="mdc-list-item" role="menuitem">
                <div class="item-thumbnail item-thumbnail-icon-only">
                  <i class="mdi mdi-alert-circle-outline text-primary"></i>
                </div>
                <div class="item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="item-subject font-weight-normal">Settings</h6>
                </div>
              </li>
              
            </ul>
          </div>
        </div>
        <div class="menu-button-container">
          <button class="mdc-button mdc-menu-button">
            <i class="mdi mdi-bell"></i>
          </button>
          <div class="mdc-menu mdc-menu-surface" tabindex="-1">
            <a href="notify.html"><h6 class="title"> <i class="mdi mdi-bell-outline mr-2 tx-16"></i> Notify Users</h6></a>
           
          </div>
        </div>
        <div class="menu-button-container">
          <button class="mdc-button mdc-menu-button">
            <i class="mdi mdi-email"></i>
            <span class="count-indicator">
              <span class="count">3</span>
            </span>
          </button>
          <div class="mdc-menu mdc-menu-surface" tabindex="-1">
            <h6 class="title"><i class="mdi mdi-email-outline mr-2 tx-16"></i> Messages</h6>
            
          </div>
        </div>
     
      </div>
    </div>
  </header>