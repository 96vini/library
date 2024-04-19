<template>
    <Head title="Books" />
  
    <AuthenticatedLayout>
      <template #header>
        <div class="flex justify-between items-center">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">Books</h2>
          <div class="space-x-5">
            <a :href="route('books.edit', book.id)" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Edit <PencilSquareIcon class="w-6 mx-1 text-white" /></a>
            <a :href="route('books.create')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Add <PlusCircleIcon class="w-6 mx-1 text-white" /></a>
          </div>
        </div>
      </template>
  
      <div class="flex justify-center h-screen py-10">
        <div class="flex w-full max-w-5xl p-5 bg-white rounded-lg">
          <div class="w-1/3">
            <img :src="book.image_url" :alt="book.name" class="h-auto w-auto rounded-lg">
          </div>
          <div class="w-1/3 px-5">
            <h3 class="text-3xl font-semibold text-gray-800 py-5">{{ book.name }}</h3>
            <p class="text-2xl text-gray-700 mb-5">$ {{ book.value }}</p>
            <p class="text-base text-gray-700">{{ book.description }}</p>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>
  
  <script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { Head } from '@inertiajs/vue3';
  import { usePage } from '@inertiajs/vue3';
  import { PlusCircleIcon } from '@heroicons/vue/24/solid';
  import { PencilSquareIcon } from '@heroicons/vue/24/solid';
  
  const { props } = usePage();
  const { book } = props;
  </script>
  
  <style scoped>
  .grid > div {
    cursor: pointer;
  }
  </style>
  