<template>
    <FilterRange
        :label="label"
        @click="isOpen = !isOpen"
    >
        <FilterRangeList
            :is-open="isOpen"
            :value="filterStore.minPrice.value + ' - ' + filterStore.maxPrice.value"
            :items="filterStore.priceRangeComponent.items"
            @update-values="handleUpdateValues"
        />
    </FilterRange>
</template>

<script setup lang="ts">
import useLang from "@/Composables/useLang";
import { computed, ref } from "vue";
import { useFilterStore } from "@/Stores/useFilterStore";
import useEmitter from "@/Composables/Common/useEmitter";
import FilterRange from "@/Components/Filters/Ranges/FilterRange.vue";
import FilterRangeList from "@/Components/Filters/Ranges/FilterRangeList.vue";
import { FilterRangeDTO, FilterRangeUpdateEvents } from "@/types";

const isOpen = ref(false)
const filterStore = useFilterStore()
const label = computed(() => useLang(`base.filter.${filterStore.dealType?.value}_price`))

const handleUpdateValues = (item: FilterRangeDTO) => {
    filterStore.setPrices([item.minValue, item.maxValue])
}
</script>

<style scoped>

</style>
