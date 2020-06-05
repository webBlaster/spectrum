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
            $('#notify').attr('disabled', true)
            this.$Progress.start();
            this.form.post('/admin/notification')
            .then(() => {
                $('#notify').attr('disabled', false)
                this.show = false;
                this.form.reset();
                swal.fire(
                    'Success',
                    'Notification Sent.',
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