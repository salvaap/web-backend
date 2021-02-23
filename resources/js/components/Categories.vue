<template>
    <div class="dropdown space-y-1">
        <label v-if="has_label" class="app-select-label block text-sm leading-5 font-medium text-gray-700">{{label_text}}</label>
        <div class="relative">
            <span class="inline-block w-full rounded-md shadow-sm">
                <button @click.prevent="visible = !visible" type="button" class="cursor-pointer relative w-full rounded-md border border-gray-300 bg-white pl-3 py-2 text-left focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    <div class="flex items-center space-x-3">
                        <span v-if="selected_category" class="block truncate font-bold text-primary-500">{{ selected_category.name }}</span>
                        <span v-else class="block truncate">{{ unselected_label }}</span>
                    </div>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                        <svg class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </button>
            </span>
            <!-- Select popover, show/hide based on select state. -->
            <div v-show="visible" class="absolute mt-2 w-full rounded-md bg-white shadow-lg">
                <ul tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-item-3" class="max-h-56 rounded-md py-1 text-base leading-6 shadow-xs overflow-auto focus:outline-none sm:text-sm sm:leading-5">
                    <!--
                        Select option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.

                        Highlighted: "text-white bg-indigo-600", Not Highlighted: "text-gray-900"
                    -->
                    <li v-for="(category, index) in categories" :key="index" @click.prevent="selectItem(category)" role="option" class="select-none relative py-2 pl-3 pr-9 hover:bg-primary-500 hover:text-white" :class="(selected_category === category) ? 'text-white bg-primary-500 cursor-default' : 'text-gray-900 cursor-pointer'">
                        <div class="flex items-center space-x-3">
                            <span class="font-normal block truncate">{{category.name}}</span>
                        </div>
                        <!--
                            Checkmark, only display for selected option.

                            Highlighted: "text-white", Not Highlighted: "text-indigo-600"
                        -->
                        <span v-if="selected_category === category" class="absolute inset-y-0 right-0 flex items-center pr-4">
                            <!-- Heroicon name: check -->
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState, mapGetters } from 'vuex';

export default {
    props: ['items', 'unselected_label', 'has_label', 'label_text'],
    name: 'Categories',
    data() {
        return {
            selected_value: null,
            visible: false,
        }
    },
    computed: {
        ...mapGetters(['getCategoryById']),
        ...mapState(['categories', 'selected_category'])
    },
    mounted() {
        //
    },
    watch: {
        visible(visible) {
            if(visible) {
                document.addEventListener('click', this.closeIfClickedOutside);
            }
        }
    },
    methods: {
        selectItem(item) {
            if(this.selected_category && this.selected_category.id === item.id) {
                return;
            }
            this.$router.push({name: 'archive', query: { category_id: item.id }});
            this.visible = false;
        },
        closeIfClickedOutside(event) {
            if(!event.target.closest('.dropdown')) {
                this.visible = false;
                document.removeEventListener('click', this.closeIfClickedOutside);
            }
        }
    }
}
</script>