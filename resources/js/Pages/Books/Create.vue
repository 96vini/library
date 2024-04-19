<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Books</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submitForm">
                            <div class="grid grid-cols-1 gap-4">
                                <div class="col-span-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Book Name</label>
                                    <input type="text" id="name" name="name" v-model="form.name" autocomplete="off" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div class="col-span-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Book Description</label>
                                    <textarea type="text" id="description" name="description" v-model="form.description" autocomplete="off" required class="resize-none mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                                </div>
                                <div>
                                    <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN</label>
                                    <input type="text" id="isbn" name="isbn" v-model="form.isbn" autocomplete="off" pattern="[0-9]*" title="Please enter numbers only" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="value" class="block text-sm font-medium text-gray-700">Value</label>
                                    <input type="number" id="value" name="value" v-model="form.value" step="0.01" autocomplete="off" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div class="col-span-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Book Cover (Optional)</label>
                                    <input type="file" @change="handleFileChange" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const form = {
    name: '',
    description: '',
    isbn: '',
    value: null,
    image: [],
};

const handleFileChange = (event) => {
    form.image = event.target.files[0];
}

const submitForm = async () => {
    try {
        await router.post(route('books.store'), form)
            .then(() => {
                router.visit(route('stores'));
            });
    } catch (error) {
        console.error(error);
    }
};

</script>
