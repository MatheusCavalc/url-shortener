<script setup>
import { logout } from '@/services/functions';
import { onMounted, ref } from 'vue';
import axios from 'axios';

const user = ref('')
const email = ref('')

const infos = () => {
    axios.get('http://127.0.0.1:8000/api/auth/user-infos').then((response) => {
        user.value = response.data.user
        email.value = response.data.email
    }).catch(error => {
        console.log(error)
    });
}

const open = ref(false)

onMounted(infos)
</script>

<template>
    <div>
        <button type="button" @click="open = !open" class="flex text-sm" aria-expanded="false"
            data-dropdown-toggle="dropdown-user">
            <div class="flex">
                <p class="whitespace-nowrap overflow-hidden">{{ user }}</p>
                <span class="mt-2 ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-2 h-2 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </span>
            </div>
        </button>
    </div>
    <Transition>
        <div v-show="open" class="absolute z-10 mt-3 mr-2 top-11 right-1 font-normal bg-white rounded-lg shadow"
            id="dropdown-user">
            <div class="px-4 py-3" role="none">
                <p class="text-sm text-gray-900 dark:text-white" role="none">
                    {{ user }}
                </p>
                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                    {{ email }}
                </p>
            </div>
            <ul class="py-1" role="none">
                <li>
                    <button @click="logout" :class="[
                        active ? 'bg-gray-100' : 'text-gray-900',
                        'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                    ]">
                        <DeleteIcon :active="active" class="mr-2 h-5 w-5 text-violet-400" aria-hidden="true" />
                        Sign out
                    </button>
                </li>
            </ul>
        </div>
    </Transition>
</template>

<style scoped>
/* we will explain what these classes do next! */
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
  