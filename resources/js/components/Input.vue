<template>
    <div class="form-group">
        <label v-if="label" class="form-label">{{label}}</label>
        <input class="form-control" :placeholder="placeholder ? placeholder : label" :value="value" @input="handleInput" v-bind="$attrs">
        <template v-if="Array.isArray(errors)">
            <span v-for="(error, index) in errors" :key="index" class="form-error">{{error}}</span>
        </template>
        <template v-else>
            <span v-if="errors" class="form-error">{{errors}}</span>
        </template>
    </div>
</template>

<script>
    export default {
        props: {
            value: {
                type: [String, Number],
                default: ''
            },
            placeholder: {
                type: String,
                default: ''
            },
            label: {
                type: String,
                default: ''
            },
            errors: {
                type: [Array, String],
                default: ''
            }
        },
        methods: {
            handleInput(e) {
                this.$emit('input', e.target.value);
            }
        }
    }
</script>