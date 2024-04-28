<template>
    <div class="flex h-24 items-end gap-1 px-6 mt-3">
        <div
            v-for="(item, range) in 21"
            class="w-full h-full bg-black"
        ></div>
    </div>
</template>

<script setup lang="ts">
//:class="{ 'bg-gray-100': !isColumnInRange(range) }"
// :style="`height: ${height(item)}`"

// const isColumnInRange = (range: string): boolean => {
//     const splitted = range.split(':')
//     return Number(splitted[0]) >= props.currentMin && Number(splitted[1]) <= props.currentMax
// }

// const height = (number: number): string => {
//     return `${number / props.graph.max * 100}%`
// }
</script>

<style scoped>

</style>
