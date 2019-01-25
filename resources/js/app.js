require('./bootstrap');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

window.Event = new Vue;

Vue.component("projects-tab", require("./components/ProjectsTab.vue"));
Vue.component("page-nav", require("./components/PageNav.vue"));
Vue.component("page-nav-item", require("./components/PageNavItem.vue"));
Vue.component("image-file", require("./components/ImageFile.vue"));
Vue.component("image-upload", require("./components/ImageUpload.vue"));
Vue.component("flash-message", require("./components/Flash.vue"));
Vue.component("zone-selector", require("./components/ZoneSelector.vue"));
Vue.component("date-range-selector", require("./components/DateRangeSelector.vue"));
Vue.component("date-selector", require("./components/DateSelector.vue"));
Vue.component("chars-counter", require("./components/CharsCounter.vue"));
Vue.component("favorite", require("./components/Favorite.vue"));
Vue.component("save-project", require("./components/SaveProject.vue"));
Vue.component("dismiss-proposal", require("./components/DismissProposal.vue"));
Vue.component("withdraw-proposal", require("./components/WithdrawProposal.vue"));
Vue.component("duration-selector", require("./components/DurationSelector.vue"));
Vue.component("avatar-upload", require("./components/AvatarUpload.vue"));

var App = new Vue({
    el: '#app',
	data: {
		isDisabled: false,
        go_href: '',
        jsEnabled: false,
        char_count: 0,
        proposalPrice: '',
        county: null,
        cities: [],
        selectedCity: null,
	},
    computed: {
        hasCounty() {
            return !! this.county;
        }
    },
    methods: {
    	disableElement(event) {
    		return this.isDisabled = true;
    	},
        navigate(url) {
            window.location = url;
        },
        emit(name) {
            Event.$emit(name);
        },
        refreshCharCount(e) {
            this.char_count = e.target.value.length;
            // console.log(e.target.value.length);
        },
        changedCounty(e) {
            if (e.target.value > 0) {
                this.loadCities(e.target.value);
            }
        },
        loadCities(county_id) {
            this.selectedCity = null;
            this.county = county_id;

            let vm = this;

            if (this.county == 9) {
                this.cities = [{
                    "id": 2715,
                    "county_id": 9,
                    "longitude": "26.1038838888498430",
                    "latitude": "44.4358746656060930",
                    "name": "Municipiul București"
                }];

                this.selectedCity = 2715;

                return;
            }

            axios.get('/api/judete/' + this.county)
                .then(function(response) {
                    if (response.data.success === true) {
                        vm.cities = response.data.county.cities;
                    }
                })
                .catch(function(e) {
                    flash('Localitatile nu au putut fi incarcate.', 'error');
                    console.log(e);
                });
            
        },
        selectCity(e) {
            this.selectedCity = e.target.value;
        },
        removeMedia(uuid) {
            let mediaElement = 'media-' + uuid;
            let element = this.$refs[mediaElement];

            element.parentNode.removeChild(element);
        },
        confirmAction(e, title) {
            if (confirm(title) === false) {
                e.preventDefault();

                return;
            }

            this.disableElement();
        }
    },
    mounted() {
        this.jsEnabled = true;

        if (this.$refs['counties'] && this.$refs['counties'].dataset.county != '') {
            this.county = this.$refs['counties'].dataset.county;
            this.loadCities(this.county);
        }

        if (this.$refs['cities'] && this.$refs['cities'].dataset.city != '') {
            this.selectedCity = this.$refs['cities'].dataset.city;
        }

        Event.$on('media-deleted', this.removeMedia);
    }
});

window.flash = function (message, level = 'default') {
	window.Event.$emit('flash-message', { message, level });
}

// window.onload = function() {
//     var msgDiv = document.getElementById("messages");
//     msgDiv.scrollTop = msgDiv.scrollHeight;
//     console.log(msgDiv.scrollTop);
// }
