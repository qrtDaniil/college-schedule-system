<template>
    <div class="flex">
        <Sidebar/>
        <div class="flex-1 flex flex-col overflow-hidden p-4">
            <div>
                <div>
                    <div class="bg-red-200 border-red-600 border-l-4 p-4" v-show="Object.keys(errors).length > 0">
                        <p class="font-bold">Внимание!</p>
                        <p v-for="error in errors" :key="errors" v-text="error"></p>
                    </div>
                </div>
                <div>
                    <h1 class="text-2xl whitespace-nowrap font-semibold pb-2">
                        <Link :href="route('subjects.index')" as="button" class="text-blue-600">Нагрузка преподавателей</Link>/ Редактирование записи
                    </h1>
                </div>
                <form @submit.prevent="update">
                    <div class="rounded shadow mx-auto min-w-full p-4">
                        <div class="flex">
                            <div class="w-full mx-2">
                                <label class="uppercase font-semibold">Курс*</label>
                                <input
                                    v-model="formUpdate.grade"
                                    autocomplete="off" class="mb-3 p-2 appearance-none block w-full rounded border border-gray-300 focus:border-teal-500"
                                    name="grade" required type="text"/>
                            </div>
                            <div class="w-full mx-2">
                                <label class="uppercase font-semibold">Группа*</label>
                                <input
                                    v-model="formUpdate.group"
                                    autocomplete="off" class="mb-3 p-2 appearance-none block w-full rounded border border-gray-300 focus:border-teal-500"
                                    name="group" required type="text"/>
                            </div>
                        </div>

                        <div class="mx-2">
                            <label class="uppercase font-semibold">Индекс*</label>
                            <input
                                v-model="formUpdate.index"
                                autocomplete="off" class="mb-3 p-2 appearance-none block w-full rounded border border-gray-300 focus:border-teal-500"
                                name="index" type="text"/>
                        </div>

                        <div class="mx-2">
                            <label class="uppercase font-semibold">Наименование учебной дисциплины*</label>
                            <input
                                v-model="formUpdate.name"
                                autocomplete="off" class="mb-3 p-2 appearance-none block w-full rounded border border-gray-300 focus:border-teal-500"
                                name="name" required type="text"/>
                        </div>

                        <div class="mx-2">
                            <label class="uppercase font-semibold">Преподаватель</label>
                            <input
                                v-model="formUpdate.teacher"
                                autocomplete="off" class="mb-3 p-2 appearance-none block w-full rounded border border-gray-300 focus:border-teal-500"
                                name="teacher" type="text"/>
                        </div>

                        <div class="flex">
                            <div class="w-full mx-2">
                                <label class="uppercase font-semibold">Часов 1 п/г*</label>
                                <input
                                    v-model="formUpdate.hours_first_half"
                                    autocomplete="off" class="mb-3 p-2 appearance-none block w-full rounded border border-gray-300 focus:border-teal-500"
                                    name="hours_first_half" required type="text"/>
                            </div>
                            <div class="w-full mx-2">
                                <label class="uppercase font-semibold">Часов 2 п/г*</label>
                                <input
                                    v-model="formUpdate.hours_second_half"
                                    autocomplete="off" class="mb-3 p-2 appearance-none block w-full rounded border border-gray-300 focus:border-teal-500"
                                    name="hours_second_half" required type="text"/>
                            </div>
                        </div>

                        <div class="mx-2">
                            <label class="uppercase font-semibold">Аудитория</label>
                            <input
                                v-model="formUpdate.class"
                                autocomplete="off" class="mb-3 p-2 appearance-none block w-full rounded border border-gray-300 focus:border-teal-500"
                                name="class" type="text"/>
                        </div>

                        <div class="flex justify-between">
                            <div class="mx-2">
                                <p>
                                    Столбцы отмеченные символом <span class="font-semibold">"*"</span>
                                    должны быть обязательно заполнены.</p>
                            </div>
                            <div class="mx-2">
                                <Link
                                    :href="route('subjects.index')"
                                    as="button" class="px-4 p-2 mr-3 border border-black rounded font-semibold hover:text-white hover:font-semibold hover:bg-gray-800 duration-150" type="button">Назад
                                </Link>
                                <button
                                    :disabled="formUpdate.processing"
                                    class="px-4 p-2 border bg-gray-800 text-white rounded font-semibold hover:border hover:border-black hover:text-black hover:font-semibold hover:bg-white duration-150"
                                    type="submit">Обновить запись
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import Sidebar from '@/Shared/Sidebar.vue';
import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps({
    subject: Object,
    errors: Object,
})

let formUpdate = useForm({
    grade: props.subject.grade,
    group: props.subject.group,
    index: props.subject.index,
    name: props.subject.name,
    teacher: props.subject.teacher,
    hours_first_half: props.subject.hours_first_half,
    hours_second_half: props.subject.hours_second_half,
    class: props.subject.class,
})

function update() {
    formUpdate.put(route('subjects.update', props.subject.id));
}
</script>

