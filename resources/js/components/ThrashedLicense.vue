<template>
    <div>
        <div id="toolbar">
            <a href="keys" class="btn btn-primary"><i class="fas fa-list-alt"></i> View All</a>
            <button class="btn btn-success" @click="checkedlicense('restore')"><i class="fas fa-trash-restore"></i> Restore Selected</button>
            <button class="btn btn-danger" @click="checkedlicense('delete')"><i class="fas fa-times-circle"></i> Delete Permanently</button>
        </div>
        <bootstrap-table :data="thrashedLicenses" :options="myOptions" :columns="myColumns" />
    </div>
</template>

<script>
    import BootstrapTable from 'bootstrap-table/dist/bootstrap-table-vue.min.js'

    export default {
        components: {
            'bootstrap-table': BootstrapTable
        },
        data () {
            return {
                mySelections: [],
                thrashedLicenses:[],
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
                        clickToSelect: true,
                        formatter: function (e, value, row){
                            return '<button class="btn btn-sm btn-success mr-1 restore"><i class="fas fa-trash-restore"></i></button><button class="btn btn-sm btn-danger mr-1 remove"><i class="fas fa-times-circle"></i></button>'
                        },
                        events: {
                            'click .restore': ((e, value, row) => {
                                this.restore(row); 
                                // return window.location.assign('/recycle-posts/'+row.id)
                            }),
                            'click .remove': ((e, value, row) => {
                                this.remove(row); 
                                // return window.location.replace('/assign-posts/posts.trash')
                            }),
                        }
                    }
                ]
            }
        },
        created () {
            this.loadThrashedLicenses();
            Fire.$on('AfterCreate', () => {
              this.loadThrashedLicenses();  
            })
        },
        methods: {
            checkedlicense(type){
                this.mySelections = []
                let checkBoxes = document.getElementsByName('uuid')
                for (let index = 0; index < checkBoxes.length; index++) {
                    if(checkBoxes[index].type == 'checkbox' && checkBoxes[index].checked == true){
                        this.mySelections.push(checkBoxes[index].value)
                    }
                }

                if(this.mySelections.length > 0) {
                    if (type == 'delete'){
                        this.deleteLicenses()
                    } else {
                        this.restoreLicenses()
                    }
                }
            },
            deleteLicenses () {
                swal.fire({
                    title: 'Are you sure?',
                    text: 'Selected license(s) will be permanently deleted',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete!'
                })
                 .then((result) => {
                    this.$Progress.start();
                    if(result.value) {
                        this.mySelections.forEach((item, key) =>{
                            // send request to the server
                            axios.delete('force-delete?uuid='+item, {
                                id: item
                            })
                            .then(()=>{
                                if(key === (this.mySelections.length - 1)) {
                                    swal.fire(
                                        'Deleted',
                                        'License Key(s) Permanently Deleted',
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
            restoreLicenses () {
                swal.fire({
                    title: 'Are you sure?',
                    text: 'Selected license(s) will be restored',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, restore!'
                })
                 .then((result) => {
                    this.$Progress.start();
                    if(result.value) {
                        this.mySelections.forEach((item, key) =>{
                            // send request to the server
                            axios.put('restore-license?uuid='+item, {
                                id: item
                            })
                            .then(()=>{
                                if(key === (this.mySelections.length - 1)) {
                                    swal.fire(
                                        'Restored',
                                        'License Key(s) Successfully Restored',
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
            restore(row) {
                swal.fire({
                    title: 'Are you sure?',
                    text: 'This license will be restored',
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, restore it!'
                })
                .then((result) => {
                    this.$Progress.start();
                    // send request to the server
                    if(result.value) {
                        axios.put('restore-license?uuid='+row.uuid, {
                            id: row.uuid
                        })
                        .then(()=>{
                            swal.fire(
                                'Restored',
                                'Lincensed Key Successfully restored',
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
            remove(row) {
                swal.fire({
                    title: 'Are you sure?',
                    text: 'This action is irreversible',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete Permanently !'
                })
                .then((result) => {
                    this.$Progress.start();
                    
                    // send request to the server
                    if(result.value) {
                        axios.delete('force-delete?uuid='+row.uuid, {
                            id: row.uuid
                        })
                        .then(()=>{
                            swal.fire(
                                'Deleted',
                                'License Key Permanently Deleted.',
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
            loadThrashedLicenses() {
                axios.post('load_thrashed_licenses').then(({data}) => {
                    this.thrashedLicenses = data.data;
                });
            },
        }
    }
</script>