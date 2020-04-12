<template>
    <div>
        <!-- <div class="slert alert-warning alert" role='alert' v-show="show"> -->
            <!-- <strong>Success</strong> {{body}} -->
            <!-- usage of this template
                <flash message="The Message"></flash>
            -->
        <!-- </div> -->
    </div>
</template>

<script>
    export default {
        props: ['message'],
        created() {
            if(this.message) {
                this.flash(this.message);
            }
            window.events.$on('flash', message => this.flash(message));
        },
        methods: {
            flash(message) {
                toast.fire({
                    icon: 'success',
                    title: message
                });
            },
        }
    }
</script>
