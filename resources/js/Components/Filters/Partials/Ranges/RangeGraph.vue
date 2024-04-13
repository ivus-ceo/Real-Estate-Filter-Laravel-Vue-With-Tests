<template>
    <div class="flex h-24 items-end gap-1">
        <div
            v-for="item in graph.items"
            class="w-full bg-black"
            :style="`height: ${height(item)}`"
        ></div>
    </div>
</template>

<script setup lang="ts">
import type { FilterRangeGraphDTO } from "@/types";

const props = defineProps<{
    graph: FilterRangeGraphDTO
}>()

const height = (number: number): string => {
    return `${number / props.graph.max * 100}%`
}
</script>

<style scoped>

</style>
