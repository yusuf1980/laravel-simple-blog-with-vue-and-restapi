import './bootstrap';
import { createApp } from 'vue';
import { createStore } from 'vuex'
import App from './App.vue';
import router from './router';
import StoreData from './store';
import CKEditor from '@ckeditor/ckeditor5-vue';

const store = createStore(StoreData)
const app = createApp(App)
    .use(router)
    .use(store)
    .use( CKEditor );

    router.beforeEach((to, from, next) => {
 
        if (to.matched.some(record => record.meta.requiresAuth)) {
            let loggedIn = store.getters.loggedIn
            if(!loggedIn) {
                next({ name: 'login' })
            } 
            else {
                next()
            }
        } 
        else if (to.matched.some(record => record.meta.requiresVisitor)) {
            let loggedIn = store.getters.loggedIn
            if(loggedIn) {
                next({ name: 'dashboard' })
            } else {
                next()
            }
        } 
        else {
            next()
        }
    })

app.mount('#app');
