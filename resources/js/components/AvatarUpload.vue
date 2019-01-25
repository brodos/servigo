<template>

	<div class="flex flex-col justify-center items-center md:flex-row md:justify-start">
		
		<img class="w-16 h-16 rounded-full mb-4 md:mb-0 md:mr-6" :src="avatar_src">
								
		<div class="flex flex-col items-center md:items-start justify-center md:justify-start">
			<input type="file" accept="image/*" name="avatar" class="" :class="{ 'border border-red-light' : hasError }" @change="displayImage">
			
			<label class="block text-grey-darker flex items-center text-center mt-4 leading-tight" v-show="hasAvatar">
				<span><input class="mb-1" type="checkbox" name="remove_avatar"></span>
				<span class="ml-2 text-sm font-semibold">Sterge avatar</span>
			</label>
		
			<div class="mt-2" v-show="hasError">

				<span class="text-sm text-red-dark block" v-text="error.first"></span>
				
			</div>

			<div class="mt-2" v-show="fileSize">

				<span class="text-grey-dark block" v-text="fileSize"></span>
				
			</div>
		</div>

	</div>

</template>

<script>
	export default {
		props: ['current', 'error'],
		data() {
			return {
				avatar_src: '',
				hasError: false,
				fileSize: false,
			}
		},
		computed: {
			hasAvatar() {
				return ! this.avatar_src.includes('gravatar');
			}
		},
		methods: {
			displayImage(e) {

                if (! e.target.files.length) return;

                let file = e.target.files[0];
                let reader = new FileReader();
                let vm = this;

                reader.readAsDataURL(file);

                vm.fileSize = this.humanFileSize(file.size);

                reader.onload = e => {  
                    let src = e.target.result; 
                    
                    vm.avatar_src = e.target.result;
                }
            },
            humanFileSize(bytes) {
			    var thresh = 1024;
			    if(Math.abs(bytes) < thresh) {
			        return bytes + ' B';
			    }
			    var units = ['kB','MB','GB','TB','PB','EB','ZB','YB'];
			    var u = -1;
			    do {
			        bytes /= thresh;
			        ++u;
			    } while(Math.abs(bytes) >= thresh && u < units.length - 1);

			    return bytes.toFixed(1)+' '+units[u];
			}
		},
		mounted() {
			this.avatar_src = this.current;

			if (this.error.first.length > 0) {
				this.hasError = true;
			}
		}
	}
</script>