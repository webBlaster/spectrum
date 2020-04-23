<template>
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
        <div class="mdc-card p-0">
            <div class="mdc-top-app-bar" style="background-color: rgba(27, 12, 72, 0.5)">
                <div class="mdc-top-app-bar__row">
                    <h3 class="card-padding mb-4 text-white">Used Licences</h3>
                    <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end">
                    <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon search-text-field d-none d-md-flex">
                        <i class="material-icons mdc-text-field__icon">search</i>
                        <input class="mdc-text-field__input" id="text-field-hero-input" @keyup="searchUser" v-model="search" placeholder="search...">
                        <div class="mdc-notched-outline">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch">
                            <label for="text-field-hero-input" class="mdc-floating-label">Search..</label>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                    </div>
                </div>

            </div>
      
            <div class="table-responsive">
                <table class="table table-hoverable">
                <thead>
                    <tr>
                    <th class="text-left">S/N</th>
                    <th class="text-left">Keys Used</th>
                    <th  class="text-left">Customers name</th>
                    <th class="text-left">Imei</th>
                    <th class="text-left">Activation Date</th>
                    <th class="text-left">Valid Till</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(userlicense, index) in loadedLicenses" :key="userlicense.id">
                        <td class="text-left">{{index + 1}}</td>
                        <td class="text-left bg-light"><a href="" @click.prevent="gotoLocation(userlicense.access_code_uuid)"> {{userlicense.used_key}} </a></td>
                        <td class="text-left">{{userlicense.name}}</td>
                        <td class="text-left">{{userlicense.device_imei}}</td>
                        <td class="text-left">{{userlicense.activation_date}}</td>
                        <td class="text-left">{{userlicense.expires}}</td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loadedLicenses:'',
            search:''
        }
    },
    methods: {
        gotoLocation(key) {
            return window.location.assign('edit-license?i='+key)
        },
        searchUser() {
            Fire.$emit('searching');
        }
    },
    created() {
        Fire.$on('searching', () => {
            let query = this.search;
            axios.get('findUser?q=' + query)
            .then((response) => {
                this.loadedLicenses = response.data.data
            })
        })
        axios.get('all-used-licenses')
        .then((response) => {
            this.loadedLicenses = response.data.data;
        })
        .catch(() => {

        })
    }
}
</script>