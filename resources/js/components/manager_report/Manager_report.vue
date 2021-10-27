<template>
  <div class="content">
    <UserTittle tittle1="Relatório Gerencial"
     tittle2="Resumo das horas trabalhadas dos funcionários"
     icon="icofont-chart-histogram"  />

    <div class="summary-boxes">
        <div class="summary-box bg-primary">
            <i class="icon icofont-users"></i>
            <p class="title">Qtde de Funcionários</p>
            <h3 class="value">{{information.total}}</h3>
        </div>
        <div class="summary-box bg-danger">
            <i class="icon icofont-patient-bed"></i>
            <p class="title">Faltas</p>
            <h3 class="value"></h3>
        </div>
        <div class="summary-box bg-success">
            <i class="icon icofont-sand-clock"></i>
            <p class="title">Horas no Mês</p>
            <h3 class="value"></h3>
        </div>
    </div>

        
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="card-title">Faltosos do Dia</h4>
                <p class="card-category mb-0">Relação dos funcionários que ainda não bateram o ponto</p>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <th>Nome</th>
                    </thead>
                    <tbody>
                        
                            <tr v-for="user in users" :key= user.id>
                                <td  >{{user.name}}</td>
                            </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    

  </div>
</template>

<script>
import axios from 'axios'
import {baseApiUrl , showError} from '../../global'
import UserTittle from '../template/UserTittle.vue'
export default {
name: 'Manager_report',
components: { UserTittle },
  data: function(){
      return {
          page: 1,
          limit: 0,
          count: 0,
          users: [],
          information: {},

      }
  },
    methods: {
        loadUsers(){
            const url = `${baseApiUrl}/manager_report/index`
            axios.get(url).then(res => {
              console.log(res.data.data.data)
                this.users = res.data.data.data
                this.information = res.data.data
                
            })
        },
    },

    mounted() { 
        this.loadUsers()
    }

}
</script>

<style>
.summary-boxes {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
}
.summary-box {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    color: #fff;
    padding: 10px;
    border-radius: 10px;
    margin: 10px;
    min-width: 200px;
}

.summary-box .icon {
    font-size: 3.5rem;
}

.summary-box .title {
    font-size: 1.5rem;
}

.summary-box .value {
    font-size: 2rem;
}
</style>