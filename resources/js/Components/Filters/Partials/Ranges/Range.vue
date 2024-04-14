<template>
    <div class="relative" @click.stop>
        <RangeGraph
            :graph="graph"
            :current-min="currentMin"
            :current-max="currentMax"
        />
        <RangeSlider
            :min="min"
            :max="max"
            :current-min="currentMin"
            :current-max="currentMax"
            :reset-event="resetEvent"
            :update-event="updateEvent"
        />
        <RangeInputs
            :min="min"
            :max="max"
            :current-min="currentMin"
            :current-max="currentMax"
            :reset-event="resetEvent"
            :update-event="updateEvent"
        />
    </div>
</template>

<script setup lang="ts">
import type { FilterEvents, FilterRangeGraphDTO } from "@/types";
import RangeGraph from "@/Components/Filters/Partials/Ranges/RangeGraph.vue";
import RangeSlider from "@/Components/Filters/Partials/Ranges/RangeSlider.vue";
import RangeInputs from "@/Components/Filters/Partials/Ranges/RangeInputs.vue";

const props = defineProps<{
    min: number
    max: number
    currentMin: number
    currentMax: number
    graph: FilterRangeGraphDTO
    resetEvent: keyof FilterEvents
    updateEvent: keyof FilterEvents
}>()
</script>

<style scoped>

</style>
