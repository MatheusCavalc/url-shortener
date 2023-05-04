<script setup>
import MainLayout from '@/layouts/MainLayout.vue';
import { ref } from 'vue';

const showDiv = ref(false)

const change = () => {
  showDiv.value = !showDiv.value
}
</script>

<template>
  <MainLayout>
    <div class="bg-home">
      <div class="border-gray-200 dark:border-gray-700 grid grid-cols-5 gap-4 place-content-center h-[450px]">
        <div class="col-span-3">
          <p class="text-4xl font-bold">We’ve expanded!</p>
          <p class="text-4xl font-bold">Shorten URLs. Generate QR Codes. </p>
          <p class="text-4xl font-bold">And now, create Link-in-bios.</p>
        </div>

        <div class="text-center col-span-2"></div>
      </div>
    </div>
  </MainLayout>
</template>

<style>
.bg-home {
  background-image: url("https://docrdsfx76ssb.cloudfront.net/static/1683058957/pages/wp-content/uploads/2022/10/homepage-hero-a-bit-closer-desktop-v2.png");
  height: 450px;
  position: relative;
  background-position: 56% 0;
  background-position: bottom;
  background-repeat: no-repeat;
  background-color: #fff;
  transition: all 300ms;
  margin-top: -2px;
  background-size: contain;
}
</style>