<template>
    <Head title="Stores" />
  
    <AuthenticatedLayout>
      <template #header>
        <div class="flex justify-between items-center">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">Stores</h2>
          <div class="space-x-5">
            <a :href="route('stores.edit', $page.props.store.id)" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Edit <PencilSquareIcon class="w-6 mx-1 text-white" /></a>
            <a :href="route('stores.create')" class="mx-5 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Add <PlusCircleIcon class="w-6 mx-1 text-white" /></a>
          </div>
        </div>
      </template>
  
      <div class="flex justify-center py-10">
        <div class="max-w-5xl">
          <div class="flex justify-between bg-white rounded-lg shadow-md p-5">
            <div class="w-2/5">
              <img :src="store.image_url" :alt="store.name" class="h-auto w-auto rounded-lg">
            </div>
            <div class="w-3/5 px-5">
              <h3 class="text-3xl font-semibold text-gray-800 py-5">{{ store.name }}</h3>
              <p class="flex justify-start text-lg text-blue-700 font-bold mb-5"><MapPinIcon class="w-5 p-0 m-0 text-blue-700" />{{ store.address }}</p>
              <p class="text-lg text-gray-400 mb-5">{{ store.description }}</p>
            </div>
          </div>
          
          <div v-if="store.books.length > 0" class="mt-10">
            <h3 class="text-3xl font-semibold text-gray-800 py-5">Books in this store</h3>
            <div class="grid grid-cols-4 gap-8">
              <div v-for="book in store.books" :key="book.id" class="bg-white p-5 rounded-lg shadow-md">
                <img :src="book.image_url" :alt="book.name" class="h-auto w-full rounded-lg mb-3">
                <p class="text-base text-gray-700 font-bold">{{ book.name }}</p>
              </div>
            </div>
          </div>
          <div v-else class="mt-10 text-gray-500 text-xl">
            No books available in this store.
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>
  
  <script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { Head, router } from '@inertiajs/vue3';
  import { usePage } from '@inertiajs/vue3';
  import { MapPinIcon } from '@heroicons/vue/24/solid';
  import { PlusCircleIcon } from '@heroicons/vue/24/solid';
  import { PencilSquareIcon } from '@heroicons/vue/24/solid';
  
  const { props } = usePage();
  const { store } = props;
  </script>
  
  <style scoped>
  .grid > div {
    cursor: pointer;
  }
  </style>
  