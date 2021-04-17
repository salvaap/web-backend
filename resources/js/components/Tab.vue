<template>
    <div role="tabpanel" v-show="is_active">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props: {
            title: {
                type: String,
                required: true
            },
            active: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                is_active: this.active
            }
        }
    }
</script>