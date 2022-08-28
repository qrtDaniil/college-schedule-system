<template>
    <div class="flex flex-col w-56 min-h-screen h-auto p-2 bg-white border-r border-gray-400">
        <h2 class="text-xl font-semibold text-gray-800">Панель управления расписанием</h2>

        <hr class="mt-4 border-gray-400"/>

        <nav>
            <Link :class="{'bg-gray-200' : $page.url.startsWith('/admin-lessons')}"
                  :href="route('admin-lessons.index')"
                  as="button"
                  class="flex items-center w-full p-2 mt-4 duration-200 border-l-4 border-gray-900
            text-gray-800 hover:bg-gray-400 hover:bg-opacity-25 hover:text-gray-900">
                <span class="mx-2 font-semibold">Календарь занятий</span></Link>

            <Link :class="{'bg-gray-200' : $page.url.startsWith('/template-lessons')}"
                  :href="route('template-lessons.index')"
                  as="button"
                  class="flex items-center w-full p-2 mt-4 duration-200 border-l-4 border-gray-900
            text-gray-800 hover:bg-gray-400 hover:bg-opacity-25 hover:text-gray-900">
                <span class="mx-2 font-semibold">Расписание</span></Link>

            <Link :class="{'bg-gray-200' : $page.url.startsWith('/subjects')}"
                  :href="route('subjects.index')"
                  as="button" class="flex items-center w-full p-2 mt-4 duration-200 border-l-4 border-gray-900
            text-gray-800 hover:bg-gray-400 hover:bg-opacity-25 hover:text-gray-900">
                <span class="mx-2 font-semibold">Назгрузка</span></Link>

            <Link as="button"
                  class="flex items-center w-full p-2 mt-4 duration-200 border-l-4 border-gray-900
            text-blue-600 hover:bg-gray-400 hover:bg-opacity-25 hover:text-blue-700" href="/">
                <span class="mx-2 font-semibold">Главная страница</span></Link>
        </nav>

    </div>
</template>

<script>

</script>
