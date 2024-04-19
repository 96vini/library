<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const redirect = (id) => {
    return router.visit(route('books.read', id));
}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            <div v-for="book in $page.props.books" class="bg-white p-4 cursor-pointer" @click="redirect(book.id)">
                                <img :src="book.image_url" :alt="book.name" class="rounded-md">
                                <div class="text-center text-blue-700 pt-5 font-bold">{{ book.name }}</div> 
                                <div class="text-center text-gray-600 font-semibold">$ {{ book.value }}</div>
                                <div class="text-center text-gray-600 font-semibold" v-for="store in book.stores">Avaliable in {{ store.name }}</div>
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