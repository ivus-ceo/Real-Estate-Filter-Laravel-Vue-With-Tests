<template>
    <div class="relative" @click.stop>
        <RangeGraph :graph="graph"/>
        <RangeSlider
            :min="min"
            :max="max"
            :current-min="currentMin"
            :current-max="currentMax"
            @update="$emit('update', $event)"
        />
        <RangeInputs
            :min="min"
            :max="max"
            :current-min="currentMin"
            :current-max="currentMax"
            @update="$emit('update', $event)"
        />
    </div>
</template>

<script setup lang="ts">
import type { FilterRangeGraphDTO } from "@/types";
import RangeGraph from "@/Components/Filters/Partials/Ranges/RangeGraph.vue";
import RangeSlider from "@/Components/Filters/Partials/Ranges/RangeSlider.vue";
import RangeInputs from "@/Components/Filters/Partials/Ranges/RangeInputs.vue";

const props = defineProps<{
    min: number
    max: number
    currentMin: number
    currentMax: number
    graph: FilterRangeGraphDTO
}>()
</script>

<style scoped>

</style>
