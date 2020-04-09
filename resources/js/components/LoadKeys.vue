<template>
    <div>

        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">NEW API KEY</h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Modify Key Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <form @submit.prevent="editmode ? updateKey() : createKey()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="valid_from">Api Key can be used From:</label>
                                <b-form-datepicker id="valid_from" v-model="form.valid_from" name="valid_from" class="mb-2" :class="{ 'is-invalid':form.errors.has('valid_from')}"></b-form-datepicker>
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                                <has-error :form="form" field="valid_from"></has-error>
                            </div>
                            <div class="form-group" data-provide="datepicker">
                                <label for="valid_til">Api Key can be used Till:</label>
                                <b-form-datepicker id="valid_till" v-model="form.valid_till" name="valid_till" class="mb-2" :class="{ 'is-invalid':form.errors.has('valid_till')}"></b-form-datepicker>
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div><has-error :form="form" field="valid_till"></has-error>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-disabled" @click.prevent="">{{form.key}}</button>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Update Key</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Generate ApiKey</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <div id="toolbar">
            <a href="manage-apiaccess-keys/create" @click.prevent="newModal" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add New</a>
            <!-- <a href="/recycle-posts" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Recycle Bins</a> -->
            <button class="btn btn-danger" @click="checkPosts"><i class="fas fa-minus-circle"></i> Delete Selected</button>
        </div>
        <bootstrap-table :data="myKeys" :options="myOptions" :columns="myColumns" />
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
                myKeys: [],
                form: new Form({
                    id: '',
                    duid: '',
                    key : '',
                    duration : '',
                    valid_from: '',
                    valid_till: ''
                }),
                myOptions: {
                    search: true, 
                    pagination: true,
                    showColumns: true,
                    showPrint: false,
                    showExport: true,
                    filterControl: true,
                    toolbar: '#toolbar',
                    clickToSelect: true,
                    idField: 'duid',
                    selectItemName: 'duid',
                },
                myColumns: [
                    { field: 'state', checkbox: true },
                    { field: 'key', title: 'Key', sortable: false, },
                    { field: 'duration', title: 'Duration (In Days)', sortable: true, filterControl: 'input'},
                    { field: 'valid_from', title: 'Valid From', sortable: true, filterControl: 'input'},
                    { field: 'valid_till', title: 'Valid Till', sortable: true, filterControl: 'input'},
                    { field: 'status', title: 'Status', sortable: true, filterControl: 'select'},
                    { field: 'created_by', title: 'Created By', sortable: true, filterControl: 'input'},
                    // { field: 'status', title: 'Status', sortable: true, filterControl: 'select'},
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
                            'click .show': function (e, value, row){
                                
                                return window.location.assign('/manage-apiaccess-keys/'+row.id)
                            },
                            'click .edit': ((e, value, row) => {
                                this.editModal(row);
                            }),
                            'click .destroy': ((e, value, row) => {
                                this.deleteKey(row);
                                
                            }),
                        }
                    }
                ]
            }
        },
        created () {
            this.loadAllKeys();
            Fire.$on('AfterCreate', () => {
              this.loadAllKeys();  
            })

        },
        methods: {
            checkPosts () {
                this.mySelections = []
                let checkBoxes = document.getElementsByName('duid')
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
                    text: 'You Are about to delete multiple keys',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, I know!'
                })
                .then((result) => {
                    this.$Progress.start();
                    if(result.value) {
                        this.mySelections.forEach((item, key) =>{
                            // send request to the server
                            axios.delete('/admin/manage-apiaccess-keys/'+item, {
                                id: item
                            })
                            .then(()=>{
                                if(key === (this.mySelections.length - 1)) {
                                    swal.fire(
                                        'Deleted',
                                        'Developer Apikeys Deleted.',
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
            newModal() {
                this.editmode = false,
                this.form.reset();
                $('#addNew').modal('show')
            },
            deleteKey(row) {
                swal.fire({
                    title: 'Are you sure?',
                    text: 'You Are about to delete this key',
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
                        axios.delete('/admin/manage-apiaccess-keys/'+row.duid, {
                            id: row.duid
                        })
                        .then(()=>{
                            swal.fire(
                                'Deleted',
                                'Developer Apikey Deleted.',
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
            createKey() {
                this.$Progress.start();
                this.form.post('/admin/manage-apiaccess-keys')
                .then(()=> {
                    Fire.$emit('AfterCreate')
                    $('#addNew').modal('hide')
                    toast.fire({
                        icon: 'success',
                        title: 'API Key successfully Generated'
                    });
                    this.$Progress.finish();
                })
                .catch(()=>{
                    this.$Progress.fail();
                })
            },
            updateKey() {
                this.$Progress.start();
                this.form.put('/admin/manage-apiaccess-keys/' + this.form.duid)
                .then(() => {
                    $('#addNew').modal('hide')
                    swal.fire(
                        'Key Successfully Updated',
                        'API Key has been Updated.',
                        'success'
                    )
                    Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                })
                .catch (()=>{
                    this.$Progress.fail();
                })
            },
            loadAllKeys() {
                axios.get('/admin/get-apiaccess-keys').then(({ data }) => {
                    this.myKeys = data.data;
                });
            },
        }
    }

</script>