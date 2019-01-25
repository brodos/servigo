<template>
	<div class="duration-selector rounded-lg" :class="{ 'border border-red-light' : error.first.length > 0 }">
		
		<label v-for="duration,key in durations" :class="{ 'active' : key == activeKey }">
			<span v-text="duration"></span>
			<input class="fixed invisible" v-model="activeKey" type="radio" name="duration_type" :value="key" :selected="key == activeKey">
		</label>
		
	</div>
</template>

<script>
	export default {
		props: ['durations', 'selected', 'error'],
		data() {
			return {
				activeKey: this.selected
			}
		}
	}
</script>