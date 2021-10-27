import Vue from 'vue'
import VueRouter from 'vue-router'


import Auth from './components/auth/Auth.vue'
import Day_records from './components/day_records/Day_records'
import Monthly_report from './components/monthly_report/Monthly_report'
import Manager_report from './components/manager_report/Manager_report'
import User from './components/users/User'
import Save_user from './components/save_user/Save_user'
import PageNotFound from './components/notfound/PageNotFound'


import { userKey } from './global'
Vue.use(VueRouter)

const routes =[{
    name: 'Day_records',
    path: '/',
    component: Day_records
},{
    name: 'Manager_report',
    path: '/admin/Manager_report',
    component: Manager_report  ,
 //   meta: { requiresAdmin: true }
},{
    name: 'Monthly_report',
    path: '/fuller/Monthly_report',
    component: Monthly_report  ,
    
}, {
    name: 'User',
    path: '/admin/user',
    component: User ,
//    meta: { requiresAdmin: true }
},{
    name: 'Save_user',
    path: '/admin/save/user',
    component: Save_user ,
//    meta: { requiresAdmin: true } 
}, {
    name: 'Auth',
    path: '/auth',
    component: Auth
},
{
    name: 'pageNotFound',
    path: '*',
    component: PageNotFound
}

]

const router = new VueRouter({
    mode: 'history',
    routes: routes
})

router.beforeEach((to, from, next) => {
    const json = localStorage.getItem(userKey)

    if(to.matched.some(record => record.meta.requiresAdmin)) {
        const user = JSON.parse(json)
        user && user.admin ? next() : next({ path: '/sobre' })
    } else {
        next()
    }
})

export default router