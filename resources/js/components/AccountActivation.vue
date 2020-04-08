<script>
export default {
    props: ['user_id'],
    data() {
        return {
            activatedUsers: '',
            nonActivatedUsers : '',
            active_id : this.user_id
        }
    },
    methods: {
        loadActivatedUsers() {
            axios.get('/admin/accounts/load-accounts/activated').then(({ data }) => {
                this.activatedUsers = data;
            });
        },
        loadNonActivatedUsers() {
            axios.get('/admin/accounts/load-accounts/unactivated').then(({ data }) => {
                this.nonActivatedUsers = data;
            });
        },
        activateUser(id, message) {
            this.$Progress.start();
            axios.put('activate-account/' + id)
            .then(()=>{
                toast.fire({
                    icon: 'success',
                    title: 'User Account Successfuly ' + message
                });
                Fire.$emit('AfterCreate')
                this.$Progress.finish();
            })
            .catch(()=>{
                swal.fire("failed", "There was something wrong.", "warning");
                this.$Progress.fail();
            })
            
        },
        togglePriviledge(id, name, priviledge) {
            const adminName = name.toUpperCase();
            
            this.$Progress.start();
            
            swal.fire({
                title: 'Are you sure?',
                text: 'You are about to make ' + adminName + ' ' + priviledge,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Continue!'
            }).then((result) => {
                // send request to the server
                if(result.value) {
                    axios.put('alter-priviledge/' + id).then(()=>{
                        swal.fire(
                            'Success',
                            adminName + ' is now ' + priviledge,
                            'success'
                        )
                        this.$Progress.finish();
                        Fire.$emit('AfterCreate')
                    }).catch(()=>{
                        swal.fire("failed", "Could not toggle user priviledge.", "warning");
                        this.$Progress.fail();
                    })
                }
                this.$Progress.finish();
            })    
        },
        deleteUser(id) {
            this.$Progress.start();
            swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                
                // send request to the server
                if(result.value) {
                    axios.delete('delete-account/' + id).then(()=>{
                        swal.fire(
                            'Deleted',
                            'User Data has been deleted.',
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
    },
    created() {
        this.loadActivatedUsers();
        this.loadNonActivatedUsers();
        Fire.$on('AfterCreate', () => {
            this.loadActivatedUsers();
            this.loadNonActivatedUsers();
        });
    }
}
</script>