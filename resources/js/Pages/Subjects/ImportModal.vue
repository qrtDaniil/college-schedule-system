<template>
    <Modal>
        <form enctype="multipart/form-data" @submit.prevent="store">
            <div class="flex items-center justify-between pb-3">
                <p class="text-2xl font-bold">Импорт файла нагрузки в базу данных</p>
                <div class="z-50 cursor-pointer modal-close" @click="$emit('close')">
                    <svg class="text-black fill-current" height="18" viewBox="0 0 18 18" width="18" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <p>Для заполнения базы данных информацией о учебном плане необходимо загрузить в систему
                    Excel файл предварительно выбрав его с помощью кнопки
                    <span class="font-semibold"> "ВЫБРАТЬ ФАЙЛ ДЛЯ ЗАГРУЗКИ" </span>
                    и после нажать на кнопку
                    <span class="font-semibold"> "Ипортировать файл"</span>.

                    <br><br>

                    В загружаемом Excel файле первые <span class="font-semibold">7</span> солбцов должны
                    содержать
                    следующие данные соответвенно:
                    <span class="font-semibold">
                        "Группа*",
                        "Индекс учебной дисциплины",
                        "Наименование учебной дисциплины*",
                        "Преподователь",
                        "Кол-во часов в 1 п/г",
                        "Кол-во часов во 2 п/г",
                        "Номер учебной аудитории".
                    </span>

                    Столбцы отмеченные символом <span class="font-semibold">"*"</span> при чтении строк
                    должны обязательно иметь какие либо данные внутри. В столбцах
                    <span class="font-semibold">"Кол-во часов в 1 п/г"</span> и
                    <span class="font-semibold">"Кол-во часов во 2 п/г"</span> пустые ячейки автоматически
                    будут заполнены нулями.

                    <br><br>

                    Первую строку файла система не читает, там может находится например обозначение
                    столбцов, далее
                    система читает все остальные не пустые строки и заносит данные из них в базу данных.
                    Преписку "Доп. договор" удалять не надо, система сама отформатирует этот текст и студенты не будут видеть его.

                    <br><br>
                    Пример файла для загрузки:
                </p>
                <img class="w-5/6 h-5/6" src="images/Example.png"/>
            </div>
            <div class="flex justify-between pt-3">
                <div class="pt-2">
                    <label
                        :class="formImport.file ? 'bg-blue-700 text-white' : 'bg-white hover:bg-blue-700 hover:text-white hover:border-blue-700'"
                        class="px-12 p-2 border border-black rounded uppercase font-semibold cursor-pointer duration-150">
                        <span v-if="formImport.file">Файл для загрузки был выбран</span>
                        <span v-else>Выбрать файл для загрузки</span>
                        <input id="file" accept=".xls" class="hidden" name="file" type="file"
                               @input="formImport.file = $event.target.files[0]">
                    </label>
                </div>
                <div>
                    <button
                        class="px-4 p-2 mr-3 border border-black rounded font-semibold hover:text-white hover:font-semibold hover:bg-gray-800 duration-150"
                        type="button" @click="$emit('close')">
                        Закрыть
                    </button>
                    <button class="px-4 p-2 border bg-gray-800 text-white rounded font-semibold hover:border hover:border-black hover:text-black hover:font-semibold hover:bg-white 1"
                        type="submit" @click="$emit('close')" :disabled="formImport.processing">
                        Импортировать файл
                    </button>
                </div>
            </div>
        </form>
    </Modal>
</template>

<script setup>
import {useForm} from "@inertiajs/inertia-vue3";
import Modal from "@/Shared/Modal.vue"

let formImport = useForm({
    file: null,
})
let store = () => {
    formImport.post('subjects/import');
}
</script>
