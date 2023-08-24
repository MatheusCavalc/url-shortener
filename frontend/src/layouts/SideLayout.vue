<script setup>
import { ref } from 'vue';
import { collapsed, toggleSidebar, sidebarWidth } from '../components/sidebar/state';
import UserDropdown from '@/components/UserDropdown.vue';

const classLinkSelected = 'flex items-center p-2 text-blue-900 border border-blue-900 rounded-lg dark:text-white bg-gray-200 dark:hover:bg-gray-700'
const classLinkUnselectd = 'flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'

const classLinkSelectedCol = 'text-blue-900 border border-blue-900 bg-gray-200 font-medium rounded-lg text-sm w-full px-4 py-2 text-center'
const classLinkUnselectdCol = 'text-blue-900 font-medium rounded-lg text-sm w-full px-4 py-2 text-center hover:bg-gray-100'

const open1 = ref(false)
</script>

<template>
    <div :class="{ 'overflow-hidden': open1, '': !open1 }">
        <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start">
                        <button @click="open1 = !open1" data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                            aria-controls="logo-sidebar" type="button"
                            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                                </path>
                            </svg>
                        </button>
                        <router-link to="/" class="flex ml-2 md:mr-24">
                            <span
                                class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">URL Shortener</span>
                        </router-link>
                    </div>
                    <div class="flex items-center">
                        <div class="flex items-center ml-3">
                            <UserDropdown />
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <aside :style="{ width: sidebarWidth }" id="logo-sidebar"
            :class="{ 'transform-none': open1, '-translate-x-full': !open1 }"
            class="sidebar fixed top-0 left-0 z-40 w-64 h-screen pt-10 transition-transform bg-white border-r border-gray-200 sm:translate-x-0"
            aria-label="Sidebar">

            <div v-if="collapsed">
                <div class="px-3 pb-4">
                    <router-link to="/create">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full mt-10 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                    </router-link>
                </div>

                <div class="h-full px-3 py-4 overflow-y-auto dark:bg-gray-800">
                    <ul class="space-y-2 font-medium">
                        <li>
                            <router-link to="/dashboard">
                                <div :class="$route.name === 'dashboard' ? classLinkSelectedCol : classLinkUnselectdCol">
                                    <svg aria-hidden="true"
                                        class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                                    </svg>
                                </div>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/links">
                                <div :class="$route.name === 'links' ? classLinkSelectedCol : classLinkUnselectdCol">
                                    <svg aria-hidden="true"
                                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                        </path>
                                    </svg>
                                </div>
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>

            <div v-else class="overflow-hidden">
                <div class="px-3 pb-4">
                    <router-link to="/create">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full mt-10 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            New
                        </button>
                    </router-link>
                </div>

                <div class="h-full px-3 py-4 overflow-y-auto dark:bg-gray-800">
                    <ul class="space-y-2 font-medium">
                        <li>
                            <router-link to="/dashboard">
                                <div :class="$route.name === 'dashboard' ? classLinkSelected : classLinkUnselectd">
                                    <svg aria-hidden="true"
                                        class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                                    </svg>
                                    <span class="ml-3">Dashboard</span>
                                </div>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/links">
                                <div :class="$route.name === 'links' ? classLinkSelected : classLinkUnselectd">
                                    <svg aria-hidden="true"
                                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                        </path>
                                    </svg>
                                    <span class="flex-1 ml-3 whitespace-nowrap">Links</span>
                                </div>
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="hidden md:block fixed bottom-2 left-7">
                <button @click="toggleSidebar" type="button" :class="{ 'rotation-180': collapsed }"
                    class="collapse-icon border font-2xl rounded-full text-sm px-2 py-2 mr-2 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
                    </svg>
                </button>
            </div>
        </aside>
        <div v-show="open1" @click="open1 = false" class="bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-30"></div>
    </div>

    <div class="div-content">
        <div class="" :class="{ 'sm:ml-64': !collapsed, 'sm:ml-20': collapsed }">
            <div class="dark:border-gray-700 mt-14">
                <!-- Page Content -->
                <main class="w-full py-4">
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>

<style scoped>
.div-content {
    transition: 0.3s ease;
}

.sidebar {
    transition: 0.3s ease;
}

.collapse-icon {
    transition: 0.2s linear;
}

.rotation-180 {
    transform: rotate(180deg);
    transition: 0.2s linear;
}
</style>