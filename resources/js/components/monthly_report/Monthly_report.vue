<template>
  <div class="content">
    <UserTittle 
    tittle1="Relatório Mensal"
     tittle2="Acompanhe seu saldo de horas"
     icon="icofont-ui-calendar"  />

        <div class="card mb-2">
			<div class="input-group ">
				
					<select v-model="selectedUser" name="user" class="form-control mr-2" placeholder="Selecione o usuário...">
						<option disabled  value="">Please select one</option>
						<option v-for="user in users" v-bind:value="user.value" v-bind:key="user.value">
							{{ user.text }}
						</option>
					</select>

					<select v-model="selectedPeriod" name="period" class="form-control mr-2" placeholder="Selecione o usuário...">
						<option disabled  value="">Please select one</option>
						<option v-for="period in periods" v-bind:value="period.value" v-bind:key="period.value">
							{{ period.text }}
						</option>
					</select>
				

				<button class="btn btn-primary ml-2" @click.prevent="gethours()">
					<i class="icofont-search"></i>
				</button>
			</div>
      	</div>
    		<table class="table table-bordered table-striped table-hover">
			<thead>
				<th>Dia</th>
				<th>Entrada 1</th>
				<th>Saída 1</th>
				<th>Entrada 2</th>
				<th>Saída 2</th>
				<th>Saldo</th>
			</thead>
			<tbody>
				<tr v-for="hour in hours" :key= hour.id>
						<td  >{{hour.work_date | DateFilter(hour.work_date) }}</td>
						<td  >{{hour.time1}}</td>
						<td  >{{hour.time2}}</td>
						<td  >{{hour.time3}}</td>
						<td  >{{hour.time4}}</td>
						<td  >{{hour.balance}}</td>
				</tr>

				
				<tr class="bg-primary text-white">
					<td>Horas Trabalhadas</td>
					<td colspan="3">{{sumOfWorkTime}}</td>
					<td>Saldo Mensal</td>
					<td>{{balanceSign}}</td>
				</tr>
			</tbody>	
		</table>

  </div>
</template>

<script>
import UserTittle from '../template/UserTittle.vue'
import {baseApiUrl , showError} from '../../global'
export default {
name: 'Day_records',
components: { UserTittle },
  data: function(){
      return {
		  selectedUser: '',
		  selectedPeriod: '',
          users: [],
		  periods: [],
          information: {},
		  balanceSign: '',
		  sumOfWorkTime: '',
		  hours: []


      }
  },

    methods: {

		loadUsers(){
			const url = `${baseApiUrl}/users/index`
			axios.get(url).then(res => {

				this.users = res.data.map( user => {
					return {text: user.name , value: user.id }
				})
             //   console.log(this.users)
            })
        },
		loadHours(){

			const url = `${baseApiUrl}/monthly_report/index/hours`
			axios.get(url).then(res => {
				this.hours = res.data.data
                this.balanceSign = res.data.balanceSign 
				this.sumOfWorkTime =res.data.sumOfWorkTime
				console.log(res.data)
            })
			console.log(this.balanceSign)
        },
		gethours() {
            
            axios.post(`${baseApiUrl}/monthly_report/gethours`, { userId: this.selectedUser, periodId: this.selectedPeriod})
                .then(res => {
                    this.$toasted.global.defaultSuccess()
                 //   console.log(res.data)   
            })
            this.loadInformation()
            .catch(showError)
         //   console.log(this.forcedTime)
            this.forcedTime = '' 
           
        },

        DateSelect () {
			let algo = []
			let year = (new Date()).getFullYear()
			let inc = 0 
			for (let yearDiff = 0; yearDiff <= 2; yearDiff++) {
				let yearNew = year - yearDiff;
				for ( let month = 11 ; month >= 0 ; month--) {
					let	date2 = new  Date(yearNew,month)
				//	console.log(date2)
					algo[inc] = date2.toLocaleDateString(['pt-BR'], {month: 'long',  year: 'numeric'});
					inc = inc +1
				}

			}
			
			this.periods =	algo.map((unity, index)  => {
				return {text: unity , value: index  }
			})
			
    	}

	},
    filters: {
        DateFilter (work_date) {
            const date = new Date(work_date)
			//console.log(date)
            return date.toLocaleDateString(['pt-BR'], {month: 'long',weekday: 'long', day: '2-digit', year: 'numeric',timeZone: 'Etc/GMT'})  //if you want, you can change locale date string
            //return date.toLocaleDateString(['pt-BR'], {month: 'long', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit',timeZone: 'America/Sao_Paulo'})  //if you want, you can change locale date string
        } 
    },
	mounted() {
		this.loadHours()
        this.loadUsers()
		this.DateSelect()
		
    },
}
</script>

<style>

</style>