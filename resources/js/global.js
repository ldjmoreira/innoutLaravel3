import Vue from 'vue'
export const userKey = '__lorioninnoutlaravel4'
export const baseApiUrl = 'http://localhost:8000/api'

export function showError(e) {
    console.log(e.response)
    if(e && e.response && e.response.data) {
        Vue.toasted.global.defaultError({ msg : e.response.data })
        
    } else if(typeof e === 'string') {
        Vue.toasted.global.defaultError({ msg : e })
        
    } else {
        Vue.toasted.global.defaultError()
        
    }
}

export default { baseApiUrl, showError , userKey }