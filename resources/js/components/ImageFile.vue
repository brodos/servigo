<template>
	<span class="relative block image-file shadow-md hover:shadow-lg">
		<img class="h-auto w-full mx-auto z-10 relative" :src="media.asset_path">

		<span class="delete cursor-pointer absolute block pin-x pin-b flex items-center justify-center bg-smoke p-3 rounded text-white hover:text-red-light z-0" @click.prevent="deleteMedia">
			<svg class="w-8 h-8 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8H3a1 1 0 1 1 0-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1z"/></svg>
		</span>
	</span>
</template>

<script>
	export default {
		props: ['delete', 'media'],
		methods: {
			deleteMedia() {
				if (! confirm('Doriti sa stergeti aceasta fotografie?')) {
					return false;
				}

				let vm = this;

				axios.delete(this.media.delete_endpoint)
					.then(function(response) {
						if (response.status == 204) {
							flash('Fotografia a fost stearsa!', 'success');
							Event.$emit('media-deleted', vm.media.uuid);
						}
					})
					.catch(function(e) {
						flash('Nu am putut sterge aceasta fotografie!', 'error');
						// console.log(e);
					});
			}
		}
	}
</script>