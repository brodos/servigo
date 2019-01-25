<template>
	
	<input type="file" accept="image/*" multiple="multiple" name="images[]" id="fileupload" @change="onChange">
	
</template>

<script>
	export default {
		methods: {
            onChange(e) {

                if (! e.target.files.length) return;

                let files = e.target.files;
                let images_src = [];

                for (var i = 0; i < files.length; i++) {
                    (function(file) {
                        var reader = new FileReader();  

                        reader.readAsDataURL(file);

                        reader.onload = e => {  
                            let src = e.target.result; 
                            
                            Event.$emit('loaded', { src, file });
                        }
                    })(files[i]);
                }

                event.target.value = '';
            }
        }
	}
</script>