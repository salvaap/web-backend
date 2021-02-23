<template>
    <div class="tabs-wrapper">
        <aside class="tabs-items-container">
            <ul role="tablist">
                <li v-for="(tab, index) in tabs" :key="index">
                    <a :class="{'active' : tab.is_active}" :aria-selected="tab.is_active" role="tab" @click.prevent="activeTab = tab">{{ tab.title }}</a>
                </li>
            </ul>
        </aside>
        <section class="tabs-content-wrapper">
            <div class="tabs-content-container">
                <slot></slot>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        props: {},
        data() {
            return {
                tabs: [],
                activeTab: null
            }
        },
        mounted() {
            this.tabs = this.$children;
            this.setInitActiveTab();
        },
        watch: {
            activeTab(activeTab) {
                this.tabs.map(tab => (tab.is_active = tab === activeTab));
            }
        },
        methods: {
            setInitActiveTab() {
                this.activeTab = this.tabs.find(tab => tab.active) || this.tabs[0];
            }
        }
    }
</script>