<template>
	<div class="booking container" >
		<h2>Booking</h2>
	  	<form @submit.prevent="sentRequest">
	  		<div class="field title">
	  			<label for="title">Chapeters Count</label>
	  			<input type="number"  v-model="count">
	  		</div>
            <div class="field">
                <label>
                    <input type="checkbox" @change="addDay('sunday')"/>
                    <span>Sunday</span>
                </label>
                <label>
                    <input type="checkbox" @change="addDay('monday')" />
                    <span>Monday</span>
                </label>
                <label>
                    <input type="checkbox" @change="addDay('tuesday')" />
                    <span>Tuesday</span>
                </label>
                <label>
                    <input type="checkbox" @change="addDay('wednesday')" />
                    <span>Wednesday</span>
                </label>
                <label>
                    <input type="checkbox" @change="addDay('thursday')" />
                    <span>Thursday</span>
                </label>
                <label>
                    <input type="checkbox" @change="addDay('friday')" />
                    <span>Friday</span>
                </label>
                <label>
                    <input type="checkbox" @change="addDay('saturday')" />
                    <span>Saturday</span>
                </label>
            </div>
            <div class="field">
	  			<label for="title">Pick a Date</label>
                <date-pick v-model="date"></date-pick>
            </div>
            <div class="field">
	  			<label for="title">Chapeter Cost</label>
	  			<input type="number"  v-model="cost">
            </div>
	  		<div class="field center-align">
	  			<button class="btn success">Sent</button>
	  		</div>
	  	</form>
	</div>
</template>
<script>
import DatePick from 'vue-date-pick';
import 'vue-date-pick/dist/vueDatePick.css';
export default {
    name: 'Booking',
    components: {DatePick},
    data(){
        return{
            count:null,
            cost:null,
            date: null,
            days:[],
        }
    },
    methods:{
        addDay(selectedDay){
            if( !this.days.includes(selectedDay) ){
                this.days.push(selectedDay)
            }
        },
        sentRequest(){
            axios.post('/api/books', {
                chapters_count: this.count,
                chapter_days_cost: this.cost,
                reading_start_date: this.date,
                available_reading_days: this.days,
            })
        }
    }
}
</script>
<style>
.booking{
	margin-top:60px;
	padding:20px;
	max-width:500px;
}
.booking h2{
	font-size:2em;
	margin: 20px auto;
}
.booking .field{
	margin: 20px auto;
  position: relative;
    display: grid;
}
.booking .delete{
    position: absolute;
    right: 0;
    bottom: 16px;
    color: #aaa;
    cursor: pointer;
}
</style>
