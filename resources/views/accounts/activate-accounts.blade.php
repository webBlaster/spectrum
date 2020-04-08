@extends('layouts.layout')

@section('content')
<main class="content-wrapper">
  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
    <div class="mdc-card p-0 ml-2">
    <account-activation user_id="{{Auth::guard('admin')->user()->uuid}}" inline-template>   
        <div class="mdc-layout-grid__inner">
          <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--span-8-tablet">
            <div class="mdc-card bg-light">
              <h6 class="card-title text-secondary">Accounts Awaiting Activation</h6>
              <hr>
              <div class="template-demo">
                <div class="box">
                  <div class="box-body">
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <th>S/N</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Date Created</th>
                          <th>Delete\Activate</th>
                        </tr>
                      
                        <tr v-for="(unactivated, index) in nonActivatedUsers" :key="unactivated.id">
                          <td v-text="index  + 1"></td>
                          <td v-text="unactivated.username" style="text-align:left;"></td>
                          <td v-text="unactivated.email" style="text-align:left;"></td>
                          <td v-html="unactivated.created_at" style="text-align:left;"></td>
                          <td style="text-align:left;">
                            <button @click="deleteUser(unactivated.uuid)" class="mdc-button mdc-button--raised icon-button filled-button--secondary mdc-ripple-upgraded" style="--mdc-ripple-fg-size:14px; --mdc-ripple-fg-scale:2.857142857142857; --mdc-ripple-fg-translate-start:1.933349609375px, 7px; --mdc-ripple-fg-translate-end:2px, 5px;" data-toggle="tooltip" data-placement="top" title="Delete User Account">
                              <i class="material-icons mdc-button__icon">delete</i>
                            </button>
                            /
                            <button @click="activateUser(unactivated.uuid, 'activated')" class="mdc-button mdc-button--raised icon-button filled-button--success mdc-ripple-upgraded" data-toggle="tooltip" data-placement="top" title="Activate User Account">
                              <i class="material-icons mdc-button__icon">checked</i>
                            </button>
                          
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--span-12-tablet">
            <div class="mdc-card">
              <h6 class="card-title text-primary">Activated Accounts</h6>
              <hr>
              <div class="template-demo">
                <div class="box">
                  <div class="box-body">
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <th>S/N</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Date Created</th>
                          <th>Action</th>
                          <th>Toggle Priviledge</th>
                        </tr>
                      
                        <tr v-for="(activated, index) in activatedUsers" :key="activated.id" v-if="active_id !== activated.uuid">
                          <td v-text="index + 1"></td>
                          <td v-text="activated.username" style="text-align:left;"></td>
                          <td v-text="activated.email" style="text-align:left;"></td>
                          <td v-html="activated.created_at" style="text-align:left;"></td>
                          <td style="text-align:left;">
                            <button @click="deleteUser(activated.uuid)" class="mdc-button mdc-button--raised icon-button filled-button--secondary mdc-ripple-upgraded" style="--mdc-ripple-fg-size:14px; --mdc-ripple-fg-scale:2.857142857142857; --mdc-ripple-fg-translate-start:1.933349609375px, 7px; --mdc-ripple-fg-translate-end:2px, 5px;" data-toggle="tooltip" data-placement="top" title="Delete User Account">
                              <i class="material-icons mdc-button__icon">delete</i>
                            </button>
                            /
                            <button @click="activateUser(activated.uuid, 'deactivated')" class="mdc-button mdc-button--raised icon-button filled-button--success mdc-ripple-upgraded" data-toggle="tooltip" data-placement="top" title="Deactivate Account">
                              <i class="material-icons mdc-button__icon">cancel</i>
                            </button>
                          
                          </td>
                          <td style="text-align:left;">
                            <div v-if="activated.is_super_admin === 1">
                              <button @click="togglePriviledge( activated.uuid, activated.username, ' an Admin ' )" class="mdc-button mdc-button--unelevated mdc-ripple-upgraded" style="--mdc-ripple-fg-size:57px; --mdc-ripple-fg-scale:1.9678808653005644; --mdc-ripple-fg-translate-start:-23.5px, 1.5px; --mdc-ripple-fg-translate-end:19.308334350585938px, -10.5px;" data-toggle="tooltip" data-placement="top" title="Click to change to admin">
                                Super Admin
                              </button>
                            </div>
                            <div v-else="activated.is_super_admin == 0">
                              <button @click="togglePriviledge( activated.uuid, activated.username, ' a Super Admin ' )" class="mdc-button mdc-button--unelevated filled-button--secondary mdc-ripple-upgraded" style="--mdc-ripple-fg-size:65px; --mdc-ripple-fg-scale:1.9291179361344377; --mdc-ripple-fg-translate-start:68.5px, -15.5px; --mdc-ripple-fg-translate-end:22.316665649414062px, -14.5px;" data-toggle="tooltip" data-placement="top" title="Click to change to super admin">
                                Admin
                              </button>
                            </div>
                      
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </account-activation>
    </div>
  </div>
</main>


  @endsection

