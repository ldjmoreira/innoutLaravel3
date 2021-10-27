<template>
  <div class="content">
    <UserTittle tittle1="Cadastro de Usuário"
     tittle2="Crie e atualize o usuário"
     icon="icofont-user"  />

    <div class="form-login2">
            <div class="form-row">

        
                <input class="form-control" v-model="user.id" name="email" type="hidden" placeholder="E-mail">
                
                <div class="form-group col-md-6">

                    <label for="name">Nome</label>
                    <input class="form-control" v-model="user.name" name="name" type="text" placeholder="nome">
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="email">E-mail</label>
                    <input class="form-control" v-model="user.email" name="email" type="text" placeholder="E-mail">
                    <div class="invalid-feedback">
                    </div>
                </div>
            </div>        
              <div class="form-row">

                <div class="form-group col-md-6">
                    <label for="password">Senha</label>
                    <input class="form-control" v-model="user.password" name="password" type="password" placeholder="Informe a senha">
                    <div class="invalid-feedback">
                        
                    </div>
                </div>
                    <div class="form-group col-md-6">
                    <label for="password">Confirmação de senha</label>
                    <input class="form-control" v-model="user.password_confirmation" name="password" type="password" placeholder="Informe a senha">
                    <div class="invalid-feedback">
                        
                    </div>
                    </div>

              </div>
              <div class="form-row">

                    <div class="form-group col-md-6">
                    <label for="start_date">Data de Admissão</label>
                    <input class="form-control" v-model="user.created_at" name="password" type="date" >
                    <div class="invalid-feedback">
                        
                    </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="end_date">Data de desligamento</label>
                        <input class="form-control" v-model="user.end_date" name="password" type="date" >
                        <div class="invalid-feedback">
                        
                        </div>
                    </div>

              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="is_admin">Administrador?</label>
                    <input class="form-control" 
                    v-model="user.is_admin" name="password" type="checkbox" >
                </div>
              </div>
            <div>
                <button v-if="isEdit" class="btn btn-primary btn-lg" @click="update">Editar</button>
                <button v-else class="btn btn-primary btn-lg" @click="save">Salvar</button>

                <router-link class="btn btn-secondary btn-lg" to="/admin/user">
                    Cancelar
                </router-link>

            </div>

    </div>




  </div>
</template>

<script>
import { baseApiUrl, showError, userKey } from '../../global'
import UserTittle from '../template/UserTittle.vue'
export default {
name: 'Save_user',
    data: function() {
        return {
            showSignup: false,
            user: {
                is_admin: 0
            },
            queryId: 0,
            isEdit: false
        }
    },
components: { UserTittle },
    methods: {
        signin() {
            axios.post(`${baseApiUrl}/auth/login`, this.user)
                .then(res => {
                    this.$store.commit('setUser', res.data)
                    localStorage.setItem(userKey, JSON.stringify(res.data))
                    this.$router.push({ path: '/' })
                })
                .catch(showError)
        },
        save() {
            const method =  'post'
            console.log(this.user)
            axios[method](`${baseApiUrl}/auth/register`, this.user)
                .then(() => {
                    this.$toasted.global.defaultSuccess()
                   this.$router.push({ path: '/admin/user' })
                })
                .catch(showError)
        },
        update() {
            const method =  'put'
            const id = this.queryId ? `${this.queryId}` : ''
            axios[method](`${baseApiUrl}/admin/save/user/update/${id}`, this.user)
                .then(() => {
                    this.$toasted.global.defaultSuccess()
                    this.$router.push({ path: '/admin/user' })
                })
                .catch(showError)
        },
        loadCategories(queryId) {
            
        
            const url = `${baseApiUrl}/admin/save/user/edit/${queryId}`
            axios.get(url)
                .then(res => {
                this.user = {
                    id: res.data.id,
                    name: res.data.name,
                    email: res.data.email,
                    created_at: res.data.created_at.slice(0, 10) ,
                    end_date: res.data.end_date,
                    is_admin: res.data.is_admin
                    } 

                })    
                .catch(showError)
        }
    },
        mounted() {
         this.queryId = this.$route.query.id
         if(this.queryId) {
          //  this.isEdit = true;
            this.loadCategories(this.queryId)
         }
          
    },
        created() {
         this.queryId = this.$route.query.id
         if(this.queryId) {
            this.isEdit = true;
         }
          
    },

}
</script>

<style>

</style>