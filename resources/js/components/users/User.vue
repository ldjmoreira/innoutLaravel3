<template>
  <div class="content">
    <UserTittle tittle1="Cadastro de Usuários"
     tittle2="Mantenha os dados dos usuários atualizados"
     icon="icofont-users"  />

        <router-link class="btn btn-lg btn-primary mb-3" to="/admin/save/user" > 
          Novo Usuário
        </router-link>


    <table class="table table-bordered table-striped table-hover">
        <thead>
            <th>Nome</th>
            <th>Email</th>
            <th>Data de Admissão</th>
            <th>Data de Desligamento</th>
            <th>Ações</th>
        </thead>
        <tbody>
            
                <tr v-for="user in users" :key= user.id>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.created_at}}</td>
                    <td>{{user.end_date}}</td>
                    <td>
                <button class="btn btn-warning rounded-circle mr-2" @click="edit(user.id)" > 
                <i class="icofont-edit"></i>
                </button>

                <button class="btn btn-danger rounded-circle mr-2" @click="remove(user.id)" > 
                <i class="icofont-trash"></i>
                </button>
                    </td>
                </tr>
            
        </tbody>
    </table>



  </div>
</template>

<script>
import axios from 'axios'
import {baseApiUrl , showError} from '../../global'
import UserTittle from '../template/UserTittle.vue'
export default {
name: 'User',
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
            const url = `${baseApiUrl}/users/index`
            axios.get(url).then(res => {
              console.log(res.data)
                this.users = res.data
                
            })
        },
         remove(userId) {
            const id = userId
            axios.delete(`${baseApiUrl}/admin/save/user/delete/${id}`)
                .then(() => {
                    this.$toasted.global.defaultSuccess()
                    this.reset()
                })
                .catch(showError)
        },
        edit(userId){
          //  this.$router.push({ path: `/admin/save/user/${userId}` }) 
            this.$router.push({ path: '/admin/save/user', query: { id: userId } })
        },
        reset() {

            this.users = {}
            this.loadUsers()
        },
    },

    mounted() { 
        this.loadUsers()
    }
}
</script>

<style>

</style>