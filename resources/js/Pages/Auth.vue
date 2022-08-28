<template>

    <Head>
        <title>Авторизация</title>
        <meta name="description" content="Авторизация">
    </Head>

    <form @submit.prevent="auth">
        <div
            class="border m-6 rounded-lg bg-white mx-auto shadow-lg max-w-sm lg:max-w-lg md:max-w-lg sm:max-w-lg overflow-hidden">

            <div class="p-4 border-t-4 border-gray-800">

                <div class="mb-4">
                    <p class="text-xl text-gray-800 font-semibold">Пожалуйста авторизируйтесь</p>
                </div>

                <input
                    v-model="formLogin.login" :class="formLogin.errors.login ? 'border-red-600' : ''"
                    class="mb-3 p-2 appearance-none block w-full rounded border border-gray-300 focus:border-teal-500" name="login" placeholder="Логин"
                    type="text"/>

                <div v-if="formLogin.errors.login" class="text-red-600 mb-1" v-text="formLogin.errors.login"></div>

                <input
                    v-model="formLogin.password" :class="formLogin.errors.password ? 'border-red-600' : ''"
                    class="mb-3 p-2 appearance-none block w-full rounded border border-gray-300 focus:border-teal-500" name="password" placeholder="Пароль"
                    type="password"/>

                <div v-if="formLogin.errors.password" class="text-red-600 mb-1"
                     v-text="formLogin.errors.password"></div>

                <div class="flex items-center">
                    <div class="w-1/2 flex items-center">
                        <input id="remember" v-model="formLogin.remember" class="mt-1 mr-2" name="remember"
                               type="checkbox"/>
                        <label for="remember">Запомнить меня</label>
                    </div>

                    <button :disabled="formLogin.processing"
                            class="ml-auto w-1/2 bg-gray-800 text-white p-2 rounded font-semibold hover:bg-gray-900"
                            type="submit"
                    >Войти
                    </button>
                </div>

                <div class="mt-4">
                    <p class="font-semibold text-gray-700 text-sm">
                        Для авторизицаии введите свой логин и пароль, а после нажмите на кнопку "Войти".
                        Если вы хотите чтобы вы автоматически входили в аккаунт без повторного ввода логина и пароля,
                        поставьте галочку рядом с надписью "Запомнить меня".
                    </p>
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
import {useForm} from "@inertiajs/inertia-vue3";

let formLogin = useForm({
    login: null,
    password: null,
    remember: null,
});

function auth() {
    formLogin.post(route('auth.login'));
}
</script>
