<template>
    <div class="form-login2">
       <div class="login-card card">
            <div class="card-header">
                <i class="icofont-travelling mr-2"></i>
                <span class="font-weight-light">In </span>
                <span class="font-weight-bold mx-2">N'</span>
                <span class="font-weight-light">Out</span>
                <i class="icofont-runner-alt-1 ml-2"></i>
            </div>
            <div class="card-body">
                
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input class="form-control" v-model="user.email" name="email" type="text" placeholder="E-mail">
                    <div class="invalid-feedback">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input class="form-control" v-model="user.password" name="password" type="password" placeholder="Informe a senha">
                    <div class="invalid-feedback">
                        
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-lg btn-primary"  @click="signin">Entrar</button>
                
            </div>
        </div>
    </div>
  
</template>

<script>
import { baseApiUrl, showError, userKey } from '../../global'


export default {
    name: 'Auth',
    data: function() {
        return {
            showSignup: false,
            user: {}
        }
    },
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
        signup() {
            axios.post(`${baseApiUrl}/api/auth/register`, this.user)
                .then(() => {
                    this.$toasted.global.defaultSuccess()
                    this.user = {}
                    this.showSignup = false
                })
                .catch(showError)
        }
    }
}
</script>

<style >

.form-login2 {
    flex-basis: 450px;
}

.login-card .card-header {
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.8rem;
}

.login-card .card-footer {
    display: flex;
    justify-content: flex-end;
}
</style>