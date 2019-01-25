<template>
	<span>
		<slot :count="count">{{ count }}</slot>
	</span>
</template>

<script>
	export default {
		props: ['elTarget','maxChars'],
		data() {
			return {
				element: document.getElementById(this.elTarget).value,
				count: 0,
			}	
		},
		methods: {
			refreshCharCount() {
				this.count = this.element.length;
			}
		},
		mounted() {
			this.refreshCharCount();
			let vm = this;

			Event.$on('charcount', function(e) {
				vm.refreshCharCount();
			});
		}
	}
</script>