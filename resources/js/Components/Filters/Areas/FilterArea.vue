<template>
    <FilterRange
        class="w-[250px] min-w-[250px]"
        :label="useTrans(`base.filter.area`)"
        @click="isOpen = !isOpen"
    >
        <FilterRangeList
            :is-open="isOpen"
            :label="label"
            :min="parseInt(filterStore.filterAreaRangeComponentDTO.minDefaultItem.value)"
            :max="parseInt(filterStore.filterAreaRangeComponentDTO.maxDefaultItem.value)"
            :current-min="parseInt(filterStore.minArea.value)"
            :current-max="parseInt(filterStore.maxArea.value)"
            :items="filterStore.filterAreaRangeComponentDTO.items"
            :graph="filterStore.filterAreaRangeComponentDTO.graph"
            @update-values="handleUpdateValues"
        />
    </FilterRange>
</template>

<script setup lang="ts">
import { computed, ref } from "vue";
import { useFilterStore } from "@/Stores/useFilterStore";
import FilterRange from "@/Components/Filters/Ranges/FilterRange.vue";
import FilterRangeList from "@/Components/Filters/Ranges/FilterRangeList.vue";
import useTrans from "@/Composables/Common/useTrans";
import FilterItemDTO = App.DTOs.Filters.Items.FilterItemDTO;

const isOpen = ref(false)
const filterStore = useFilterStore()

const label = computed(() => {
    const currentMin = Number(filterStore.minArea.value)
    const currentMax = Number(filterStore.maxArea.value)
    const title = useTrans(`base.filter.areas.between`) as string
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

const handleUpdateValues = (values: [FilterItemDTO, FilterItemDTO]) => {
    filterStore.setAreas(values)
}
</script>

<style scoped>

</style>
