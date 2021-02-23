<template>
    <div class="form-group">
        <label v-if="label" class="form-label" for="">{{label}}</label>
        <div class="relative">
            <select class="form-control" :class="{'disabled': value === ''}" :value="value" @change="handleSelect" :disabled="loading" v-bind="$attrs">
                <option disabled value="" :selected="!value">{{ options.length ? placeholder : 'No hay datos disponibles.' }}</option>
                <option v-for="(option, index) in options" :key="index" :value="getValue(option)" :selected="option === value">{{ getText(option) }}</option>
            </select>
            <span class="form-dropicon">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </span>
            <span v-if="loading" class="form-loading-container"><span class="loader-xs"></span></span>
        </div>
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
                type: [Object, String, Number],
                default: null
            },
            label: {
                type: [String, Number],
                default: ''
            },
            options: {
                type: Array,
                required: true
            },
            placeholder: {
                type: String,
                default: 'Seleccione una opción'
            },
            itemValue: {
                type: String,
                default: 'value'
            },
            itemText: {
                type: String,
                default: 'text'
            },
            errors: {
                type: [Array, String],
                default: ''
            },
            loading: {
                type: Boolean,
                default: false
            }
        },
        methods: {
            handleSelect(e) {
                this.$emit('input', e.target.value);
                this.$emit('change', e.target.value);
            },
            getValue(option) {
                return option[this.itemValue] ? option[this.itemValue] : option;
            },
            getText(option) {
                return option[this.itemText] ? option[this.itemText] : option;
            }
        }
    }
</script>