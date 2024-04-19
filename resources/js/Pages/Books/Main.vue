<template>
    <Head title="Books" />
  
    <AuthenticatedLayout>
      <template #header>
        <div class="flex justify-between items-center">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">Books</h2>
          <a href="/books/create" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Add <PlusCircleIcon class="w-6 mx-1 text-white" /></a>
        </div>
      </template>
  
      <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
              <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <div
                  v-for="book in $page.props.books.data"
                  :key="book.id"
                  class="relative bg-white p-4 rounded-lg cursor-pointer hover:shadow-lg"
                  @click="redirect(book.id)"
                >
                  <img :src="book.image_url" alt="Book Image" class="mb-2 mx-auto h-auto rounded-md">
                  <div class="text-center text-blue-700 font-bold cursor-pointer">{{ book.name }}</div>
                  <div class="text-center text-gray-600 font-semibold">$ {{ book.value }}</div>
                  <!-- Circular delete icon -->
                  <button
                    @click.stop="deleteBook(book.id)"
                    class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-full w-8 h-8 flex justify-center items-center focus:outline-none"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>
  
  <script setup>
  import { Head, router } from '@inertiajs/vue3';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { PlusCircleIcon } from '@heroicons/vue/24/solid';
  
  function redirect(id) {
    router.visit(route('books.read', id));
  }
  
  const deleteBook = async(id) => {
    await router.post(route('books.delete', { id }));
  }
  </script>
  
  <style scoped>
  .grid > div {
    transition: transform 0.2s ease-in-out;
  }
  
  .grid > div:hover {
    transform: translateY(-5px);
  }
  </style>
  