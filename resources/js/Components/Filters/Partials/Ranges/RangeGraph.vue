<template>
    <div class="flex h-24 items-end gap-1">
        <div
            v-for="(item, range) in graph.items"
            class="w-full bg-black"
            :class="{ 'bg-gray-100': !isColumnInRange(range) }"
            :style="`height: ${height(item)}`"
        ></div>
    </div>
</template>

<script setup lang="ts">
import type { FilterRangeGraphDTO } from "@/types";

const props = defineProps<{
    graph: FilterRangeGraphDTO
    currentMin: number
    currentMax: number
}>()

const isColumnInRange = (range: string): boolean => {
    const splitted = range.split(':')
    return Number(splitted[0]) >= props.currentMin && Number(splitted[1]) <= props.currentMax
}

const height = (number: number): string => {
    return `${number / props.graph.max * 100}%`
}
</script>

<style scoped>

</style>
