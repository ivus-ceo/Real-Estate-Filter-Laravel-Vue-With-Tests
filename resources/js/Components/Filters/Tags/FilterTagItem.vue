<template>
    <div class="relative h-8">
        <input
            class="input absolute opacity-0 h-0 w-0"
            type="checkbox"
            :id="uuid"
            :value="tag.value"
        >

        <label
            class="h-full px-2 flex items-center cursor-pointer bg-gray-100 border border-gray-300 rounded"
            :for="uuid"
        >
            {{ tag.name }}
        </label>
    </div>
</template>

<script setup lang="ts">
import FilterItemDTO = App.DTOs.Filters.Items.FilterItemDTO;
import { v4 as uuidv4 } from 'uuid';

const props = defineProps<{
    tag: FilterItemDTO
}>()

const uuid = uuidv4();
</script>

<style scoped lang="postcss">
.input:checked ~ label {
    @apply bg-gray-300
}
</style>
