<script setup>
import { ref, onMounted } from 'vue';
import DashboardLayout from '@/layouts/DashboardLayout.vue';
import axios from 'axios';

let links = ref('')
let links_empty = ref('')

const getLinks = () => {
    axios.get('http://127.0.0.1:8000/api/links')
        .then((response) => {
            links.value = response.data
            links.value.length == 0 ? links_empty.value = true : links_empty.value = false
            linkDetails(links.value[0].id)
            console.log(response)
        })
}

let title = ref('')
let created_at = ref('')
let user = ref('')

let back_half = ref('')
let destination = ref('')
let loading = ref(false)

const linkDetails = (id) => {
    axios.get('http://127.0.0.1:8000/api/links/' + id)
        .then((response) => {
            title.value = response.data.link.title
            created_at.value = response.data.link.created_at
            user.value = links.value[0].user.name
            back_half.value = response.data.link.back_half
            destination.value = response.data.link.destination
            loading.value = true
            //console.log(response.data.link)
        })
}

onMounted(getLinks)
</script>

<template>
    <DashboardLayout>
        <div class="border-gray-200 dark:border-gray-700">
            <!--<div class="grid grid-cols-3 gap-4 mb-4">
                <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                </div>
                <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                </div>
                <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                </div>
            </div>
            -->

            <div class="ml-3 mb-3 mt-14">
                <p class="text-3xl font-bold">Links</p>

                <button type="button"
                    class="px-5 py-2 mt-4 mb-2 mr-2 text-sm font-medium text-white bg-blue-700 rounded-sm hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Filters</button>
            </div>

            <div v-if="links_empty" class="h-48 pl-3 mt-8 mb-4 rounded">
                <router-link to="/create"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-16 py-2.5 mt-10 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Create your first link
                </router-link>
            </div>

            <div v-else class="grid grid-cols-3 gap-4 mb-4 h-screen bg-gray-100 border-t border-gray-200">
                <div class="pt-4 rounded h-24">
                    <div class="mb-3 pl-10 py-3 bg-white cursor-pointer" v-for="link in links" :key="link.id"
                        @click="linkDetails(link.id)">
                        <p>{{ link.created_at }}</p>
                        <p>{{ link.title }}</p>
                        <p class="my-2 text-sm text-orange-400">127.0.0.1:8000/<span class="text-orange-500 font-semibold">
                                {{ link.back_half }}
                            </span>
                        </p>
                    </div>
                </div>

                <div v-if="loading" class="col-span-2 border-l border-gray-200">
                    <div class="flex justify-between my-8 rounded bg-white px-8 pt-4 pb-8 ml-2 mr-8">
                        <div>
                            <p class="font-bold text-3xl">{{ title }}</p>
                            <div class="flex justify-start">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mt-5 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                    </svg>
                                </span>
                                <p class="pt-4">
                                    {{ created_at }} by {{ user }}
                                </p>
                            </div>
                        </div>

                        <div
                            class="flex justify-start bg-gray-200 h-11 cursor-pointer px-3 rounded hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5 mt-2.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                            </svg>

                            <p class="pl-2 mt-2.5 mb-2 mr-2 text-sm font-medium text-black">Edit</p>
                        </div>
                    </div>

                    <div class="my-5 rounded bg-white px-8 pt-4 pb-8 ml-2 mr-8">
                        <div class="flex justify-between">
                            <div>
                                <div class="my-4 text-xl font-bold">
                                    <a :href="'http://127.0.0.1:8000/' + back_half"
                                        class="my-4 text-xl font-bold text-blue-700">127.0.0.1:8000/{{ back_half }}</a>
                                </div>
                                <div class="flex justify-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 4.5l15 15m0 0V8.25m0 11.25H8.25" />
                                    </svg>

                                    <a :href="destination" class="mx-2">{{ destination }}</a>

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                    </svg>

                                    <p class="ml-1 text-gray-400">Redirect</p>
                                </div>
                            </div>

                            <div
                                class="flex justify-start bg-gray-200 mt-4 h-11 cursor-pointer px-3 rounded hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-5 h-5 mt-2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 8.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v8.25A2.25 2.25 0 006 16.5h2.25m8.25-8.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-7.5A2.25 2.25 0 018.25 18v-1.5m8.25-8.25h-6a2.25 2.25 0 00-2.25 2.25v6" />
                                </svg>


                                <p class="pl-2 mt-2.5 mb-2 mr-2 text-sm font-medium text-black">Copy</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mt-8">
                            <div>
                                <p class="font-bold text-xl">QR Code</p>

                                <div class="flex justify-start mt-3">
                                    <div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="#d3d5db" class="w-24 h-24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z" />
                                            </svg>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="button"
                                            class="px-2 py-2 mb-2 ml-4 text-sm font-medium text-black bg-white border border-gray-500 rounded-lg hover:bg-gray-200">Create
                                            QR Code</button>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <p class="font-bold text-xl">Link-in-bio</p>

                                <div class="flex justify-start mt-3">
                                    <div>
                                        <div
                                            class="focus:outline-none text-gray-400 bg-gray-200 focus:ring-4 font-2xl rounded-full text-sm px-9 py-8 mr-2 mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-8 h-9">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="button"
                                            class="px-2 py-2 mb-2 ml-4 text-sm font-medium text-black bg-white border border-gray-500 rounded-lg hover:bg-gray-200">Create
                                            a Link-in-bio</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                            </svg>

                            <p class="text-gray-500 ml-2">No Tags</p>
                        </div>
                    </div>
                </div>
            </div>

            <!--<div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                </div>
                <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                </div>
                <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                </div>
                <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                </div>
            </div>
            <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                </div>
                <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                </div>
                <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                </div>
                <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                </div>
            </div>-->
    </div>
</DashboardLayout></template>