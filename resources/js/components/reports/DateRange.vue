<template>
    <v-row>
        <v-col cols="12" sm="6" md="4">
            <v-menu ref="menu" v-model="menu" :close-on-content-click="false" :return-value.sync="date" :nudge-right="40" transition="scale-transition" offset-y min-width="290px">
                <template v-slot:activator="{ on, attrs }">
                    <v-text-field v-model="dateRangeText" label="Selecciona un rango de fecha para el reporte" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on"></v-text-field>
                </template>
                <v-date-picker v-model="dates" color="secondary" locale="es-es" range no-title scrollable>
                    <v-spacer></v-spacer>
                    <v-btn text color="error" @click="menu = false;">Cancelar</v-btn>
                    <v-btn text color="blue" @click="$refs.menu.save(dates);">Aceptar</v-btn>
                </v-date-picker>
            </v-menu>
        </v-col>
    </v-row>
</template>
<script>

export default {
    name: 'DateRange',
    data() {
        return {
            dates: ['2020-09-10', '2020-09-20'],
            menu: false,
        };
    },
    computed: {
        dateRangeText() {
            return this.dates.join(' - ');
        }
    },
    mounted() {
    },
    methods: {
        handle() {},
    }
}
</script>