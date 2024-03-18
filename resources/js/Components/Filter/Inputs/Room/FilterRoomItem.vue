<template>
    <div class="flex flex-1">
        <input
            class="hidden"
            :id="id"
            :value="room.value"
            type="checkbox"
            name="rooms"
            multiple
            @change="emit('update:modelValue', ($event.target as HTMLInputElement).value)"
        >

        <label
            class="cursor-pointer w-full h-full aspect-square flex items-center justify-center"
            :class="{ 'bg-gray-100': isSelected }"
            :for="id"
        >
            {{ room.name }}
        </label>
    </div>
</template>

<script setup lang="ts">
import type { FilterRoom } from "@/types";
import useInputId from "@/Composables/Filter/useInputId";

const props = defineProps<{
    room: FilterRoom
    isSelected: boolean
}>()

const emit = defineEmits(['update:modelValue'])
const id = useInputId(props.room.value)
</script>

<style scoped>

</style>
