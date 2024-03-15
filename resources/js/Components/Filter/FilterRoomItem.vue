<template>
    <div class="flex select-none">
        <input
            :id="`filter-${room}`"
            :value="room"
            type="checkbox"
            name="rooms"
            class="hidden"
            multiple
            @input="emit('update:modelValue', ($event.target as HTMLInputElement).value)"
        >

        <label
            :for="`filter-${room}`"
            :class="{ 'bg-red-400': isSelected }"
            class="cursor-pointer"
        >
            {{ room }}
        </label>
    </div>
</template>

<script setup lang="ts">
import useLang from "@/Composables/useLang";

const props = defineProps<{
    room: string
    isSelected: boolean
}>()

const emit = defineEmits(['update:modelValue'])
</script>

<style scoped>

</style>
