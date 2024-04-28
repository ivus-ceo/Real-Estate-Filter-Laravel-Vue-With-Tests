<template>
    <div class="flex h-24 items-end gap-1 px-6 mt-3">
        <div
            v-for="(number, range) in graph"
            class="w-full bg-black"
            :class="{ 'bg-gray-100': !isColumnInRange(range) }"
            :style="`height: ${getHeight(number)}`"
        ></div>
    </div>
</template>

<script setup lang="ts">
import { FilterRangeGraph } from "@/types";

const props = defineProps<{
    currentMin: number,
    currentMax: number,
    graph: FilterRangeGraph
}>()

const max = Math.max(...Object.values(props.graph).map((item) => item))

const isColumnInRange = (range: string): boolean => {
    const rangeNumbers = range.split(':')
    const minRangeNumber = Number(rangeNumbers[0])
    const maxRangeNumber = Number(rangeNumbers[1])
    return minRangeNumber >= props.currentMin && maxRangeNumber <= props.currentMax
}

const getHeight = (number: number): string => {
    return `${(number / max) * 100}%`
}
</script>

<style scoped>

</style>
