<template>
    <div>

        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">{{form.license_name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <form>
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="valid_from">License Name</label>
                                    <button class="btn btn-disabled form-control" @click.prevent="" disabled>{{form.license_name}}</button>
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="valid_from">License Type</label>
                                    <button class="btn btn-disabled form-control" @click.prevent="" disabled>{{form.license_type}}</button>
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="valid_from">No. of Books</label>
                                    <button class="btn btn-disabled form-control" @click.prevent="" disabled>{{form.books_number}}</button>
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="valid_from">Price</label>
                                    <button class="btn btn-disabled form-control" @click.prevent="" disabled>{{form.price}}</button>
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="valid_from">Max. User</label>
                                    <button class="btn btn-disabled form-control" @click.prevent="" disabled>{{form.max_number_of_users}}</button>
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="valid_from">Duration</label>
                                    <button class="btn btn-disabled form-control btn-info" @click.prevent="" disabled>{{form.duration}}</button>
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
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <div id="toolbar">
            <a href="create-key" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add New</a>
            <a href="recycled-keys" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Recycle Bins</a>
            <button class="btn btn-danger" @click="deleteChecked"><i class="fas fa-minus-circle"></i> Delete Selected</button>
        </div>
        <bootstrap-table :data="myLicenses" :options="myOptions" :columns="myColumns" />
    </div>
</template>

<script>
    import BootstrapTable from 'bootstrap-table/dist/bootstrap-table-vue.min.js'

    export default {
        components: {
            'bootstrap-table': BootstrapTable
        },
        // props: ['receivedData'],
        data () {
            return {
                editmode: false,
                mySelections: [],
                myLicenses: [],
                form: new Form({
                    id: '',
                    uuid: '',
                    code: '',
                    license_name : '',
                    license_type : '',
                    books_number : '',
                    price : '',
                    max_number_of_users : '',
                    duration : '',
                    status : ''
                }),
                myOptions: {
                    search: true, 
                    pagination: true,
                    showColumns: true,
                    showPrint: true,
                    showExport: true,
                    filterControl: true,
                    toolbar: '#toolbar',
                    clickToSelect: true,
                    idField: 'uuid',
                    selectItemName: 'uuid',
                },
                myColumns: [
                    { field: 'state', checkbox: true },
                    { field: 'code', title: 'License Code', sortable: false,},
                    { field: 'license_name', title: 'License Name', sortable: true, filterControl: 'input'},
                    { field: 'license_type', title: 'License Type', sortable: true, filterControl: 'select'},
                    { field: 'books_number', title: 'Books Attached', sortable: true, filterControl: 'select'},
                    { field: 'price', title: 'Price', sortable: true, filterControl: 'input'},
                    { field: 'max_number_of_users', title: 'Max User', sortable: true, filterControl: 'select'},
                    { field: 'duration', title: 'Duration', sortable: true, filterControl: 'select'},
                    { field: 'status', title: 'Status', sortable: true, filterControl: 'select'},
                    {
                        field: 'action',
                        title: 'Actions',
                        align: 'center',
                        width: '140px',
                        clickToSelect: false,
                        formatter: function (e, value, row){
                            return '<button class="btn btn-sm btn-info mr-1 show"><i class="fas fa-eye"></i></button><button class="btn btn-sm btn-warning mr-1 edit"><i class="fas fa-edit"></i></button><button class="btn btn-sm btn-danger mr-1 destroy"><i class="fas fa-trash"></i></button>'
                        },
                        events: {
                            'click .show': ((e, value, row) =>{
                                this.editModal(row);   
                            }),
                            'click .edit': ((e, value, row) => {
                                return window.location.assign('edit-license?i='+row.uuid)
                            }),
                            'click .destroy': ((e, value, row) => {
                                this.deleteLicense(row);
                                
                            }),
                        }
                    }
                ]
            }
        },
        created () {
            this.loadAllLicenses();
            Fire.$on('AfterCreate', () => {
              this.loadAllLicenses();  
            })

        },
        methods: {
            deleteChecked () {
                this.mySelections = []
                let checkBoxes = document.getElementsByName('uuid')
                for(var i = 0; i < checkBoxes.length; i++){
                    if(checkBoxes[i].type == 'checkbox' && checkBoxes[i].checked == true){
                        this.mySelections.push(checkBoxes[i].value)
                    }
                }
                this.deleteMultiple()
            },
            deleteMultiple () {
                swal.fire({
                    title: 'Are you sure?',
                    text: 'You Are about to delete multiple License Keys',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Continue!'
                })
                .then((result) => {
                    this.$Progress.start();
                    if(result.value) {
                        this.mySelections.forEach((item, key) =>{
                            // send request to the server
                            axios.delete('delete-license/'+item, {
                                id: item
                            })
                            .then(()=>{
                                if(key === (this.mySelections.length - 1)) {
                                    swal.fire(
                                        'Deleted',
                                        'License Keys Thrashed',
                                        'success'
                                    )
                                    this.$Progress.finish();
                                    Fire.$emit('AfterCreate')
                                    
                                }
                            }).catch(()=>{
                                swal.fire("failed", "There was something wrong.", "warning");
                                this.$Progress.fail();
                            })
                        })
                        
                    }
                        this.$Progress.finish();
                })

            },
            editModal(row) {
                this.editmode = true;
                this.form.errors.clear();
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(row);
            },
            deleteLicense(row) {
                swal.fire({
                    title: 'Are you sure?',
                    text: 'You Are about to delete this license',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then((result) => {
                    this.$Progress.start();
                    // send request to the server
                    if(result.value) {
                        axios.delete('delete-license/'+row.uuid, {
                            id: row.uuid
                        })
                        .then(()=>{
                            swal.fire(
                                'Deleted',
                                'License Deleted.',
                                'success'
                            )
                            this.$Progress.finish();
                            Fire.$emit('AfterCreate')
                        }).catch(()=>{
                            swal.fire("failed", "There was something wrong.", "warning");
                            this.$Progress.fail();
                        })
                    }
                    this.$Progress.finish();
                })

            },
            loadAllLicenses() {
                axios.post('load_all_licenses').then(({ data }) => {
                    this.myLicenses = data.data;
                });
            },
        }
    }

</script>