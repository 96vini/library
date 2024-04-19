<template>
    <Head title="Create Store" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Stores</h2>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submitForm">
                            <div class="grid grid-cols-1 gap-4">
                                <div class="col-span-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Store name</label>
                                    <input type="text" id="name" name="name" v-model="form.name" autocomplete="off" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div class="col-span-2">
                                    <label for="description" class="block text-sm font-medium text-gray-700">Store description</label>
                                    <textarea type="text" id="name" name="description" v-model="form.description" autocomplete="off" required class="mt-1 resize-none block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                                </div>
                                <div class="col-span-2">
                                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                    <input type="text" id="address" name="address" v-model="form.address" autocomplete="off" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div class="col-span-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Store Cover (Optional)</label>
                                    <input type="file" @change="handleFileChange" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div class="col-span-2">
                                    <label for="value" class="block text-sm font-medium text-gray-700">Active</label>
                                    <input type="checkbox" id="active" name="active" v-model="form.active" class="mt-1 block w-7 h-7 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div class="col-span-2">
                                    <label for="countries_multiple" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Add books</label>
                                    <select multiple id="countries_multiple" v-model="form.books" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                      <option selected>Press ⌘ or shift to select multiples</option>
                                      <option v-for="book in $page.props.books" :value="book.id">{{ book.name }}</option>
                                    </select>
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
    address: '',
    image: '',
    active: false,
    books: [],
};

const handleFileChange = (event) => {
    form.image = event.target.files[0];
}

const submitForm = async () => {
    try {
        await router.post(route('stores.store'), form)
            .then(() => {
                router.visit(route('stores'));
            });
    } catch (error) {
        console.error(error);
    }
};

</script>
