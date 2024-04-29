<template>
    <FilterRange
        class="w-[250px]"
        :label="useLang(`base.filter.area`)"
        @click="isOpen = !isOpen"
    >
        <FilterRangeList
            :is-open="isOpen"
            :label="label"
            :min="areaRangeComponent.minDefaultItem.value"
            :max="areaRangeComponent.maxDefaultItem.value"
            :current-min="filterStore.minArea.value"
            :current-max="filterStore.maxArea.value"
            :items="areaRangeComponent.items"
            :graph="areaRangeComponent.graph"
            @update-values="handleUpdateValues"
        />
    </FilterRange>
</template>

<script setup lang="ts">
import useLang from "@/Composables/useLang";
import { computed, ref } from "vue";
import { useFilterStore } from "@/Stores/useFilterStore";
import FilterRange from "@/Components/Filters/Ranges/FilterRange.vue";
import FilterRangeList from "@/Components/Filters/Ranges/FilterRangeList.vue";
import { FilterInputDTO } from "@/types";

const isOpen = ref(false)
const filterStore = useFilterStore()
const areaRangeComponent = filterStore.areaRangeComponent

const label = computed(() => {
    const currentMin = Number(filterStore.minArea.value)
    const currentMax = Number(filterStore.maxArea.value)
    const title = useLang(`base.filter.areas.between`) as string
    return title
        .replace(
            ':from',
            new Intl.NumberFormat('en-US').format(currentMin)
        )
        .replace(
            ':to',
            new Intl.NumberFormat('en-US').format(currentMax)
        )
})

const handleUpdateValues = (values: [FilterInputDTO, FilterInputDTO]) => {
    filterStore.setAreas(values)
}
</script>

<style scoped>

</style>
