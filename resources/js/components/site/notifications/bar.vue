<template>
    <div class="notification-bar" :class="notificationTypeClass">
      <span class="text-sm block sm:inline">{{notification.message}}</span>
    </div>
</template>

<script>
    import { mapActions } from 'vuex';
    export default {
        props: {
            notification: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                timeout: null
            }
        },
        mounted() {
            this.timeout = setTimeout(() => this.remove(this.notification), 1800);
        },
        beforeDestroy() {
            clearTimeout(this.timeout);
        },
        computed: {
            notificationTypeClass() {
                return `--${this.notification.type}`;
            }
        },
        methods: mapActions('notification', ['remove'])
    }
</script>