<template>
    <div :class="{ 'hidden': isHidden }" class="flex-1">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isHidden: true,
                jsEnabled: false,
            }
        },
        props: {
            hidden: { default: true },
            name: { type: String, retuired: true }
        },
        methods: {
            checkSelectedTab() {
                alert('Tab was selected!');
            } 
        },
        mounted() {
            this.isHidden = this.hidden;
            this.jsEnabled = true;
            var vm = this;

            Event.$on('tab-was-selected', function(payload) {
                vm.isHidden = true;

                vm.isHidden = ! (vm.name === payload);
            });            
        }
    }
</script>
