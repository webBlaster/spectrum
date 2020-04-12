<script>
export default {
    data() {
        return {
            show: false,
            variants: ['primary', 'secondary', 'success', 'warning', 'danger', 'info', 'light', 'dark'],
            headerBgVariant: 'dark',
            headerTextVariant: 'light',
            bodyBgVariant: 'light',
            bodyTextVariant: 'dark',
            footerBgVariant: 'warning',
            footerTextVariant: 'dark',
            form: new Form({
                id: '',
                title : '',
                notification : '',
            })
      }
    },
    methods: {
        createNotification() {
            // $('#form').submit();
            this.$Progress.start();
            this.form.post('/admin/notification')
            .then(() => {
                this.show = false;
                this.form.reset();
                swal.fire(
                    'Home Update',
                    'Home has been Updated.',
                    'success'
                )
                this.$Progress.finish();
            })
            .catch (()=>{
                this.$Progress.fail();
            })
        }
    },
    
}
</script>