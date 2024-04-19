<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { BookOpenIcon } from '@heroicons/vue/24/solid';
import { BuildingStorefrontIcon } from '@heroicons/vue/24/solid'; 
import { BuildingLibraryIcon } from '@heroicons/vue/24/solid'; 

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Welcome" />
    <div class="w-full h-[100vh]" style="background-image: url('images/background.svg'); background-size: cover;">
        <header class="w-full h-20 flex justify-space-between items-center px-20">
            <div class="flex lg:col-start lg:col-start-2">
                <img src="/images/library_icon.png" class="w-10 h-10">
            </div>
            <nav class="w-auto flex flex-1 justify-end items-center space-x-4">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="text-white dark:text-white hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Dashboard
                </Link>

                <template v-else>
                    <Link
                        :href="route('login')"
                        class="text-white w-40 h-10 flex justify-center items-center text-center rounded-[35px] text-white dark:text-gray-100"
                    >
                        Log in
                    </Link>

                    <Link
                        :href="route('register')"
                        class="bg-white w-40 h-10 rounded-[35px] text-blue-700 flex justify-center items-center hover:opacity-60"
                    >
                        Register
                    </Link>
                </template>
            </nav>
        </header>
        <div class="w-full h-screen flex justify-center items-center bg-white text-blue-700">
            <div class="container mx-auto text-center">
              <h1 class="text-4xl font-bold mb-4">Welcome to Library</h1>
                <img class="w-1/2 mx-auto rounded-lg mb-6" src="/images/kid_with_book.jpeg" alt="">
              <p class="text-lg mb-6 text-gray-500">
                Your ultimate destination for exploring a vast collection of books from various stores!
              </p>
              <div class="flex justify-center items-center">
                <div class="px-5">
                    <div class="w-[300px] p-10 shadow-md flex justify-center rounded-lg">
                        <BookOpenIcon class="w-6 mx-1 text-blue-700" />
                        <p>Register your books</p>
                    </div>
                </div>
                <div class="px-5">
                    <div class="w-[300px] p-10 shadow-md flex justify-center rounded-lg">
                        <BuildingStorefrontIcon class="w-6 mx-1 text-blue-700" />
                        <p>Register your store</p>
                    </div>
                </div>
                <div class="px-5">
                    <div class="w-[300px] p-10 shadow-md flex justify-center rounded-lg">
                        <BuildingLibraryIcon class="w-6 mx-1 text-blue-700" />
                        <p>Mantain your own library</p>
                    </div>
                </div>
              </div>

            </div>
          </div>
    </div>
</template>
