<template>
	<a v-cloak :href="endpoint" @click.prevent="toggle" class="no-underline pl-2 py-2" :class="active ? 'text-indigo-dark' : 'text-grey-dark hover:text-indigo-dark'" :title="active ? 'Scoate de la favorite!' : 'Adaugă la favorite!'">
		<svg class=" fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"><path :d="active ? 'm6.1,21.98a1,1 0 0 1 -1.45,-1.06l1.03,-6.03l-4.38,-4.26a1,1 0 0 1 0.56,-1.71l6.05,-0.88l2.7,-5.48a1,1 0 0 1 1.8,0l2.7,5.48l6.06,0.88a1,1 0 0 1 0.55,1.7l-4.38,4.27l1.04,6.03a1,1 0 0 1 -1.46,1.06l-5.4,-2.85l-5.42,2.85z' : 'M6.1 21.98a1 1 0 0 1-1.45-1.06l1.03-6.03-4.38-4.26a1 1 0 0 1 .56-1.71l6.05-.88 2.7-5.48a1 1 0 0 1 1.8 0l2.7 5.48 6.06.88a1 1 0 0 1 .55 1.7l-4.38 4.27 1.04 6.03a1 1 0 0 1-1.46 1.06l-5.4-2.85-5.42 2.85zm4.95-4.87a1 1 0 0 1 .93 0l4.08 2.15-.78-4.55a1 1 0 0 1 .29-.88l3.3-3.22-4.56-.67a1 1 0 0 1-.76-.54l-2.04-4.14L9.47 9.4a1 1 0 0 1-.75.54l-4.57.67 3.3 3.22a1 1 0 0 1 .3.88l-.79 4.55 4.09-2.15z'"/></svg>
	</a>
</template>

<script>
	export default {
		props: ['entity'],
		data() {
			return {
				active: this.entity.isFavorited
			}
		},
		computed: {
            endpoint() {
                return this.entity.favoritePath;
            }
        },
        methods: {
        	toggle() {
                this.active ? this.destroy() : this.create();
            },

            create() {
                axios.post(this.endpoint);
                this.active = true;
                flash('Adăugat la favorite!', 'success');
            },
            destroy() {
                axios.delete(this.endpoint);
                this.active = false;
                flash('Scos de la favorite!', 'success');
            }
        },
        mounted() {
        	// console.log(this.entity);
        }
	}
</script>