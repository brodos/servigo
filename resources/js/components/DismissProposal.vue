<template>
	<a href="#" @click.prevent="dismissProposal" class="no-underline px-2 py-2 text-grey-dark">
		<span class="hover:text-indigo-dark cursor-pointer" title="Ascunde oferta">
			<svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"><path d="M6.38 14H4a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h11.5c1.2 0 2.3.72 2.74 1.79l3.5 7 .03.06A3 3 0 0 1 19 15h-5v5a2 2 0 0 1-2 2h-1.62l-4-8zM8 12.76L11.62 20H12v-7h7c.13 0 .25-.02.38-.08a1 1 0 0 0 .55-1.28l-3.5-7.02A1 1 0 0 0 15.5 4H8v8.76zM6 12V4H4v8h2z"/></svg>
		</span>
	</a>
</template>

<script>
	export default {
		props: ['proposal'],
		methods: {
			dismissProposal() {
				if (confirm('Doriți să ascundeți această ofertă?') !== false) {
					axios.patch(this.proposal.dismissPath);

					flash('Oferta a fost ascunsa', 'success');
				}
			}
		}
	}
</script>