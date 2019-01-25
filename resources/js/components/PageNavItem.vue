<template>
    <li>
        <a :href="href" class="page-nav-item" :class="{ 'is-active': this.isSelected }" @click.prevent="selectedTab($event)">
            <slot></slot>
        </a>
    </li>
</template>

<script>
    export default {
        data() {
            return {
                tabs: [],
                isSelected: false,
            }
        },
        props: {
            selected: { default: false },
            name: { type: String, default: '' }
        },
        methods: {
            selectedTab(event) {
                this.tabs.forEach(tab => {
                    tab.isSelected = (tab.name == this.name);
                });

                Event.$emit('tab-was-selected', this.name);
            }
        },
        computed: {
            href() {
                return '#' + this.name;
            }
        },
        mounted() {
            this.isSelected = this.selected;

            this.tabs = this.$parent.$children;
        }
    }
</script>
