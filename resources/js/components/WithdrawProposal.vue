<template>
	<a href="#withdraw" @click.prevent="withdrawProposal" class="btn btn-grey-secondary inline-block">
		Retrage <span class="hidden sm:inline-block">oferta</span>
	</a>
</template>

<script>
	export default {
		props: ['proposal'],
		methods: {
			withdrawProposal() {
				if (confirm('Doriți să vă retrageți oferta?') !== false) {
					axios.patch(this.proposal.withdrawPath);

					flash('Oferta a fost retrasă!', 'success');
				}
			}
		}
	}
</script>