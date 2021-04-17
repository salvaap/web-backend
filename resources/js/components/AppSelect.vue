<template>
    <div class="space-y-1">
        <label class="app-select-label block text-sm leading-5 font-medium text-gray-700">Texto label</label>
        <div class="relative">
            <span class="inline-block w-full rounded-md shadow-sm">
                <button @click.prevent="toggle_visibility()" type="button" class="cursor-pointer relative w-full rounded-md border border-gray-300 bg-white pl-3 py-2 text-left focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    <div class="flex items-center space-x-3">
                        <span class="block truncate">Valor seleccionado</span>
                    </div>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </button>
            </span>
            <!-- Select popover, show/hide based on select state. -->
            <div class="absolute mt-1 w-full rounded-md bg-white shadow-lg" :class="{'invisible': !visible}">
                <ul tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-item-3" class="max-h-56 rounded-md py-1 text-base leading-6 shadow-xs overflow-auto focus:outline-none sm:text-sm sm:leading-5">
                    <!--
                        Select option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.

                        Highlighted: "text-white bg-indigo-600", Not Highlighted: "text-gray-900"
                    -->
                    <li role="option" class="text-white bg-primary-500 cursor-default select-none relative py-2 pl-3 pr-9">
                        <div class="flex items-center space-x-3">
                            <span class="font-normal block truncate">
                                Elemento 1
                            </span>
                        </div>
                        <!--
                            Checkmark, only display for selected option.

                            Highlighted: "text-white", Not Highlighted: "text-indigo-600"
                        -->
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4">
                            <!-- Heroicon name: check -->
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </li>
                    <li role="option" class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9">
                        <div class="flex items-center space-x-3">
                            <span class="font-normal block truncate">
                                Elemento 2
                            </span>
                        </div>
                    </li>
                    <li role="option" class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9">
                        <div class="flex items-center space-x-3">
                            <span class="font-normal block truncate">
                                Elemento 3
                            </span>
                        </div>
                    </li>
                    <li role="option" class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9">
                        <div class="flex items-center space-x-3">
                            <span class="font-normal block truncate">
                                Elemento 4
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['items', 'has_label', 'label_text'],
    name: 'AppSelect',
    data() {
        return {
            selected_value: null,
            visible: false,
        }
    },
    methods: {
        toggle_visibility() {
            this.visible = !this.visible;
        }
    }
}
</script>