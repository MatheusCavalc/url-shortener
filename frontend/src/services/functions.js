import axios from 'axios'
import router from '@/router'
import setAuthHeader from "@/services/setAuthHeader.js"

let url = 'http://127.0.0.1:8000/api/'

export function register(parameters) {
    event.preventDefault()
    axios.post(url + 'auth/register', parameters).then((response) => {
        window.location.replace('/login');
    }).catch(error => {
        console.log(error)
    });
}

export function login(parameters) {
    event.preventDefault()
    axios.post(url + 'auth/login', parameters).then((response) => {
        localStorage.setItem('bearerToken', response.data.data.token)
        localStorage.setItem('userName', response.data.data.user_name)
        //localStorage.setItem('userEmail', response.data.data.user_email)
        setAuthHeader(response.data.data.token)
        window.location.replace('/');
    }).catch(error => {
        console.log(error)
    });
}

export function logout() {
    event.preventDefault()
    axios.post(url + 'auth/logout').then((response) => {
        localStorage.removeItem('bearerToken');
        window.location.replace('/');
    }).catch(error => {
        console.log(error)
    });
}

export function create_link(parameters) {
    event.preventDefault()
    axios.post(url + 'links', parameters).then((response) => {
        if (response.data[0].status == 'success') {
            router.push('/links')
        }
    }).catch(error => {
        console.log(error)
    });
}

export function edit_link(id, parameters) {
    event.preventDefault()
    axios.put(url + 'links/' + id, parameters).then((response) => {
        if (response.data[0].status == 'success') {
            router.push('/links')
        }
    }).catch(error => {
        console.log(error)
    });
}