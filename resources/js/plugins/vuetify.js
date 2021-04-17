import VueI18n from 'vue-i18n';
import Vue2Editor from "vue2-editor";

Vue.use(Vuetify);
Vue.use(VueI18n);
Vue.use(Vue2Editor);

const messages = {
    en: {
        $vuetify: {
            close: 'Close',
            dataIterator: {
                pageText: '{0}-{1} of {2}',
                noResultsText: 'No matching records found',
                loadingText: 'Loading items...',
            },
            dataTable: {
                itemsPerPageText: 'Rows per page:',
                ariaLabel: {
                    sortDescending: ': Sorted descending. Activate to remove sorting.',
                    sortAscending: ': Sorted ascending. Activate to sort descending.',
                    sortNone: ': Not sorted. Activate to sort ascending.',
                },
                sortBy: 'Sort by',
            },
            dataFooter: {
                itemsPerPageText: 'Items per page:',
                itemsPerPageAll: 'All',
                nextPage: 'Next page',
                prevPage: 'Previous page',
                firstPage: 'First page',
                lastPage: 'Last page',
            },
            datePicker: {
                itemsSelected: '{0} selected',
                prevMonthAriaLabel: 'previous',
                nextMonthAriaLabel: 'next',
                prevYearAriaLabel: 'previous',
                nextYearAriaLabel: 'next',
            },
            noDataText: 'No data available',
            carousel: {
                prev: 'Previous visual',
                next: 'Next visual',
            },
            calendar: {
                moreEvents: '{0} more',
            },
            fileInput: {
                counter: '{0} files',
                counterSize: '{0} files ({1} in total)',
            },
        },
    },
    es: {
        $vuetify: {
            close: 'Cerrar',
            dataIterator: {
                pageText: '{0}-{1} de {2}',
                noResultsText: 'Ningún elemento coincide con la búsqueda',
                loadingText: 'Cargando...',
            },
            dataTable: {
                itemsPerPageText: 'Filas por página:',
                ariaLabel: {
                    sortDescending: ': Orden descendente. Pulse para quitar orden.',
                    sortAscending: ': Orden ascendente. Pulse para ordenar descendente.',
                    sortNone: ': Sin ordenar. Pulse para ordenar ascendente.',
                },
                sortBy: 'Ordenado por',
            },
            dataFooter: {
                itemsPerPageText: 'Elementos por página:',
                itemsPerPageAll: 'Todos',
                nextPage: 'Página siguiente',
                prevPage: 'Página anterior',
                firstPage: 'Primer página',
                lastPage: 'Última página',
            },
            datePicker: {
                itemsSelected: '{0} seleccionados',
                prevMonthAriaLabel: 'anterior',
                nextMonthAriaLabel: 'siguiente',
                prevYearAriaLabel: 'previous',
                nextYearAriaLabel: 'next',
            },
            noDataText: 'No hay datos disponibles',
            carousel: {
                prev: 'Visual anterior',
                next: 'Visual siguiente',
            },
            calendar: {
                moreEvents: '{0} más',
            },
            fileInput: {
                counter: '{0} archivos',
                counterSize: '{0} archivos ({1} en total)',
            },
        },
    },
};

const i18n = new VueI18n({
    locale: 'es',
    messages,
});

export default new Vuetify({
    theme: {
        dark: false,
        themes: {
            light: {
                primary: '#2A2F3D',
                secondary: '#FF6732',
                accent: '#FFCA00',
                error: '#f51818',
            },
        },
    },
    icons: {
        iconfont: 'mdi', // default - only for display purposes
    },
    lang: {
        t: (key, ...params) => i18n.t(key, params),
    },
});