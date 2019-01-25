<template>
	<div v-cloak>
		<div class="flex flex-col items-center md:flex-row">
							
			<div class="w-full md:w-auto">
				<input type="text" id="availableFrom" ref="availableFrom" name="available_from" class="w-full focus:outline-none appearance-none p-4 bg-grey-lighter rounded leading-tight text-indigo-darker cursor-pointer" v-model="available_from" placeholder="Alege o dată..." :class="{ 'border border-red-light' : errors.available_from.length > 0 }">
			</div>

		</div>

		<span class="text-sm text-grey-dark block mt-2" v-if="date_result.length > 3" v-text="date_result"></span>

		<span class="text-sm text-red-dark block mt-2" v-show="errors.available_from">{{ errors.available_from }}</span>
		
	</div>
</template>

<script>
	export default {
		props: ['old', 'errors'],
		data() {
			return {
				available_from: this.old.available_from,
				date_result: '',
				picker: null,
			}
		},
		computed: {
			
		},
		methods: {
			
		},
		mounted() {
			var vm = this;
			this.picker = new Lightpick({
				field: vm.$refs['availableFrom'],
				lang: 'ro',
    			singleDate: true,
    			numberOfMonths: 2,
    			locale: {
			        tooltip: {
			            one: 'zi',
			            few: 'zile',
			            many: 'zile',
			            other: 'zile',
			        },
			        pluralize: function(i, locale) {
			            if ('one' in locale && i % 10 === 1 && !(i % 100 === 11)) return locale.one;
			            if ('few' in locale && i % 10 === Math.floor(i % 10) && i % 10 >= 2 && i % 10 <= 4 && !(i % 100 >= 12 && i % 100 <= 14)) return locale.few;
			            if ('many' in locale && (i % 10 === 0 || i % 10 === Math.floor(i % 10) && i % 10 >= 5 && i % 10 <= 9 || i % 100 === Math.floor(i % 100) && i % 100 >= 11 && i % 100 <= 14)) return locale.many;
			            if ('other' in locale) return locale.other;
			    
			            return '';
			        }
			    },
    			onSelect: function(start, end) {
    				if (start) {
    					vm.available_from = start.format('DD/MM/YYYY');
    				}
        			var str = '';
        			str += start ? start.format('dddd, Do MMMM YYYY') : '';
        			vm.date_result = str;
    			}
			});

			if (this.available_from != null && this.available_from.length > 0) {
				this.picker.setDate(moment(this.available_from, 'DD/MM/YYYY'));
                this.date_result = moment(this.available_from, 'DD/MM/YYYY').format('dddd, Do MMMM YYYY');
			}
		}
	}
</script>

<style>
	.lightpick {
    position: absolute;
    z-index: 99999;
    padding: 4px;
    border-radius: 4px;
    background-color: #FFF;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
    color: #000;
    font-family: system-ui, Roboto, Helvetica, Arial, sans-serif;
    line-height: 1.125em;
}

.lightpick--inlined {
    position: static;
}

.lightpick,
.lightpick *,
.lightpick::after,
.lightpick::before {
    box-sizing: border-box;
}

.lightpick.is-hidden {
    display: none;
}

.lightpick__months {
    display: grid;
    background-color: #EEE;
    grid-template-columns: auto;
    grid-gap: 1px;
}

.lightpick--2-columns .lightpick__months {
    grid-template-columns: auto auto;
}

.lightpick--3-columns .lightpick__months {
    grid-template-columns: auto auto auto;
}

.lightpick--4-columns .lightpick__months {
    grid-template-columns: auto auto auto auto;
}

.lightpick--5-columns .lightpick__months {
    grid-template-columns: auto auto auto auto auto;
}

.lightpick__month {
    padding: 4px;
    width: 288px;
    background-color: #FFF;
}

.lightpick__month-title-bar {
    display: flex;
    margin-bottom: 4px;
    justify-content: space-between;
    align-items: center;
}

.lightpick__month-title {
    margin-top: 4px;
    margin-bottom: 4px;
    margin-left: 4px;
    font-size: 16px;
    font-weight: normal;
    line-height: 24px;
    cursor: default;
    padding: 0 4px;
    border-radius: 4px;
}
.lightpick__month .lightpick__month-title:hover {
    background-color: #EEE;
}

.lightpick__month-title-accent {
    font-weight: bold;
    pointer-events: none;
}

.lightpick__toolbar {
    display: flex;
    text-align: right;
    justify-content: flex-end;
}

.lightpick__previous-action,
.lightpick__next-action,
.lightpick__close-action {
    display: flex;
    margin-left: 6px;
    width: 32px;
    height: 32px;
    outline: none;
    border: none;
    border-radius: 50%;
    background-color: #DDD;
    justify-content: center;
    align-items: center;
}

.lightpick__previous-action,
.lightpick__next-action {
    font-size: 12px;
}

.lightpick__close-action {
    font-size: 18px;
}

.lightpick__previous-action:active,
.lightpick__next-action:active,
.lightpick__close-action:active {
    color: inherit;
}

.lightpick__days-of-the-week {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
}

.lightpick__day-of-the-week {
    display: flex;
    font-size: 11px;
    font-weight: bold;
    justify-content: center;
    align-items: center;
}

.lightpick__days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
}

.lightpick__day {
    display: flex;
    height: 40px;
    background-position: center center;
    background-size: contain;
    background-repeat: no-repeat;
    font-size: 13px;
    justify-content: center;
    align-items: center;
    cursor: default;
}

.lightpick__day.is-today {
    background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Ccircle fill='rgba(220, 50, 47, 0.06)' cx='16' cy='16' r='16'/%3E%3C/svg%3E");
    background-size: 61.8% auto;
    color: #DC322F;
}

.lightpick__day:not(.is-disabled):hover {
    background-size: contain;
    background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Ccircle fill='%23E0E0E0' cx='16' cy='16' r='16'/%3E%3C/svg%3E");
}

.lightpick__day.is-disabled {
    opacity: 0.38;
    pointer-events: none;
}

.lightpick__day.disabled-tooltip {
    pointer-events: auto;
}

.lightpick__day.is-disabled.is-forward-selected {
    opacity: 1;
}
.lightpick__day.is-disabled.is-forward-selected:not(.is-start-date) {
    background-color: rgba(38, 139, 210, 0.1);
    background-image: none;
}

.lightpick__day.is-previous-month,
.lightpick__day.is-next-month {
    opacity: 0.38;
}

.lightpick__day.lightpick__day.is-in-range:not(.is-disabled) {
    opacity: 1;
}

.lightpick__day.is-in-range {
    border-radius: 0;
    background-color: #E6E8FF;
    background-image: none;
}

.lightpick__day.is-in-range:hover {
    background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Ccircle fill='rgba(38, 139, 210, 0.5)' cx='16' cy='16' r='16'/%3E%3C/svg%3E");
}

.lightpick__day.is-start-date.is-in-range,
.lightpick__day.is-end-date.is-in-range.is-flipped {
    border-top-left-radius: 50%;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 50%;
    background-color: #7886d7;
    background-image: none;
}

.lightpick__day.is-end-date.is-in-range,
.lightpick__day.is-start-date.is-in-range.is-flipped {
    border-top-left-radius: 0;
    border-top-right-radius: 50%;
    border-bottom-right-radius: 50%;
    border-bottom-left-radius: 0;
    background-color: #7886d7;
    background-image: none;
}

.lightpick__day.is-start-date.is-end-date {
    background-color: transparent;
    background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Ccircle fill='%23268BD2' cx='16' cy='16' r='16'/%3E%3C/svg%3E");
}

.lightpick__day.is-start-date,
.lightpick__day.is-end-date,
.lightpick__day.is-start-date:hover,
.lightpick__day.is-end-date:hover {
    background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Ccircle fill='%23268BD2' cx='16' cy='16' r='16'/%3E%3C/svg%3E");
    color: #FFF;
    font-weight: bold;
}

.lightpick__tooltip {
    position: absolute;
    margin-top: -4px;
    padding: 4px 8px;
    border-radius: 4px;
    background-color: #FFF;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
    white-space: nowrap;
    font-size: 11px;
    pointer-events: none;
}

.lightpick__tooltip::before {
    position: absolute;
    bottom: -5px;
    left: calc(50% - 5px);
    border-top: 5px solid rgba(0, 0, 0, 0.12);
    border-right: 5px solid transparent;
    border-left: 5px solid transparent;
    content: "";
}

.lightpick__tooltip::after {
    position: absolute;
    bottom: -4px;
    left: calc(50% - 4px);
    border-top: 4px solid #FFF;
    border-right: 4px solid transparent;
    border-left: 4px solid transparent;
    content: "";
}

.lightpick__months-of-the-year {
    padding: 4px;
    background-color: #FFF;
}
.lightpick__months-of-the-year-list {
    display: grid;
    grid-template-columns: auto auto auto;
    grid-gap: 8px;
}
.lightpick__month-of-the-year {
    padding: 0 10px;
    text-align: center;
    border-radius: 3px;
    box-shadow: inset -1px -1px 1px 1px #E0E0E0;
    cursor: default;
    display: flex;
    flex-direction: column;
}
.lightpick__month-of-the-year > div:first-child {
    padding: 10px 0 2px 0;
    font-size: .9em;
    pointer-events: none;
}
.lightpick__month-of-the-year > div:last-child {
    font-size: .7em;
    color: #bbb;
    padding: 2px 0 10px 0;
    pointer-events: none;
}
.lightpick__month-of-the-year:hover {
    background-color: #E0E0E0;
    background-image: none;
}
.lightpick__footer {
    display: flex;
    justify-content: space-between;
}
.lightpick__reset-action,
.lightpick__apply-action {
    border-radius: 5px;
    font-size: 12px;
    border: none;
}
.lightpick__reset-action {
    color: #fff;
    background-color: #aeacad;
}
.lightpick__apply-action {
    color: #fff;
    background-color: #2495f3;
}
</style>