<template>
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
        <div class="mdc-card p-0">
            <div class="mdc-top-app-bar" style="background-color: rgba(27, 12, 72, 0.5)" v-if="category == 'all'">
                <div class="mdc-top-app-bar__row">
                    <h4 class="centralize-license text-white">Used Licences</h4>
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
                    <!-- <tr v-for="(userlicense, index) in loadedLicenses" :key="userlicense.id">
                        <td class="text-left">{{index + 1}}</td>
                        <td class="text-left bg-light"><a href="" @click.prevent="gotoLocation(userlicense.access_code_uuid)"> {{userlicense.used_key}} </a></td>
                        <td class="text-left">{{userlicense.name}}</td>
                        <td class="text-left">{{userlicense.device_imei}}</td>
                        <td class="text-left">{{userlicense.activation_date}}</td>
                        <td class="text-left">{{userlicense.expires}}</td>
                    </tr> -->
                    <tr v-for="(userlicense, index) in list" :key="userlicense.id" v-if="category == 'all'">
                        
                        <td class="text-left">{{index + 1}}</td>
                        <td class="text-left bg-light"><a class="text-lg" href="" @click.prevent="gotoLocation(userlicense.access_code_uuid)"> {{userlicense.used_key}} </a></td>
                        <td class="text-left">{{userlicense.name}}</td>
                        <td class="text-left">{{userlicense.device_imei}}</td>
                        <td class="text-left">{{userlicense.activation_date}}</td>
                        <td class="text-left">{{userlicense.expires}}</td>
                    </tr>
                    <tr v-for="(userlicense, index) in list" :key="userlicense.id">
                        <template v-if="userlicense.category.name === category">
                            <td class="text-left">{{index + 1}}</td>
                            <td class="text-left bg-light"><a class="text-lg" href="" @click.prevent="gotoLocation(userlicense.access_code_uuid)"> {{userlicense.used_key}} </a></td>
                            <td class="text-left">{{userlicense.name}}</td>
                            <td class="text-left">{{userlicense.device_imei}}</td>
                            <td class="text-left">{{userlicense.activation_date}}</td>
                            <td class="text-left">{{userlicense.expires}}</td>
                        </template>
                    </tr>
                    <infinite-loading @infinite="infiniteHandler">
                        <div></div>
                    </infinite-loading>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import InfiniteLoading from 'vue-infinite-loading';
    export default {
        props: {
            category: {
                default: ''
            }
        },
        components: {
            InfiniteLoading,
        },
        data() {
            return {
                loadedLicenses:'',
                search:'',
                page: 1,
                searchPage: 1,
                list: []
            }
        },
        methods: {
            gotoLocation(key) {
                return window.location.assign('/admin/licenses/edit-license?i='+key)
            },
            searchUser: _.debounce(() => {
                Fire.$emit('searching');
            }, 1500),

            infiniteHandler($state) {
                
                axios.get('/admin/licenses/all-used-licenses?page='+this.page)
                .then(({data}) => {
                    
                   let incoming = data.data;
                    if(incoming.length) {
                        this.page += 1;
                        this.list.push(...incoming);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                })
            }
        },
        created() {
            Fire.$on('searching', () => {
                let query = this.search;
                axios.get('findUser?q=' + query)
                .then((response) => {
                    this.list = response.data.data
                })
            })
            // axios.get('all-used-licenses')
            // .then((response) => {
            //     this.loadedLicenses = response.data.data;
            // })
            // .catch(() => {

            // })
        }
    }
</script>

<style scoped>
    .centralize-license {
        padding-top: 1.5rem;
    }
    .text-lg {
        font-size: 1.3rem;
        font-weight: bolder;

    }
</style>