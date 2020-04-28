<template>
    <div class="container">
      <ul class="nav nav-tabs">
          <li class="" @click="category('single')">
            <a data-toggle="tab" class="mdc-button mdc-button--raised filled-button--secondary mdc-ripple-upgraded mr-1 active" href="#single">Single Licenses</a>
          </li>
          <li @click="category('group')">
            <a data-toggle="tab" class="mdc-button mdc-button--raised mdc-ripple-upgraded" href="#single">Group Licenses</a>
          </li>
      </ul>
      
      <div class="tab-content">
        <div id="single" class="tab-pane fade in active show">
          <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
            <div class="mdc-card p-0">
              <h6 class="card-title card-padding pb-0">Users' License {{mycat}} </h6>
              <used-licenses :category=mycat></used-licenses>
            </div>
          </div>
        </div>
        <!-- <div id="group" class="tab-pane fade">
          <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
            <div class="mdc-card p-0">
              <h6 class="card-title card-padding pb-0">Users' License (Group) </h6>
              <used-licenses :category=mycat></used-licenses>
            </div>
          </div>
        </div> -->
      </div>
    </div>  
</template>

<script>
    import usedLicenses from './UsedLicenses.vue'
export default {
    data() {
        return {
            mycat : 'Group'
        }
    },
    components: {
        usedLicenses
    },
    methods: {
        category(status) {
            if(status == 'single') {
                this.mycat = 'Single'
            } else {
                this.mycat = 'Group'
            }
        }
    }
}
</script>
