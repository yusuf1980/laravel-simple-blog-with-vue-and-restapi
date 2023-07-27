import axios from 'axios';
import $axios from './axios.js'
import { reject } from 'lodash';

const state = {
    token: localStorage.getItem('uuidpandaisuite') || null,
    loading: false,
    postData: {
        posts: [],
        page: 1,
        last_page: 0 
    },
    post: {},
    comments: [],
}
const getters = {
    loggedIn(state) {
        return state.token !== null
    },
    getLoading(state) {
        return state.loading
    },
    getPostsData(state) {
        return state.postData;
    },
    getPost(state) {
        return state.post;
    },
    getComments(state) {
        return state.comments;
    },
    setToken(state, token) {
        state.token = token
    },
    setErrors(state, errors) {
        state.errors = payload
    },
}
const mutations = {
    setPosts(state, payload) {
        state.postData.posts = payload.data
        state.postData.page = payload.current_page
        state.postData.last_page = payload.last_page
    },
    setPost(state, payload) {
        state.post = payload
    },
    setComments(state, payload) {
        state.comments = payload
    },
    setToken(state, token) {
        state.token = token
    },
    destroyToken(state) {
        state.token = null
        localStorage.removeItem('uuidpandaisuite')
        // localStorage.removeItem('profile')
    },
    setLike(state, payload) {
        console.log(state.post)
        if(payload === 1) {
            state.post.like_true_count += 1;
        }
        else state.post.dislike_count += 1;
    }
}
const actions = {
    login({commit}, credentials) {
        return new Promise((resolve, reject) => {
            axios.post('api/login', {
                username: credentials.username,
                password: credentials.password
            })
            .then(response => {
                const token = response.data.token.access_token
                commit('setToken', token)
                localStorage.setItem('uuidpandaisuite', token)
                
                resolve(response.data)
            })
            .catch(error => {
                console.log(error.response.data)
                reject(error)
            })
        })
    },
    getPosts({commit, state}, payload) {
        state.loading = true
        let url ='/api/posts?page='+payload.page;
        
        return new Promise((resolve, reject) => {
            axios.get(url, {params: payload})
            .then((res) => {
                commit('setPosts', res.data)
                resolve(res.data)
                state.loading = false
            })
            .catch((error)=>{
                state.loading = false
                reject(error.response)
            })
        })
    },
    getPost({commit, state, dispatch}, payload) {
        state.loading = true
        let url = '/api/posts/'+payload;
        return new Promise((resolve, reject) => {
            axios.get(url)
            .then((res) => {
                commit('setPost', res.data)
                resolve(res.data)
                state.loading = false
            })
            .catch((error)=>{
                console.log(error)
                reject(error)
                state.loading = false
            })
        })
    },
    getComments({commit}, payload) {
        let url = '/api/posts/comments/'+payload.id;
        return new Promise((resolve, reject) => {
            axios.get(url)
            .then((res) => {
                // console.log('res ', res.data)
                commit('setComments', res.data)
                resolve(res.data)
            })
            .catch((error)=>{
                console.log(error)
                reject(error)
            })
        })
    },
    destroyToken({commit, state}) {
        return new Promise((resolve, reject) => {
            console.log('logout')
            // localStorage.removeItem('uuidkomodi')
            $axios.post('/logout')
            .then((response) => {		
                // console.log(response.data)	
                // localStorage.removeItem('uuidkomodi')			
                commit('destroyToken')
                resolve(response)
            })
            .catch(error => {
                console.log(error.response.data)
                reject(error.response)
            })
        })
    },
    getDashboard({commit, state}) {
        return new Promise((resolve, reject) => {
            $axios.get('/admin/dashboard')
            .then(res => {
                // console.log(res.data)
                resolve(res.data)
            })
            .catch(error=>{
                console.log(error.response.data)
                reject(error)
            })
        })
    },
    getAdminPosts({commit, state}, payload) {
        state.loading = true
        let url ='/admin/posts?page='+payload.page;
        
        return new Promise((resolve, reject) => {
            $axios.get(url, {params: payload})
            .then((res) => {
                // commit('setPosts', res.data)
                resolve(res.data)
                state.loading = false
            })
            .catch((error)=>{
                state.loading = false
                reject(error.response)
            })
        })
    },
    refreshToken({commit, dispatch}) {
        return new Promise((resolve, reject) => {
          $axios.post('/refresh')
            .then(response => {
                const token = response.data.token.access_token
                const exp = response.data.token.expires_in
                localStorage.setItem('uuidkomodi', token)
                // dispatch('autoRefresh', token)
                commit('setToken', token)
              resolve(response);
            })
            .catch(error => {
              reject(error.response);
            });
        });
      },
}

export default {
	namespaced: true,
	state,
    getters,
	mutations,
	actions
}