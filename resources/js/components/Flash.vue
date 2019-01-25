<template>
	<transition name="bounce">
		<div id="slider" :class="classes" class="flex items-center text-white text-sm font-bold px-8 py-6 shadow-lg rounded-r" role="alert" v-show="show">
  			<p>{{ body }}</p>
		</div>
	</transition>
</template>

<script>
	export default {
		props: ['message'],
		data() {
			return {
				body: this.message,
				show: false,
				level: 'default',
				timer: ''
			}
		},
		computed: {
            classes() {
            	let alertClass = 'bg-blue'; // default

    			if (this.level === 'success') alertClass = 'bg-green';
	            if (this.level === 'warning') alertClass = 'bg-orange';
	            if (this.level === 'error') alertClass = 'bg-red';

			    return alertClass;
            }
        },
		created() {
			if (this.body) {
				this.flash({ message: this.body, level: this.level });
			}

			Event.$on('flash-message', data => {
				this.flash(data);
			});
		},
		methods: {
			flash(data) {
				if (this.show == true) {
					this.show = false;
				}
				
				if (data) {
					this.body = data.message;
                    this.level = data.level;
				}
				
				setTimeout(() => {
					this.show = true;
				}, 100);

				window.clearTimeout(this.timer);

				this.hide();
			},
			hide() {
				this.timer = setTimeout(() => {
					this.show = false;
				}, 4000);
			}
		}
	}
</script>