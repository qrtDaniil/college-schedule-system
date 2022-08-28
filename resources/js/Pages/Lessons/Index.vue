<template>

    <Head>
        <title>Календарь занятий</title>
        <meta name="description" content="Календарь занятий">
    </Head>

    <div class="flex">
        <Sidebar/>
        <div class="flex-1 flex flex-col overflow-hidden p-4">
            <div>
                <h1 class="text-2xl whitespace-nowrap font-semibold pb-2">Календарь занятий</h1>
            </div>
        </div>
    </div>
</template>

<script setup>
import Sidebar from '@/Shared/Sidebar.vue';</script>

