<template>
    <div class="flex h-24 items-end px-6 mt-3">
        <div
            v-for="(number, range) in graph.ranges"
            class="w-full bg-black border-r-[1px] border-white"
            :class="{ 'bg-gray-100': !isColumnInRange(range) }"
            :style="`height: ${getHeight(number)}`"
        ></div>
    </div>
</template>

<script setup lang="ts">
import BaseRangeGraphComponent = App.DTOs.Components.Filters.Ranges.Graphs.BaseRangeGraphComponent;

const props = defineProps<{
    currentMin: number,
    currentMax: number,
    graph: BaseRangeGraphComponent
}>()

const max = Math.max(...Object.values(props.graph.ranges))

const isColumnInRange = (range: string): boolean => {
    const rangeNumbers = range.split(':')
    return parseInt(rangeNumbers[0]) >= props.currentMin && parseInt(rangeNumbers[1]) <= props.currentMax
}

const getHeight = (number: number): string => {
    return `${(number / max) * 100}%`
}
</script>

<style scoped>

</style>
