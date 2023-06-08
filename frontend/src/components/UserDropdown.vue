<script setup>
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
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

onMounted(infos)
</script>

<template>
    <div class="">
        <Menu as="div" class="relative inline-block text-left">
            <div>
                <MenuButton
                    class="font-medium rounded-lg text-sm px-4 py-2 mb-2">
                    <div class="flex">
                        <p class="whitespace-nowrap overflow-hidden">{{ user }}</p>
                        <span class="mt-2 ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-2 h-2 text-black">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </span>
                    </div>
                </MenuButton>
            </div>

            <transition enter-active-class="transition duration-100 ease-out"
                enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
                leave-active-class="transition duration-75 ease-in" leave-from-class="transform scale-100 opacity-100"
                leave-to-class="transform scale-95 opacity-0">
                <MenuItems
                    class="absolute right-0 mt-2 w-80 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">

                    <div class="px-1 py-1">
                        <div class="ml-9 my-2">
                            <p class="my-2">{{ user }}</p>
                            <p class="my-2">{{ email }}</p>
                        </div>
                    </div>

                    <div class="px-1 py-1">
                        <MenuItem v-slot="{ active }">
                        <button @click="logout" :class="[
                            active ? 'bg-gray-100' : 'text-gray-900',
                            'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                        ]">
                            <DeleteIcon :active="active" class="mr-2 h-5 w-5 text-violet-400" aria-hidden="true" />
                            Sign out
                        </button>
                        </MenuItem>
                    </div>
                </MenuItems>
            </transition>
        </Menu>
    </div>
</template>
  