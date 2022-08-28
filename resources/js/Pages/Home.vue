<template>

    <Head>
        <title>Главная страница</title>
        <meta name="description" content="Главная страница">
    </Head>

    <div
        class="border mx-auto my-0 sm:my-2 py-4 sm:rounded-lg  bg-white shadow-lg max-w-sm lg:max-w-lg md:max-w-lg sm:max-w-lg overflow-hidden">

        <img class="h-52 min-w-full block" src="images/College_colour.svg" alt="College logo"/>

        <div class="px-4 pt-1 relative text-center">

            <div class="mb-2">
                <p class="text-xl text-gray-800 font-bold">Рассписание занятий колледжа "Программирования и
                    кибербезопасности"</p>
            </div>

            <p class="text-lg text-gray-700 font-semibold">
                <Link href="/lessons" as="button" disabled>Расписание (В разработке)</Link>
            </p>
            <p class="text-lg text-gray-700 font-semibold mt-1">
                <Link href="" as="button" disabled>Телеграмм бот (В разработке)</Link>
            </p>

            <p v-if="user" class="text-lg text-gray-700 font-semibold mt-1">
                <Link :href="route('auth.logout')" method="post" as="button">Выйти из аккаунта</Link>
            </p>
            <p v-if="user" class="text-lg text-blue-600 font-semibold mt-1">
                <Link :href="route('subjects.index')">Панель управления расписанием</Link>
            </p>
            <p v-else class="text-lg text-gray-700 font-semibold mt-1">
                <Link :href="route('auth.index')">Авторизация</Link>
            </p>

        </div>
    </div>

</template>

<script setup>
import {computed} from "vue";
import {usePage} from "@inertiajs/inertia-vue3";

const user = computed(() => usePage().props.value.auth.user)

</script>
