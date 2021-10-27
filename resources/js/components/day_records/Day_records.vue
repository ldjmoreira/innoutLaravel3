<template>
  <div class="content">
    <UserTittle tittle1="Registrar Ponto"
     tittle2="Mantenha seu ponto consistente!"
     icon="icofont-check-alt"  />

      <div class="card">
        <div class="card-header">
            <h3>{{ 0 | DateFilter }}</h3>
            <p class="mb-0">Os batimentos efetuados hoje</p>
        </div>
        <div class="card-body">
            <div class="d-flex m-5 justify-content-around">
                <span class="record">Entrada 1: {{information.time1}}</span>
                <span class="record">Saída 1: {{information.time2}}</span>
            </div>
            <div class="d-flex m-5 justify-content-around">
                <span class="record">Entrada 2: {{information.time3}}</span>
                <span class="record">Saída 2: {{information.time4}}</span>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-center">
            <button  class="btn btn-success btn-lg"  @click.prevent="innout">
                <i class="icofont-check mr-1"></i>
                Bater o Ponto
            </button>
        </div>
      </div>
      <form class="mt-5" action="innout.php" method="post">
          <div class="input-group no-border">
              <input v-model="forcedTime" type="text" name="forcedTime" class="form-control"
                  placeholder="Informe a hora para simular o batimento">
              <button class="btn btn-danger ml-3"  @click.prevent="innout2()">
                  Simular Ponto
              </button>
          </div>
      </form>

  </div>
</template>

<script>
import UserTittle from '../template/UserTittle.vue'
import {baseApiUrl , showError} from '../../global'
//import DateFilter from './date' // Import date
export default {
    name: 'Day_records',
        data: function() {
        return {
            mode: 'save',
            forcedTime: '',
            categories: [],
            information: { }// ver o que faz quando nao vier nada
        }
    },
    components: { UserTittle },
    methods: {
        loadInformation() {
            const url = `${baseApiUrl}/days_records/index`
            axios.get(url).then(res => {
                this.information = res.data.data[0] //poderia ser map
                console.log(this.information)
            })
            
        },
        innout() {
            const url = `${baseApiUrl}/days_records/innout`
            axios.get(url).then(res => {
            this.$toasted.global.defaultSuccess()

            })
            .catch(showError)
            this.loadInformation()
        },
        innout2() {
            
            axios.post(`${baseApiUrl}/days_records/innout2`, { forcedTime: this.forcedTime})
                .then(res => {
                    this.$toasted.global.defaultSuccess()
                 //   console.log(res.data)   
            })
            this.loadInformation()
            .catch(showError)
            console.log(this.forcedTime)
            this.forcedTime = '' 
           
        },
    },

    filters: {
        DateFilter () {
            const date = new Date()
            return date.toLocaleDateString(['pt-BR'], {month: 'long', day: '2-digit', year: 'numeric'})  //if you want, you can change locale date string
            //return date.toLocaleDateString(['pt-BR'], {month: 'long', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit'})  //if you want, you can change locale date string
        } 
    },
    mounted() {
        this.loadInformation()
    },
}


</script>

<style>
.record {
    font-size: 2.2rem;
}
</style>