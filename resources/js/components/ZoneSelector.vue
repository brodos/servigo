<template>
	<div class="relative">
		<div class="relative">
  			<input type="search" v-model="selectedCounty" class="w-full bg-grey-lightest appearance-none rounded text-blue-darker text-sm border p-4 pl-10  focus:bg-white focus:shadow-inner focus:outline-none" placeholder="Toata tara" @focus="showDropdown" disabled/>
  			<span class="absolute pin-t pin-l pl-3 pt-4 text-grey">
				<svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg>
			</span>
			<a href="#" class="absolute pin-t pin-r pr-3 pt-2 text-indigo z-10 no-underline" @click.prevent="toggleDropdown">
				<svg class="fill-current w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z"/></svg>
			</a>
		</div>

		<div class="dropdown-menu absolute bg-white rounded shadow-lg z-30 mt-2 h-auto overflow-hidden" style="width: 70rem;" v-show="opened">
			<ul class="ap-suggestions list-reset py-2 w-full flex flex-wrap">
				<li class="w-1/4" v-for="county, index in counties">
					<a href="#" class="ap-suggestion flex items-center py-3 px-8 no-underline" @click.prevent="selectCounty" :key="index" :ref="'county-'+index" :class="{'bg-indigo-lightest': index === selectedIndex}" @selected="selectedHandler" @mouseover="updateSelectedIndex" :data-key="index">
						<span class="ap-suggestion-icon text-grey mr-2">
							<svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-6 h-6" viewBox="0 0 24 24"><path class="heroicon-ui" d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg>
						</span>
						<span class="whitespace-no-wrap"><span class="text-grey">{{ county.slug == 'bucuresti' ? 'Municipiul' : 'Judetul' }}</span> <span class="ap-name text-grey-darker font-bold">{{ county.name }}</span></span>
					</a>
				</li>
				<!-- Other suggestions -->
			</ul>
		</div>
		
	</div>
</template>

<script>
	export default {
		props: ['passedCounties'],
		data() {
			return {
				selectedCounty: '',
				counties: {},
				selectedIndex: -1,
				listLength: 0,
				element: '',
				opened: false,
			}
		},
		computed: {
			filteredList() {
				var vm = this;
				return this.passedCounties.filter(function(county) {
        			return county.search_name.toLowerCase().includes(vm.selectedCounty.toLowerCase());
        		});
			}
		},
		methods: {
			toggleDropdown() {
				return this.opened = ! this.opened;
			},
			showDropdown() {
				this.opened = true;
			},
			hideDropdown() {
				this.opened = false;
			},
			selectCounty(event) {
				this.selectedCounty = this.counties[this.selectedIndex].name;
  	 			this.hideDropdown();
			},
			addKeyHandler(e) {
   				window.addEventListener("keydown", this.keyHandler);
 			},
 			removeKeyHandler() {
   				window.removeEventListener("keydown", this.keyHandler);
 			},
 			updateSelectedIndex(e) {
 				this.selectedIndex = parseInt(e.target.dataset.key);
 			},
 			keyHandler(e) {
				 /**
				 38 — up
				 40 — down
				 9 — tab
				 13 — enter
				 */
				const key = e.which || e.keyCode;
				if (key === 38 || (e.shiftKey && key === 9)) {
			   		this.handleKeyUp(e);
			 	} else if (key === 40 || key === 9) {
			   		this.handleKeyDown(e);
			 	} else if (key === 13) {
			   		this.handleEnter(e);
			 	}
			},
			handleKeyUp(e) {
				e.preventDefault();
				if (this.selectedIndex <= 0) {
					// If index is less than or equal to zero then set it to the last item index
					this.selectedIndex = this.listLength - 1;
				} else if (this.selectedIndex > 0 && this.selectedIndex <= this.listLength - 1) {
					// If index is larger than zero and smaller or equal to last index then decrement
					this.selectedIndex--;
				}
				var offset = this.$refs['county-'+this.selectedIndex][0].offsetTop + this.$refs['county-'+this.selectedIndex][0].clientHeight  - this.element.clientHeight;
				// console.log(offset);
				this.element.scrollTop = offset;
			},
			handleKeyDown(e) {
				e.preventDefault();
				// Check if index is below 0
				// // This means that we did not start yet
				if (this.selectedIndex < 0 || this.selectedIndex === this.listLength - 1) {
					// Set the index to the first item
					this.selectedIndex = 0;
				} else if (this.selectedIndex >= 0 && this.selectedIndex < this.listLength - 1) {
					this.selectedIndex++;
				}

				var offset = this.$refs['county-'+this.selectedIndex][0].offsetTop + this.$refs['county-'+this.selectedIndex][0].clientHeight  - this.element.clientHeight;
				// console.log(offset);
				this.element.scrollTop = offset;
				// $(".wrapper .inner_div").scrollTop($('.element-hover:first').offset().top-$(".wrapper .inner_div").height());//then set equal to the position
				 
			},
			handleEnter(e) {
				e.preventDefault();

				// console.log();
				Event.$emit('selected', this.selectedIndex);
			},
			selectedHandler() {
  	 			this.selectedCounty = this.counties[this.selectedIndex].name;
  	 			this.hideDropdown();
 			},
		},
		mounted() {
			this.counties = this.passedCounties;
			this.listLength = Object.keys(this.passedCounties).length;
			this.addKeyHandler();
			this.element = document.querySelector('.dropdown-menu');
			Event.$on('selected', this.selectedHandler);
			console.log(this.counties);
		},
		destroyed() {
			this.removeKeyHandler();
		}
	}
</script>

<style>

</style>