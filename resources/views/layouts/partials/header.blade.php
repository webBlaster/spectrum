<!-- partial:partials/_navbar.html -->
<header class="mdc-top-app-bar">
    <div class="mdc-top-app-bar__row">
      <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
        <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button sidebar-toggler">menu</button>
        <span class="mdc-top-app-bar__title">Greetings {{Auth::guard('admin')->user()->name}}</span>
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
              <span class="user-name">{{Auth::guard('admin')->user()->username}}</span>
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
                  <h6 class="item-subject font-weight-normal">
                    <a href="{{ route('admin.logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                  </h6>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="divider d-none d-md-block"></div>
        
        <notify-user inline-template>
          <div>
            <div class="menu-button-container">
              <button class="mdc-button mdc-menu-button">
                <i class="mdi mdi-bell"></i>
              </button>
              <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                <a @click.prevent="show=true" href=""><h6 class="title"> <i class="mdi mdi-bell-outline mr-2 tx-16"></i> Notify Users</h6></a>
              </div>
            </div>
            {{-- <b-button @click="show=true" variant="primary">Show Modal</b-button> --}}

            <b-modal
              v-model="show"
              title="Create New Notification"
            >
            <form @submit.prevent="" id="form" >
              <div class="modal-body">
                  <div class="form-group">
                      <input type="text" name="title" v-model="form.title" placeholder="Title" class="form-control" :class="{ 'is-invalid':form.errors.has('title')}" required>
                      <has-error :form="form" field="title"></has-error>
                  </div>
                  <div class="form-group">
                      <textarea name="notification" v-model="form.notification" placeholder="Notification Message" class="form-control" :class="{ 'is-invalid':form.errors.has('notification')}" required>
                      </textarea>
                      <has-error :form="form" field="notification"></has-error>
                  </div>
              </div>
            </form>
              <template v-slot:modal-footer>
                  <div class="w-100">
                  <b-button
                    variant="primary"
                    size="md"
                    class="float-right"
                    @click="createNotification()"
                  >
                  Create
                  </b-button>
                  <b-button
                    variant="secondary"
                    size="md"
                    class="mr-2 float-right"
                    @click="show=false"
                  >
                  Close
                </b-button>
                </div>
              </template>
            </b-modal>
          </div>
        </notify-user>
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