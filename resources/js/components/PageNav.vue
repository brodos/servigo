<template>
	<ul class="list-reset flex items-start justify-between sm:justify-start text-center">
		<slot></slot>
	</ul>
</template>

<script>
	export default {
		data() {
			return {
				tabs: []
			}
		},
		methods: {
			selectedTab(event) {
				console.log(event);
			}
		},
		created() {
			this.tabs = this.$children;
		}
	}
</script>