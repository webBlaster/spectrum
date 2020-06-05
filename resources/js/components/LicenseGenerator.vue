<template>
     <div class="container">
        <div class="row justify-content-center text-center" v-show="displayGenerate">
            <div class="col-md-6 mb-2" v-show="!confirmode">
                <div class="card card-default border border-info shadow">
                    <form>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-7 mb-2">
                                    <label for="license-name">License Name</label>
                                    <input type="text" class="form-control" name="license_name" v-model="form.license_name" :class="{ 'is-invalid':form.errors.has('license_name')}" required id="license-name">
                                    <has-error :form="form" field="license_name"></has-error>
                                </div>
                                <div class="col-md-5 mb-2">
                                    <label for="License-type">License Type</label>
                                    <select v-model="selected" @change="licenseType(selected)" class="custom-select" id="license-type" :class="{ 'is-invalid':form.errors.has('license_category')}" required>
                                        <option disabled value="">--License Type---</option>
                                        <option :value="option.value" v-for="option in options">
                                            {{option.text}}
                                        </option>
                                    </select>
                                    <has-error :form="form" field="license_category"></has-error>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="license-duration">License Duration (in month)</label>
                                    <input class="form-control"  name="duration" v-model="form.duration" :class="{ 'is-invalid':form.errors.has('duration')}" required id="license-duration" type="number" max="12" min="1" @keypress="forceDigit($event)" @keyup="maxTwelve($event)" maxlength="2">
                                    <has-error :form="form" field="duration"></has-error>
                                </div>
                                <div class="col-md-3 mb-3" v-show="group_License" >
                                    <label for="max-user">Max no. of user</label>
                                    <input class="form-control"  id="max-user" placeholder="1" v-model="form.max_number_of_user" :class="{ 'is-invalid':form.errors.has('max_number_of_user')}" type="number"  min="1" @keypress="forceDigit($event)">
                                    <has-error :form="form" field="max_number_of_user"></has-error>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="price">Price</label>
                                    <input class="form-control"  v-model="form.price" :class="{ 'is-invalid':form.errors.has('price')}" type="number"  min="1" @keypress="forceDigit($event)" required>
                                    <has-error :form="form" field="price"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button  type="submit" class="mdc-button mdc-button--raised filled-button--info" @click.prevent="generateLicense">
                                Generate License
                            </button>
                        </div>
                    </form>
                </div>
                <a href="keys" class="font-weight-bold">View All Generated Licenses</a>
            </div>

            <!-- Resulting Data -->
            <div class="col-md-6 mb-1" v-show="confirmode">
                <div class="card card-default border border-info shadow">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-7 mb-1">
                                <label for="" >License Name</label>
                                <div class="form-control text-center text-muted"> {{form.license_name}} </div>
                            </div>
                            <div class="col-md-5 mb-1">
                                <label for="" >Max User</label>
                                <div class="form-control text-center text-muted"> {{form.max_number_of_user}} </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-5 mb-3">
                                <label for="" >Duration (in month)</label>
                                <div class="form-control text-center text-muted"> {{form.duration}} </div>
                            </div>
                            <div class="col-md-7 mb-3">
                                <label for="" >Price</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">N</span>
                                    </div>
                                    <div aria-describedby="inputGroupPrepend" class="form-control text-muted"> {{form.price}} </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="" ></label>
                                <div class="form-control text-center text-muted"> {{form.code}} </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="mdc-button mdc-button--raised filled-button--dark" @click="toggleMode">
                            Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div v-show="confirmode">
            <div id="toolbar">

            </div>
            <bootstrap-table :data="relatedBooks" :options="myOptions" :columns="myColumns" />
            <div class="mt-3 text-right">
                <button class="btn btn-info btn-lg" @click="selectedBooks">Submit Books</button>
            </div>
        </div>

    </div>
</template>

<script>
import BootstrapTable from 'bootstrap-table/dist/bootstrap-table-vue.min.js'
export default {
    components: {
        'bootstrap-table': BootstrapTable
    },
    data() {
        return {
            confirmode: false,
            displayGenerate: true,
            group_License: false,
            mySelections: [],
            selected: '',
            count_books_selected: '',
            form: new Form({
                duration: "",
                license_category: '',
                max_number_of_user: 1,
                code: "",
                books_contained: "",
                price: "",
                license_name: "",
            }),
            options: [
                // {text: 'Single', value: 1},
                // {text: 'Group', value: 2}
            ],
            relatedBooks: [],

            myOptions: {
                search: true,
                pagination: true,
                showColumns: true,
                toolbar: '#toolbar',
                idField: 'id',
                selectItemName: 'id',
                filterControl: true,
                clickToSelect: true
            },
            myColumns: [
                { field: 'state', checkbox: true },
                { field: 'title', title: 'Book Title', sortable: false, filterControl: 'input'},
                { field: 'author', title: 'Author', sortable: true, filterControl: 'input'},
                { field: 'description', title: 'Description', sortable: true},
                { field: 'publisher', title: 'Publisher', sortable: true, filterControl: 'input'},
                { field: 'date_published', title: 'Publication Date', sortable: true, filterControl: 'input'},
            ]
        }
    },
    methods: {
        maxTwelve(event) {
            if(event.target.value > 12){
                alert("cannot be more than 12")
                event.target.value = "";
                this.form.duration = "";
            }
        },
        forceDigit(event) {
            if(!(event.keyCode >= 48 && event.keyCode <= 57)) {
                return event.preventDefault()
            }else {
               return false
            }
        },
        generateLicense() {
            this.form.license_category = this.selected;
            this.$Progress.start();
            this.form.post('/admin/licenses/generate_key').then((data) => {
                this.form.code = data.data.code;
                this.relatedBooks = data.data.books;
                this.confirmode = !this.confirmode;
                this.$Progress.finish();
            }).catch((error) => {
                this.$Progress.fail();
            })
        },
        // generateRandomMsisdn() {
        //     let result = '';
        //     const characters = '568740025766248514599874331458746963241569', length = 10;
        //     for(let i = 0; i < length; i++) {
        //         result += characters.charAt(Math.floor(Math.random() * characters.length));
        //     }
        //     console.log('234' + result);
        // },
        licenseType(option) {
            if(option === 2) {
                this.group_License = true;
            } else {
                this.group_License = false;
                this.form.max_number_of_user = 1;
            }
        },
        selectedBooks() {
            this.mySelections = []
            let checkBoxes = document.getElementsByName('id')
            for(var i = 0; i < checkBoxes.length; i++){
                if(checkBoxes[i].type == 'checkbox' && checkBoxes[i].checked == true){
                    this.mySelections.push(checkBoxes[i].value)
                }
            }

            this.submitSelectedBooks();
        },
        submitSelectedBooks() {
                this.$Progress.start();
                if(this.mySelections.length < 1) {
                    swal.fire("failed", "Please Attach Books to the License Key.", "warning");
                    this.$Progress.fail();
                } else {
                    this.form.books_contained = this.mySelections;
                    // send request to the server
                    this.form.post('/admin/licenses/store-key')
                    .then(()=>{
                        swal.fire(
                            'Success',
                            'License Key Successfully Created',
                            'success'
                        )
                        this.$Progress.finish();
                        this.form.reset();
                        this.toggleMode();
                    })
                    .catch(()=>{
                        swal.fire("failed", "There was something wrong.", "warning");
                        this.$Progress.fail();
                    })
                }
                this.$Progress.finish();
        },
        toggleMode() {
            this.confirmode = !this.confirmode;
        }
    },
    created() {
        axios('/admin/licenses/license-groups')
        .then((data) => {

            const license_group = data.data;
            license_group.forEach((text, value) => {
                this.options.push({'text' : text.name, 'value' : text.id});
            });
        })
    }
}
</script>
