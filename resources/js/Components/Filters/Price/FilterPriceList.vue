<template>
    <Listbox as="div">
        <ListboxButton class="filter-list-value">
            {{ filterStore.minPrice.value }}
            -
            {{ filterStore.maxPrice.value }}
        </ListboxButton>

        <div class="flex flex-col">
            <ListboxOptions
                v-show="isOpen"
                class="filter-options-list"
                static
            >
<!--                <Range-->
<!--                    class="mx-6 my-4"-->
<!--                    :min="priceRangeComponent.default.minValue"-->
<!--                    :max="priceRangeComponent.default.maxValue"-->
<!--                    :current-min="filterStore.price.minValue"-->
<!--                    :current-max="filterStore.price.maxValue"-->
<!--                    :graph="priceRangeComponent.graph"-->
<!--                    reset-event="filter:resetPrice"-->
<!--                    update-event="filter:updatePrice"-->
<!--                />-->

                <ListboxOption
                    class="filter-options-item"
                    v-for="(item, key) in filterStore.priceRangeComponent.items"
                    :key="key"
                    :value="item"
                >
                    {{ item.name }}
                </ListboxOption>
            </ListboxOptions>
        </div>
    </Listbox>
</template>

<script setup lang="ts">
import { useFilterStore } from "@/Stores/useFilterStore";
import { Listbox, ListboxButton, ListboxOption, ListboxOptions } from "@headlessui/vue";
import type { FilterRangeDTO } from "@/types";
import useLang from "@/Composables/useLang";
import Range from "@/Components/Filters/Partials/Ranges/Range.vue";
import { ref } from "vue";
import useEmitter from "@/Composables/Common/useEmitter";

const props = defineProps<{
    isOpen: boolean
}>()

const filterStore = useFilterStore()
const priceRangeComponent = filterStore.priceRangeComponent

// const handlePriceClick = (item: FilterRangeDTO) => {
//     filterStore.setPrices([item.minValue, item.maxValue])
// }
//
// useEmitter.on('filter:updatePrice', (prices) => {
//     filterStore.setPrices(getPrice(prices[0], prices[1]))
// })
//
// const isSelected = (item: FilterRangeDTO): boolean => {
//     return item.maxValue === filterStore.price.maxValue && item.minValue === filterStore.price.minValue
// }
//
// const getPrice = (min: number, max: number): FilterRangeDTO => {
//     const name = useLang('base.filter.prices.between') as string;
//     return {
//         name: name
//             .replace(':from', new Intl.NumberFormat('en-US').format(min))
//             .replace(':to', new Intl.NumberFormat('en-US').format(max)),
//         minValue: min,
//         maxValue: max
//     }
// }
</script>

<style scoped>

</style>
