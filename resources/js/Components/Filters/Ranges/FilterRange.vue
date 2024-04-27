<template>
    <FilterInputContainer :label="label">
        <slot/>
    </FilterInputContainer>
</template>

<script setup lang="ts">
import FilterInputContainer from "@/Components/Filters/Inputs/FilterInputContainer.vue";

const props = defineProps<{
    label: string
}>()
</script>

<style scoped>

</style>
