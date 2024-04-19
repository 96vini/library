<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { PlusCircleIcon } from '@heroicons/vue/24/solid';

const { props } = usePage();
const { stores } = props;

const redirect = (id) => {
  router.visit(route('stores.read', id));
};

const deleteStore = async(id) => {
    await router.post(route('stores.delete', { id }));
    router.reload();
};
</script>

<template>
  <Head title="Stores" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Stores</h2>
        <a :href="route('stores.create')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Add <PlusCircleIcon class="w-6 mx-1 text-white" /></a>
      </div>
    </template>

    <div class="py-2">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">  
              <div
                v-for="store in stores.data"
                :key="store.id"
                class="relative bg-white p-4 rounded-lg cursor-pointer hover:shadow-lg"
              >
                <img :src="store.image_url" alt="Store Image" class="mb-2 mx-auto h-48 w-auto rounded-lg">
                <div class="text-center text-blue-700 font-bold cursor-pointer" @click="redirect(store.id)">{{ store.name }}</div>
                <div class="text-center text-gray-600 font-semibold">{{ store.address }}</div>
                <!-- Circular delete icon -->
                <button
                  @click.stop="deleteStore(store.id)"
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

<style scoped>
.grid > div {
  transition: transform 0.2s ease-in-out;
}

.grid > div:hover {
  transform: translateY(-5px);
}
</style>
