<template>
	<div v-cloak>
		<image-upload-input class="appearance-none focus:outline-none opacity-0 overflow-hidden absolute" style="width: 0.1px; height: 0.1px; z-index: -1;"></image-upload-input>

		<label for="fileupload" class="w-full md:w-64 btn btn-indigo-secondary py-4 flex items-center justify-center border-dashed cursor-pointer">
			<svg class="fill-current md:w-5 md:h-5 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13 5.41V17a1 1 0 0 1-2 0V5.41l-3.3 3.3a1 1 0 0 1-1.4-1.42l5-5a1 1 0 0 1 1.4 0l5 5a1 1 0 1 1-1.4 1.42L13 5.4zM3 17a1 1 0 0 1 2 0v3h14v-3a1 1 0 0 1 2 0v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-3z"/></svg>
			<span class="ml-4">Adauga fotografii</span>
		</label>

		<div class="images w-full" v-show="show">
			
			<ul class="list-reset flex items-center justify-start pt-4">
				<li v-for="image in images" class="mr-2">
					<img :src="image" class="w-auto h-16 md:h-24">
				</li>
			</ul>

			<div class="hidden">
				<input type="hidden" name="images[]" v-for="image in uploadedImages" :value="image">
			</div>

		</div>
	</div>
</template>

<script>
	import ImageUploadInput from './ImageUploadInput.vue';

	export default {
		props: ['user', 'uploaded'],

		data() {
            return {
                images: [],
                uploadedImages: []
            };
        },

		components: { ImageUploadInput },

		computed: {
			show: function() {
				return this.images.length > 0;
			}
		},

		methods: {
            onLoad(image) {
                this.image = image.src;
                this.persist(image);
                
            },
            persist(image) {
                let data = new FormData();
                let message = this.images.length > 1 ? 'Fotografiile au fost incarcate cu succes.' : 'Fotografia a fost incarcata cu succes.';
                let vm = this;
                let file = image.file;

                data.append('media', file);
                axios.post(`/api/media`, data, { headers: {
			    	'Content-Type': 'multipart/form-data'
			    }}).then(function(response) {
			    	if (response.data.success === true) {
			    		vm.uploadedImages.push(response.data.media.uuid);
                        vm.images.push(image.src);
                        flash(message, 'success');
			    	} else {
                        flash(message, 'error');
                    }
			    	
			    }).catch(function(e) {
			    	flash(e.response.data.errors.media[0], 'error');
			    });
            }
        },

        created() {

        	if (this.uploaded != false) {
        		this.uploadedImages = this.uploaded

        		var vm = this;

        		axios.get('/api/media', {
        			params: {
        				uuid: this.uploaded
        			}
        		}).then(function(response) {
        			if (response.data.length > 0) {
        				response.data.forEach(function(image) {
        					vm.images.push(image.asset_path);
        					// vm.show = true;
        				});
        			}
        		});
        	} else {
        		this.uploadedImages = [];
        	}
        	Event.$on('loaded', this.onLoad);
        }
	}
</script>