<script setup>
import SideLayout from '@/layouts/SideLayout.vue';
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import { edit_link } from '@/services/functions'
import LoadingSpinner from '@/components/LoadingSpinner.vue';
let loading = ref(false)


const route = useRoute()

let id = route.params.id
let destination = ref('')
let title = ref('')
let back_half = ref('')

const getLink = () => {
    axios.get('http://127.0.0.1:8000/api/links/' + id)
        .then((response) => {
            destination.value = response.data.link.destination
            title.value = response.data.link.title
            back_half.value = response.data.link.back_half
            loading.value = true
        })
}

const submit = () => {
    event.preventDefault()
    let parameters = {
        destination: destination.value,
        title: title.value,
        back_half: back_half.value,
    }

    edit_link(id, parameters)
}

onMounted(getLink)
</script>

<template>
    <SideLayout>
        <div v-if="!loading">
            <LoadingSpinner />
        </div>

        <div v-else>
            <div class="mt-16 mx-5 md:mx-32">
                <p class="text-3xl font-bold">Edit Link</p>

                <div class="mt-5">
                    <form v-on:submit="submit">
                        <div class="mb-6">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destination</label>
                            <input type="text" id="email" v-model="destination"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="https://example.com/my-long-url" required>
                        </div>
                        <div class="mb-6">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title
                                (optional)</label>
                            <input type="text" id="password" v-model="title"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>

                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="first_name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Domain</label>
                                <input type="text" id="first_name" disabled
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="127.0.0.1:8000">
                            </div>
                            <div>
                                <label for="last_name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Custom back-half
                                    (optional)</label>
                                <input type="text" id="last_name" v-model="back_half"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                        </div>

                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</button>
                    </form>
                </div>

            </div>
        </div>
    </SideLayout>
</template>