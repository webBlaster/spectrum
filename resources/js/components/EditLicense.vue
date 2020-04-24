<template>
    <div>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="license-name">License Name</label>
                <input class="form-control"  id="license-name" placeholder="License Name" v-model="form.license_name" :class="{ 'is-invalid':form.errors.has('license_name')}" type="text">
                <has-error :form="form" field="license_name"></has-error>
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="valid_from">License Type</label>
                <select v-model="form.license_type" @change="licenseType(form.license_type)" class="custom-select" id="license-type" :class="{ 'is-invalid':form.errors.has('license_category')}" required>
                    <option :value="option.value" v-for="option in options">
                        {{option.text}}
                    </option>
                </select>
                <has-error :form="form" field="license_category"></has-error>
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="valid_from">Price</label>
                <input class="form-control"  v-model="form.price" :class="{ 'is-invalid':form.errors.has('price')}" type="number"  min="1" @keypress="forceDigit($event)" required>
                <has-error :form="form" field="price"></has-error> 
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="valid_from">Max. User</label>
                <input class="form-control"  id="max-user" placeholder="1" v-model="form.max_number_of_users" :disabled="group_license" :class="{ 'is-invalid':form.errors.has('max_number_of_users')}" type="number"  min="1" @keypress="forceDigit($event)">
                <has-error :form="form" field="max_number_of_users"></has-error>
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="valid_from">Duration(in month) </label>
                <input class="form-control"  name="duration" v-model="form.duration" :class="{ 'is-invalid':form.errors.has('duration')}" required id="license-duration" type="number" max="12" min="1" @keypress="forceDigit($event)" @keyup="maxTwelve($event)" @blur="maxTwelve($event)" maxlength="2">
                <has-error :form="form" field="duration"></has-error>
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div> 
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="valid_from">status</label>
                <button class="btn btn-disabled form-control" @click.prevent="" disabled>{{form.status}}</button>
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="valid_from">License Code</label>
                <button class="btn btn-disabled form-control" @click.prevent="" disabled>{{form.code}}</button>
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div> 


        <div class="form-group">
            <button class="btn btn-danger" name="selectedArray" @click="addDeleteItem"><i class="fas fa-minus-circle"></i> Delete Selected</button>
        </div>
        <table class="table">                 
            <thead class="thead-dark">
                <tr>
                    <th><input type="checkbox" name="selectAll" id="options"></th>
                    <th>S/N</th>
                    <th>Book Title</th>
                    <th>Book Author</th>
                    <th>Book Publisher</th>
                    <th>Date Published</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(book, index) in form.books_number" :key="book.id">
                    <td><input type="checkbox" name="selectArray" class="books" :value="book.id"></td>
                    <td>{{index + 1}}</td>
                    <td>{{book.title}}</td>
                    <td>{{book.author}}</td>
                    <td>{{book.publisher}}</td>
                    <td>{{book.date_published}}</td>
                    <td><button class="btn btn-danger" name="removeBook" @click="deleteBook(book.id)"><i class="fas fa-minus-circle"></i> Remove</button></td>
                </tr>
            </tbody>
        </table>
        <div class="navbar navbar-dark" >
            <nav class="text-white">Attach More Books to This License</nav>
        </div>

        <div id="accordion">
            <div class="card">
                <div class="card-header" style="background-color: #6610f2" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseone">
                    <h5 class="mb-0">
                        <button class="btn tnk-link text-white">
                            Attach More Books to This License
                        </button>   
                    </h5>
                </div>
                <div class="collapse hide" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <bootstrap-table :data="filteredBooks" :options="myOptions" :columns="myColumns" />
                    </div>
                </div>
            </div>
        </div>
         <div class="mt-3 text-right">
            <a href="keys" class="btn btn-danger btn-lg"><i class="fas fa-arrow-left"></i> Go Back</a>
            <button class="btn btn-info btn-lg" @click="updateAll">Update License</button>
        </div>
    </div>
</template>

<script>
import BootstrapTable from 'bootstrap-table/dist/bootstrap-table-vue.min.js'
export default {
    props: ['license_id'],
    components: {
        'bootstrap-table': BootstrapTable
    },
    data() {
        return {
            group_license: false,
            selectedBooks: [],
            filteredBooks: [],
            form: new Form({
                id: '',
                uuid: '',
                code: '',
                license_name : '',
                license_type : '',
                books_number : '',
                books_contained: '',
                price : '',
                max_number_of_users: '',
                duration : '',
                status : ''
            }),
            selected: '',
            newBookSelection: [],
            options: [
                // {text: 'Single', value: 1},
                // {text: 'Group', value: 2}
            ],
            myOptions: {
                search: true, 
                pagination: true,
                showColumns: true,
                toolbar: '#toolbar',
                idField: 'id',
                selectItemName: 'id',
                filterControl: true,
                clickToSelect: true,
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
        addDeleteItem() {
            this.selectedBooks = []
            let checkBoxes = document.getElementsByClassName('books')
            for(var i = 0; i < checkBoxes.length; i++){
                if(checkBoxes[i].type == 'checkbox' && checkBoxes[i].checked == true){
                    this.selectedBooks.push(checkBoxes[i].value)
                }
            }

            this.deleteMultiple();
        },
        deleteMultiple () {
            if(this.selectedBooks.length > 0) {
                swal.fire({
                    title: 'Are you sure?',
                    text: 'You Are about to delete multiple books from this license',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Continue!'
                })
                .then((result) => {
                    this.$Progress.start();
                    if(result.value) {
                        this.selectedBooks.forEach((item, key) =>{
                
                            // send request to the server
                            if((this.form.books_number.length - this.selectedBooks.length) > 0) {
                                axios.delete('remove-book/'+item+'?i='+this.form.uuid)
                                .then(()=>{
                                    if(key === (this.selectedBooks.length - 1)) {
                                        swal.fire(
                                            'Deleted',
                                            'Books Success Fully Detached from this license',
                                            'success'
                                        )
                                        this.$Progress.finish();
                                        Fire.$emit('AfterCreate')
                                        
                                    }
                                }).catch(()=>{
                                    swal.fire("failed", "There was something wrong.", "warning");
                                    this.$Progress.fail();
                                })
                            } else {
                                swal.fire("failed", "Cannot remove all the books attached to this license", "warning");
                                this.$Progress.finish();
                            }
                            
                        })
                        
                    }
                        this.$Progress.finish();
                })

            }
            
        },
        deleteBook(bookId) {
            swal.fire({
                title: 'Are you sure?',
                text: 'You Are about to remove this book from the list',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Remove it!'
            })
            
            .then((result) => {
                this.$Progress.start();
                if(result.value) {
                    if(this.form.books_number.length > 1) {
                        axios.delete('remove-book/'+bookId+'?i='+this.form.uuid)
                        .then((data) => {
                            swal.fire(
                                'Deleted',
                                'Book successfully detached from this license',
                                'success'
                            )
                            Fire.$emit('AfterCreate');
                            this.$Progress.finish();
                        })
                        .catch((Error) => {
                            swal.fire("failed", "There was something wrong.", "warning");
                            this.$Progress.fail();
                        })
                    } else {
                        swal.fire("failed", "You cannot remove all the books attached to this license", "warning");
                    }
                   
                }
                this.$Progress.finish();
            })
        },
        forceDigit(event) {
            if(!(event.keyCode >= 48 && event.keyCode <= 57)) {
                return event.preventDefault()
            }else {
               return false 
            } 
        },
        licenseType(option) {
            if(option === 1) {
                this.group_license = true;
                this.form.max_number_of_users = 1;
            } else {
                this.group_license = false;
            }
        },
        maxTwelve(event) {
            if(event.target.value > 12){
                event.target.value = "";
                this.form.duration = "";
                alert("cannot be more than 12")
            }
        },
        licenseDetails() {
             axios.get('edit-license?i='+this.license_id)
            .then((data) => {
                this.form.fill(data.data.data);
                if(this.form.license_type == 1) {
                    this.group_license = true
                    
                }
                this.form.post('distinct-books')
                .then((data) => {
                    this.filteredBooks = data.data
                })
                axios('/admin/licenses/license-groups')
                .then((data) => {
                    const license_group = data.data;
                    license_group.forEach((text, value) => {
                        this.options.push({'text' : text.name, 'value' : text.id});
                    });
                })
            })
            .catch(() => {

            })
            
        },
        updateAll() {
            this.newBookSelection = []
            let checkBoxes = document.getElementsByName('id')
            for(var i = 0; i < checkBoxes.length; i++){
                if(checkBoxes[i].type == 'checkbox' && checkBoxes[i].checked == true){
                    this.newBookSelection.push(checkBoxes[i].value)
                }
            }
            this.updateLicense();
        },

        updateLicense() {
            this.$Progress.start();
            this.form.books_contained = this.newBookSelection;

            // send request to the server
            this.form.put('update-license')
            .then(() => {
                swal.fire(
                    'Success',
                    'License Key Information Successfully updated',
                    'success'
                )
                this.$Progress.finish();
                Fire.$emit('AfterCreate')
            })
            .catch(() => {
                swal.fire("failed", "There was something wrong.", "warning");
                this.$Progress.fail();
            })
            this.$Progress.finish();
        }
    },
    
    created() {
       this.licenseDetails();
        Fire.$on('AfterCreate', () => {
            this.licenseDetails();  
        })
        $(document).ready(() => {
             $('#options').click(function() {
                if(this.checked) {
                    $('.books').each(function() {
                        this.checked = true;
                    })
                } else {
                    $('.books').each(function() {
                        this.checked = false;
                    })
                }
            });

           
        })

    }
}
</script>