<template>
    <FilterRange
        class="w-[450px] min-w-[450px]"
        :label="label"
        @click="isOpen = !isOpen"
    >
        <FilterRangeList
            :is-open="isOpen"
            :label="priceLabel"
            :min="parseInt(filterStore.filterPriceRangeComponentDTO.minDefaultItem.value)"
            :max="parseInt(filterStore.filterPriceRangeComponentDTO.maxDefaultItem.value)"
            :current-min="parseInt(filterStore.minPrice.value)"
            :current-max="parseInt(filterStore.maxPrice.value)"
            :items="filterStore.filterPriceRangeComponentDTO.items"
            :graph="filterStore.filterPriceRangeComponentDTO.graph"
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
const label = computed(() => useTrans(`base.filter.${filterStore.dealType?.value}_price`))

const priceLabel = computed(() => {
    const currentMin = parseInt(filterStore.minPrice.value)
    const currentMax = parseInt(filterStore.maxPrice.value)
    const title = useTrans(`base.filter.prices.between`) as string
    return title
        .replace(
            ':from',
            new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(currentMin)
        )
        .replace(
            ':to',
            new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(currentMax)
        )
})

const handleUpdateValues = (values: [FilterItemDTO, FilterItemDTO]) => {
    filterStore.setPrices(values)
}
</script>

<style scoped>

</style>
