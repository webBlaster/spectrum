    <!-- partial:partials/_sidebar.html -->
    <aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
        <div class="mdc-drawer__header">
          <a href="index.html" class="brand-logo">
            <img src="{{asset('images/Spectrum_logo.png')}}" alt="logo"><h3 style="color: white;">SPECTRUM BOOKS</h3>
          </a>
        </div>
        <div class="mdc-drawer__content">
          <div class="user-info">
            <p class="name">Feyi Kemi</p>
            <p class="email">feyi@example.mail.com</p>
          </div>
          <div class="mdc-list-group">
            <nav class="mdc-list mdc-drawer-menu">
              <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-drawer-link" href="index.html">
                  <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">home</i>
                  Dashboard
                </a>
              </div>
              <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-drawer-link" href="user_license.html">
                  <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">track_changes</i>
                  User License
                </a>
              </div>
              <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-drawer-link" href="generatedLic.html">
                  <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">grid_on</i>
                  Generated License
                </a>
              </div>
              <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-drawer-link" href="uploadedbooks.html">
                  <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">book</i>
                  Uploaded Books
                </a>
              </div>
              <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-drawer-link" href="adminactions.html">
                  <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">pie_chart_outlined</i>
                  Audit Logs
                </a>
              </div>
            </nav>
             
            <div class="profile-actions">
              <a href="javascript:;">Settings</a>
              <span class="divider"></span>
              <a href="{{ route('admin.logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </div>
          </div>
        </div>
    </aside>
