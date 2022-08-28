<template>
    <Modal>
        <form @submit.prevent="store()">
            <div class="flex items-center justify-between pb-3">
                <p class="text-2xl font-bold">Добавить новое занятие</p>
                <div class="z-50 cursor-pointer modal-close" @click="$emit('close')">
                    <svg class="text-black fill-current" height="18" viewBox="0 0 18 18" width="18" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-blue-600 mb-2 font-semibold">
                    <p v-if="props.position">Добавить {{ props.position[1] }} пару {{ weekDays[props.position[0]] }} для группы {{ props.position[2] }}.</p>
                    <br v-else>
                </div>

                <input v-model="formStore.day" name="day" class="hidden" />

                <input v-model="formStore.position" name="position" class="hidden" />

                <div>
                    <label class="uppercase font-semibold">Номер недели*</label>
                    <select v-model="formStore.week_number" autocomplete="off"
                        class="mb-3 p-2 appearance-none block w-full rounded border border-gray-300 focus:border-teal-500"
                        name="week_number" required>

                        <option :value="0" >Каждую неделю</option>
                        <option :value="1" >Только не чётные недели</option>
                        <option :value="2" >Только чётные недели</option>

                    </select>
                </div>

                <div>
                    <label class="uppercase font-semibold">Учебная дисциплина*</label>
                    <select v-model="formStore.subject_id" autocomplete="off"
                        class="mb-3 p-2 appearance-none block w-full rounded border border-gray-300 focus:border-teal-500"
                        name="subject_id" required>

                        <option v-if="props.position" v-for="subject in subjectsForGroup[props.position[2]]"
                                :value="subject.id">{{ subject.index + ' ' + subject.name + ' ' + subject.teacher + ' // Добавлено ' + subject.template_lesson_count + ' раз'}}
                        </option>

                    </select>
                </div>

                <div>
                    <p>Столбцы отмеченные символом <span class="font-semibold">"*"</span>должны быть обязательно заполнены.</p>
                </div>
            </div>
            <div class="flex justify-end pt-3">
                <div>
                    <button
                        class="px-4 p-2 mr-3 border border-black rounded font-semibold hover:text-white hover:font-semibold hover:bg-gray-800 duration-150"
                        type="button" @click="$emit('close')">
                        Закрыть
                    </button>
                    <button class="px-4 p-2 border bg-gray-800 text-white rounded font-semibold hover:border hover:border-black hover:text-black hover:font-semibold hover:bg-white duration-150"
                        type="submit" @click="$emit('close')" :disabled="formStore.processing">
                        Добавить занятие
                    </button>
                </div>
            </div>
        </form>
    </Modal>
</template>

<script setup>
import {useForm} from "@inertiajs/inertia-vue3";
import Modal from "@/Shared/Modal.vue"

let props = defineProps({
    position: Array,
    subjectsForGroup: Object,
});

const weekDays = ['', 'в понедельник', 'во вторник', 'в среду', 'в четверг', 'в пятницу']

let formStore = useForm({
    day: null,
    position: null,
    week_number: null,
    subject_id: null,
})

function store() {
    formStore.day = props.position[0]
    formStore.position = props.position[1]
    formStore.post(route('template-lessons.store'),{
        preserveScroll: true,
    })
    formStore.reset()
}

</script>
