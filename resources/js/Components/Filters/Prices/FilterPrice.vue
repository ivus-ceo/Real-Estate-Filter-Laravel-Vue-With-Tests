<template>
    <FilterRange
        class="w-[400px] min-w-[400px]"
        :label="label"
        @click="isOpen = !isOpen"
    >
        <FilterRangeList
            :is-open="isOpen"
            :label="priceLabel"
            :min="priceRangeComponent.minDefaultItem.value"
            :max="priceRangeComponent.maxDefaultItem.value"
            :current-min="filterStore.minPrice.value"
            :current-max="filterStore.maxPrice.value"
            :items="priceRangeComponent.items"
            :graph="priceRangeComponent.graph"
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
const priceRangeComponent = filterStore.priceRangeComponent
const label = computed(() => useLang(`base.filter.${filterStore.dealType?.value}_price`))

const priceLabel = computed(() => {
    const currentMin = Number(filterStore.minPrice.value)
    const currentMax = Number(filterStore.maxPrice.value)
    const title = useLang(`base.filter.prices.between`) as string
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

const handleUpdateValues = (values: [FilterInputDTO, FilterInputDTO]) => {
    filterStore.setPrices(values)
}
</script>

<style scoped>

</style>
