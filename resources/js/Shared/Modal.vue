<template>
    <Teleport to="body">
        <Transition enter-active-class="transition duration-250" enter-from-class="opacity-0"
                    leave-active-class="transition duration-150" leave-to-class="opacity-0">
            <div class="flex items-center fixed w-full h-full top-0 left-0 z-50" v-show="open">
                <div class="absolute w-full h-full bg-gray-800/50" @click="$emit('close')"></div>
                <div class="m-auto max-w-4xl bg-white rounded shadow-lg z-50">
                    <div class="px-6 py-4">
                        <slot />
                    </div>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>

<script setup>
defineProps({
    open: {
        type: Boolean,
        required: true,
    }
})

defineEmits(['close'])
</script>
