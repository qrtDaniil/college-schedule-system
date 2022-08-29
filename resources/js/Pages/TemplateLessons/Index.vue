<template>

    <Head>
        <title>Расписание</title>
        <meta name="description" content="Расписание">
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
                <h1 class="text-2xl whitespace-nowrap font-semibold pb-2">Расписание</h1>
            </div>

            <div v-dragscroll class="overflow-x-auto rounded border overflow-y-hidden cursor-ew-resize">
                <table class="w-full table-fixed">
                    <tbody>
                    <tr>
                        <th class="-rotate-90 border w-10 h-48 text-center" rowspan="6">Понедельник</th>
                        <th class="border w-10 text-center"></th>
                        <th v-for="(groupLessons, name) in templateLessons[currentGrade][1]" :key="name"
                            class="p-1 text-center uppercase font-semibold border w-48 h-10">
                            <p class="whitespace-nowrap">{{ name }}</p>
                        </th>
                    </tr>
                    <tr v-for="index in 5" :key="index">
                        <td class="-rotate-90 border text-center whitespace-nowrap font-semibold">{{ index }} пара</td>
                        <td v-for="(groupLessons, name) in templateLessons[currentGrade][1]" :key="name"
                            class="relative py-1 px-2 border h-36">
                            <div v-for="lesson in groupLessons">
                                <div v-if="lesson.position === index">
                                    <div v-if="lesson.week_number === 0">
                                        <button class="text-left" @click="openEditModal(lesson, [1, index, name])">
                                            {{ lesson.subject.index + ' ' + lesson.subject.name + ' ' + lesson.subject.teacher }}
                                        </button>
                                        <br>
                                    </div>
                                    <div v-if="lesson.week_number === 1">
                                        <button class="text-left" @click="openEditModal(lesson, [1, index, name])">
                                            1 н: {{ lesson.subject.index + ' ' + lesson.subject.name + ' ' + lesson.subject.teacher }}
                                        </button>
                                        <br>
                                    </div>
                                    <div v-if="lesson.week_number === 2">
                                        <button class="text-left" @click="openEditModal(lesson, [1, index, name])">
                                            2 н: {{ lesson.subject.index + ' ' + lesson.subject.name + ' ' + lesson.subject.teacher }}
                                        </button>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="absolute bottom-0 right-0" @click="openCreateModal([1, index, name])">
                                    <svg fill="none" height="22" viewBox="0 0 10 12" width="20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.91667 14H14V2.91667L2.91667 14Z" fill="#ced4da"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="-rotate-90 border w-10 h-48 text-center" rowspan="6">Вторник</th>
                        <th class="border w-10 text-center"></th>
                        <th v-for="(groupLessons, name) in templateLessons[currentGrade][2]" :key="name"
                            class="p-1 text-center uppercase font-semibold border">
                            <p class="whitespace-nowrap">{{ name }}</p>
                        </th>
                    </tr>
                    <tr v-for="index in 5" :key="index">
                        <td class="-rotate-90 border text-center whitespace-nowrap font-semibold">{{ index }} пара</td>
                        <td v-for="(groupLessons, name) in templateLessons[currentGrade][2]" :key="name"
                            class="relative py-1 px-2 border h-36">
                            <div v-for="lesson in groupLessons">
                                <div v-if="lesson.position === index">
                                    <div v-if="lesson.week_number === 0">
                                        <button class="text-left" @click="openEditModal(lesson, [1, index, name])">
                                            {{ lesson.subject.index + ' ' + lesson.subject.name + ' ' + lesson.subject.teacher }}
                                        </button>
                                        <br>
                                    </div>
                                    <div v-if="lesson.week_number === 1">
                                        <button class="text-left" @click="openEditModal(lesson, [1, index, name])">
                                            1 н: {{ lesson.subject.index + ' ' + lesson.subject.name + ' ' + lesson.subject.teacher }}
                                        </button>
                                        <br>
                                    </div>
                                    <div v-if="lesson.week_number === 2">
                                        <button class="text-left" @click="openEditModal(lesson, [1, index, name])">
                                            2 н: {{ lesson.subject.index + ' ' + lesson.subject.name + ' ' + lesson.subject.teacher }}
                                        </button>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="absolute bottom-0 right-0" @click="openCreateModal([2, index, name])">
                                    <svg fill="none" height="22" viewBox="0 0 10 12" width="20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.91667 14H14V2.91667L2.91667 14Z" fill="#ced4da"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="-rotate-90 border w-10 h-48 text-center" rowspan="6">Среда</th>
                        <th class="border w-10 text-center"></th>
                        <th v-for="(groupLessons, name) in templateLessons[currentGrade][3]" :key="name"
                            class="p-1 text-center uppercase font-semibold border">
                            <p class="whitespace-nowrap">{{ name }}</p>
                        </th>
                    </tr>
                    <tr v-for="index in 5" :key="index">
                        <td class="-rotate-90 border text-center whitespace-nowrap font-semibold">{{ index }} пара</td>
                        <td v-for="(groupLessons, name) in templateLessons[currentGrade][3]" :key="name"
                            class="relative py-1 px-2 border h-36">
                            <div v-for="lesson in groupLessons">
                                <div v-if="lesson.position === index">
                                    <div v-if="lesson.week_number === 0">
                                        <button class="text-left" @click="openEditModal(lesson, [1, index, name])">
                                            {{ lesson.subject.index + ' ' + lesson.subject.name + ' ' + lesson.subject.teacher }}
                                        </button>
                                        <br>
                                    </div>
                                    <div v-if="lesson.week_number === 1">
                                        <button class="text-left" @click="openEditModal(lesson, [1, index, name])">
                                            1 н: {{ lesson.subject.index + ' ' + lesson.subject.name + ' ' + lesson.subject.teacher }}
                                        </button>
                                        <br>
                                    </div>
                                    <div v-if="lesson.week_number === 2">
                                        <button class="text-left" @click="openEditModal(lesson, [1, index, name])">
                                            2 н: {{ lesson.subject.index + ' ' + lesson.subject.name + ' ' + lesson.subject.teacher }}
                                        </button>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="absolute bottom-0 right-0" @click="openCreateModal([3, index, name])">
                                    <svg fill="none" height="22" viewBox="0 0 10 12" width="20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.91667 14H14V2.91667L2.91667 14Z" fill="#ced4da"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="-rotate-90 border w-10 h-48 text-center" rowspan="6">Четверг</th>
                        <th class="border w-10 text-center"></th>
                        <th v-for="(groupLessons, name) in templateLessons[currentGrade][4]" :key="name"
                            class="p-1 text-center uppercase font-semibold border">
                            <p class="whitespace-nowrap">{{ name }}</p>
                        </th>
                    </tr>
                    <tr v-for="index in 5" :key="index">
                        <td class="-rotate-90 border text-center whitespace-nowrap font-semibold">{{ index }} пара</td>
                        <td v-for="(groupLessons, name) in templateLessons[currentGrade][4]" :key="name"
                            class="relative py-1 px-2 border h-36">
                            <div v-for="lesson in groupLessons">
                                <div v-if="lesson.position === index">
                                    <div v-if="lesson.week_number === 0">
                                        <button class="text-left" @click="openEditModal(lesson, [1, index, name])">
                                            {{ lesson.subject.index + ' ' + lesson.subject.name + ' ' + lesson.subject.teacher }}
                                        </button>
                                        <br>
                                    </div>
                                    <div v-if="lesson.week_number === 1">
                                        <button class="text-left" @click="openEditModal(lesson, [1, index, name])">
                                            1 н: {{ lesson.subject.index + ' ' + lesson.subject.name + ' ' + lesson.subject.teacher }}
                                        </button>
                                        <br>
                                    </div>
                                    <div v-if="lesson.week_number === 2">
                                        <button class="text-left" @click="openEditModal(lesson, [1, index, name])">
                                            2 н: {{ lesson.subject.index + ' ' + lesson.subject.name + ' ' + lesson.subject.teacher }}
                                        </button>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="absolute bottom-0 right-0" @click="openCreateModal([4, index, name])">
                                    <svg fill="none" height="22" viewBox="0 0 10 12" width="20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.91667 14H14V2.91667L2.91667 14Z" fill="#ced4da"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="-rotate-90 border w-10 h-48 text-center" rowspan="6">Пятница</th>
                        <th class="border w-10 text-center"></th>
                        <th v-for="(groupLessons, name) in templateLessons[currentGrade][5]" :key="name"
                            class="p-1 text-center uppercase font-semibold border">
                            <p class="whitespace-nowrap">{{ name }}</p>
                        </th>
                    </tr>
                    <tr v-for="index in 5" :key="index">
                        <td class="-rotate-90 border text-center whitespace-nowrap font-semibold">{{ index }} пара</td>
                        <td v-for="(groupLessons, name) in templateLessons[currentGrade][5]" :key="name"
                            class="relative py-1 px-2 border h-36">
                            <div v-for="lesson in groupLessons">
                                <div v-if="lesson.position === index">
                                    <div v-if="lesson.week_number === 0">
                                        <button class="text-left" @click="openEditModal(lesson, [1, index, name])">
                                            {{ lesson.subject.index + ' ' + lesson.subject.name + ' ' + lesson.subject.teacher }}
                                        </button>
                                        <br>
                                    </div>
                                    <div v-if="lesson.week_number === 1">
                                        <button class="text-left" @click="openEditModal(lesson, [1, index, name])">
                                            1 н: {{ lesson.subject.index + ' ' + lesson.subject.name + ' ' + lesson.subject.teacher }}
                                        </button>
                                        <br>
                                    </div>
                                    <div v-if="lesson.week_number === 2">
                                        <button class="text-left" @click="openEditModal(lesson, [1, index, name])">
                                            2 н: {{ lesson.subject.index + ' ' + lesson.subject.name + ' ' + lesson.subject.teacher }}
                                        </button>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="absolute bottom-0 right-0" @click="openCreateModal([5, index, name])">
                                    <svg fill="none" height="22" viewBox="0 0 10 12" width="20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.91667 14H14V2.91667L2.91667 14Z" fill="#ced4da"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between my-2">
                <div>
                    <p class="text-gray-600">Показано расписание для групп {{ currentGrade }} курса</p>
                </div>
                <div>
                    <Link class="border border-gray-100 hover:bg-gray-400 hover:bg-opacity-25 relative inline-flex items-center px-4 py-2 font-semibold duration-150 rounded-l"
                          type="button" :href="route('template-lessons.index')"
                          :class="route().params.grade ? '' : 'bg-gray-800 text-white pointer-events-none border border-black'"
                    >1 Курс</Link>
                    <Link class="border border-gray-100 hover:bg-gray-400 hover:bg-opacity-25 relative inline-flex items-center px-4 py-2 font-semibold duration-150"
                          type="button" :href="route('template-lessons.index', {grade: 2})"
                          :class="route().params.grade === '2' ? 'bg-gray-800 text-white pointer-events-none border border-black' : ''"
                    >2 Курс</Link>
                    <Link class="border border-gray-100 hover:bg-gray-400 hover:bg-opacity-25 relative inline-flex items-center px-4 py-2 font-semibold duration-150"
                          type="button" :href="route('template-lessons.index', {grade: 3})"
                          :class="route().params.grade === '3' ? 'bg-gray-800 text-white pointer-events-none border border-black' : ''"
                    >3 Курс</Link>
                    <Link class="border border-gray-100 hover:bg-gray-400 hover:bg-opacity-25 relative inline-flex items-center px-4 py-2 font-semibold duration-150"
                          type="button" :href="route('template-lessons.index', {grade: 4})"
                          :class="route().params.grade === '4' ? 'bg-gray-800 text-white pointer-events-none border border-black' : ''"
                    >4 Курс</Link>
                    <Link class="border border-gray-100 hover:bg-gray-400 hover:bg-opacity-25 relative inline-flex items-center px-4 py-2 font-semibold duration-150 rounded-r"
                          type="button" :href="route('template-lessons.index', {grade: 5})"
                          :class="route().params.grade === '5' ? 'bg-gray-800 text-white pointer-events-none border border-black' : ''"
                    >5 Курс</Link>
                </div>
            </div>

            <div class="mt-1">
                <a class="px-4 p-2 border bg-gray-800 text-white rounded font-semibold hover:border hover:border-black hover:text-black hover:font-semibold hover:bg-white duration-150"
                    href="template-lessons/export">
                    Скачать расписание
                </a>
            </div>

        </div>
    </div>

    <CreateModal :open="showCreateModal" :position="position" :subjectsForGroup="subjectsForGroup" @close="closeCreateModal()"/>

    <EditModal :open="showEditModal" :position="position" :lesson="lesson" :subjectsForGroup="subjectsForGroup" @close="closeEditModal()"/>

</template>

<script setup>
import Sidebar from '@/Shared/Sidebar.vue';
import {ref} from "vue";
import CreateModal from "./CreateModal.vue";
import EditModal from "./EditModal.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";

defineProps({
    templateLessons: Object,
    subjectsForGroup: Object,
    errors: Object,
});

let currentGrade = ref(route().params.grade ? route().params.grade : 1);

let showCreateModal = ref(false)
let showEditModal = ref(false)

let position = []
let lesson = null

function openCreateModal(position) {
    this.showCreateModal = true;
    this.position = position
}
function closeCreateModal() {
    this.showCreateModal = !showCreateModal
}

function openEditModal(lesson, position) {
    this.showEditModal = true;
    this.position = position
    this.lesson = lesson
}
function closeEditModal() {
    this.showEditModal = !showEditModal
}

</script>
