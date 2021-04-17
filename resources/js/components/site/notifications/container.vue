<template>
    <div class="notification-container" :class="{'active': notifications.length}">
        <notification-bar v-for="notification in notifications" :key="notification.id" :notification="notification"></notification-bar>
    </div>
</template>
<script>
    import NotificationbBar from './bar';
    import { mapState } from 'vuex';
    export default {
        components: {
            'notification-bar': NotificationbBar
        },
        computed: mapState('notification', ['notifications'])
    }
</script>