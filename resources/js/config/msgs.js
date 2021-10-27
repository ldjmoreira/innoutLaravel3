import Vue from 'vue'
import Toasted from 'vue-toasted'

Vue.use(Toasted, {
    iconPack: 'fontawesome',
    duration: 5000
})

Vue.toasted.register(
    'defaultSuccess',
    payload => !payload.msg ? 'Operação realizada com sucesso':payload.msg,
    {Type: 'success', icon: 'check'}

)

Vue.toasted.register(
    'defaultError',
    payload => !payload.msg ? 'Erro inesperado':payload.msg,
    {Type: 'error', icon: 'times'}

)