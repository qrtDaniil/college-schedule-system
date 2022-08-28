<template>

    <Head>
        <title>Нагрузка преподавателей</title>
        <meta name="description" content="Нагрузка преподавателей">
    </Head>

    <div class="flex">
        <Sidebar/>
        <div class="flex-1 flex flex-col overflow-hidden p-4">
            <div>
                <div v-show="Object.keys(errors).length > 0">
                    <div v-if="errors.message && errors.message.length !== 0" class="bg-green-200 border-green-600 border-l-4 p-4" >
                        <p class="font-bold">Успех!</p>
                        <p v-text="errors.message"></p>
                    </div>

                    <div v-else class="bg-red-200 border-red-600 border-l-4 p-4" >
                        <p class="font-bold">Внимание!</p>
                        <p v-for="error in errors" :key="errors" v-text="error"></p>
                    </div>
                </div>
            </div>
            <div>
                <h1 class="text-2xl whitespace-nowrap font-semibold pb-2">Нагрузка преподавателей</h1>
            </div>
            <div class="overflow-x-auto rounded shadow">
                <table class="w-full">
                    <thead>
                    <tr>
                        <th class="p-3 border-b border-gray-400 text-left uppercase font-semibold w-0" scope="col">
                            Курс*
                        </th>
                        <th class="p-3 border-b border-gray-400 text-left uppercase font-semibold w-0" scope="col">
                            Группа*
                        </th>
                        <th class="p-3 border-b border-gray-400 text-left uppercase font-semibold w-1/12"
                            scope="col">
                            Индекс
                        </th>
                        <th class="p-3 border-b border-gray-400 text-left uppercase font-semibold w-6/12"
                            scope="col">
                            Наименование учебной дисциплины*
                        </th>
                        <th class="p-3 border-b border-gray-400 text-left uppercase font-semibold w-2/12"
                            scope="col">
                            Преподаватель
                        </th>
                        <th class="p-3 border-b border-gray-400 text-left uppercase font-semibold w-0" scope="col">
                            Часов 1 п/г*
                        </th>
                        <th class="p-3 border-b border-gray-400 text-left uppercase font-semibold w-0" scope="col">
                            Часов 2 п/г*
                        </th>
                        <th class="p-3 border-b border-gray-400 text-left uppercase font-semibold w-0" scope="col">
                            Аудитория
                        </th>
                        <th class="p-3 border-b border-gray-400 text-left uppercase font-semibold w-0"
                            colspan="2" scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="pl-2 pr-1 py-2 border-b border-gray-400">
                            <input class="p-2 rounded border border-gray-200 w-full" name="grade" type="text" autocomplete="off"
                            v-model="formSearch.grade">
                        </td>
                        <td class="px-1 py-2 border-b border-gray-400">
                            <input class="p-2 rounded border border-gray-200 w-full" name="group" type="text" autocomplete="off"
                            v-model="formSearch.group">
                        </td>
                        <td class="px-1 py-2 border-b border-gray-400">
                            <input class="p-2 rounded border border-gray-200 w-full" name="index" type="text" autocomplete="off"
                            v-model="formSearch.index">
                        </td>
                        <td class="px-1 py-2 border-b border-gray-400">
                            <input class="p-2 rounded border border-gray-200 w-full" name="name" type="text" autocomplete="off"
                            v-model="formSearch.name">
                        </td>
                        <td class="px-1 py-2 border-b border-gray-400">
                            <input class="p-2 rounded border border-gray-200 w-full" name="teacher" type="text" autocomplete="off"
                            v-model="formSearch.teacher">
                        </td>
                        <td class="px-1 py-2 border-b border-gray-400">
                            <input class="p-2 rounded border border-gray-200 w-full" name="hours_first_half" type="text" autocomplete="off"
                            v-model="formSearch.hours_first_half">
                        </td>
                        <td class="px-1 py-2 border-b border-gray-400">
                            <input class="p-2 rounded border border-gray-200 w-full" name="hours_second_half" type="text" autocomplete="off"
                            v-model="formSearch.hours_second_half">
                        </td>
                        <td class="px-1 py-2 border-b border-gray-400">
                            <input class="p-2 rounded border border-gray-200 w-full" name="class" type="text" autocomplete="off"
                            v-model="formSearch.class">
                        </td>
                        <td class="pl-1 pr-2 py-2 border-b border-gray-400 text-center" colspan="2">
                            <button
                                class="px-4 p-2 border bg-gray-800 text-white rounded font-semibold hover:border hover:border-black hover:text-black hover:font-semibold hover:bg-white w-full inline-block duration-150"
                                @click="seacrh()">
                                Поиск
                            </button>
                        </td>
                    </tr>
                    <tr v-for="subject in subjects.data" v-if="subjects.total > 0" :key="subject.id">
                        <td class="p-1 border-b border-gray-400">
                            <p class="p-2 w-full" v-text="subject.grade" />
                        </td>
                        <td class="p-1 border-b border-gray-400">
                            <p class="p-2 w-full" v-text="subject.group" />
                        </td>
                        <td class="p-1 border-b border-gray-400">
                            <p class="p-2 w-full" v-text="subject.index" />
                        </td>
                        <td class="p-1 border-b border-gray-400">
                            <p class="p-2 w-full" v-text="subject.name" />
                        </td>
                        <td class="p-1 border-b border-gray-400">
                            <p class="p-2 w-full" v-text="subject.teacher" />
                        </td>
                        <td class="p-1 border-b border-gray-400">
                            <p class="p-2 w-full" v-text="subject.hours_first_half" />
                        </td>
                        <td class="p-1 border-b border-gray-400">
                            <p class="p-2 w-full" v-text="subject.hours_second_half" />
                        </td>
                        <td class="p-1 border-b border-gray-400">
                            <p class="p-2 w-full" v-text="subject.class" />
                        </td>
                        <td class="p-3 pr-2 border-b border-gray-400 text-left">
                            <Link :href="route('subjects.edit', subject.id)" class="text-blue-600">Изменить</Link>
                        </td>
                        <td class="p-3 pl-2 border-b border-gray-400 text-right">
                            <button class="text-red-600" @click="destroy(subject.id)">Удалить</button>
                        </td>
                    </tr>
                    <tr v-else>
                        <td class="text-center border-b border-gray-400 py-4" colspan="10">
                            <p class="text-lg text-gray-600">
                                К сожалению ничего не найдено.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="pl-2 pr-1 py-2">
                            <input class="p-2 rounded border border-gray-200 w-full" name="grade" type="text" autocomplete="off"
                            v-model="formStore.grade" required>
                        </td>
                        <td class="px-1 py-2">
                            <input class="p-2 rounded border border-gray-200 w-full" name="group" type="text" autocomplete="off"
                            v-model="formStore.group" required>
                        </td>
                        <td class="px-1 py-2">
                            <input class="p-2 rounded border border-gray-200 w-full" name="index" type="text" autocomplete="off"
                            v-model="formStore.index">
                        </td>
                        <td class="px-1 py-2">
                            <input class="p-2 rounded border border-gray-200 w-full" name="name" type="text" autocomplete="off"
                            v-model="formStore.name" required>
                        </td>
                        <td class="px-1 py-2">
                            <input class="p-2 rounded border border-gray-200 w-full" name="teacher" type="text" autocomplete="off"
                            v-model="formStore.teacher">
                        </td>
                        <td class="px-1 py-2">
                            <input class="p-2 rounded border border-gray-200 w-full" name="hours_first_half" type="text" autocomplete="off"
                            v-model="formStore.hours_first_half" required>
                        </td>
                        <td class="px-1 py-2">
                            <input class="p-2 rounded border border-gray-200 w-full" name="hours_second_half" type="text" autocomplete="off"
                            v-model="formStore.hours_second_half" required>
                        </td>
                        <td class="px-1 py-2">
                            <input class="p-2 rounded border border-gray-200 w-full" name="class" type="text" autocomplete="off"
                            v-model="formStore.class">
                        </td>
                        <td class="pl-1 pr-2 py-2 text-center" colspan="2">
                            <button
                                class="px-4 p-2 border bg-gray-800 text-white rounded font-semibold hover:border hover:border-black hover:text-black hover:font-semibold hover:bg-white w-full inline-block duration-150"
                                @click="store()">
                                Добавить
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div v-if="subjects.data.length" class="flex justify-between mt-2">
                <div>
                    <p class="text-gray-600">Показаны записи с {{ subjects.from }} по {{ subjects.to }} из {{ subjects.total }}.</p>
                </div>
                <div>
                    <Component
                        :is="link.url ? 'Link' : 'span'"
                        v-for="link in subjects.links"
                        :class="link.url ? [link.active ? 'bg-gray-800 text-white pointer-events-none border border-black' : ''] : 'pointer-events-none'"
                        :href="link.url"
                        as="button"
                        class="border border-gray-100 hover:bg-gray-400 hover:bg-opacity-25 relative inline-flex items-center px-4 py-2 font-semibold duration-150"
                        v-html="link.label"
                    />
                </div>
            </div>

            <div class="text-left mt-2">
                <button
                    class="px-4 p-2 border bg-gray-800 text-white rounded font-semibold hover:border hover:border-black hover:text-black hover:font-semibold hover:bg-white duration-150"
                    @click="showModal = true">
                    Импорт
                </button>
            </div>

        </div>
    </div>

    <ImportModal :open="showModal" @close="showModal = !showModal" />

</template>

<script setup>
import Sidebar from "@/Shared/Sidebar.vue";
import ImportModal from "./ImportModal.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import {ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia"

defineProps({
    subjects: Object,
    errors: Object,
});

const showModal = ref(false)

let formStore = useForm({
    grade: null,
    group: null,
    index: null,
    name: null,
    teacher: null,
    hours_first_half: null,
    hours_second_half: null,
    class: null,
});

function store() {
    formStore.post(route('subjects.store'))
    formStore.reset()
}

let formSearch = useForm({
    grade: null,
    group: null,
    index: null,
    name: null,
    teacher: null,
    hours_first_half: null,
    hours_second_half: null,
    class: null,
});

function seacrh() {
    Inertia.get('/subjects', {
            grade: formSearch.grade,
            group: formSearch.group,
            index: formSearch.index,
            name: formSearch.name,
            teacher: formSearch.teacher,
            hours_first_half: formSearch.hours_first_half,
            hours_second_half: formSearch.hours_second_half,
            class: formSearch.class,},
        {
            preserveState: true,
        })
}

let formDestroy = useForm();
function destroy(id) {
    if (confirm("Вы уверены что хотите удалить данную запись?")) {
        formDestroy.delete(route('subjects.destroy', id));
    }
}
</script>

