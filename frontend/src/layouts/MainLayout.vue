<script setup>

</script>

<template>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
            <router-link to="/" class="flex items-center">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">URL Shortener</span>
            </router-link>
            <div class="flex items-center">
                <router-link to="/login"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 md:font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-3 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Log
                    in
                </router-link>
                <router-link to="/register"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 md:font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign
                    up Free
                </router-link>
            </div>
        </div>
    </nav>
    <nav class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200">
        <div class="max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex items-center">
                <ul class="flex flex-row font-medium mt-0 mr-6 space-x-8 text-sm">
                    <li>
                        <router-link to="/" class="text-gray-900 dark:text-white hover:underline"
                            aria-current="page">Home</router-link>
                    </li>
                    <li>
                        <a href="#" class="text-gray-900 dark:text-white hover:underline">About</a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-900 dark:text-white hover:underline">Services</a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-900 dark:text-white hover:underline">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div>
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-16 lg:py-10">
            <div class="bg-white sm:rounded-lg">

                <slot />

            </div>
        </div>
    </div>
</template>