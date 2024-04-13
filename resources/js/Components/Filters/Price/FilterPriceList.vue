<template>
    <Listbox as="div">
        <ListboxButton class="filter-list-value">
            {{ filterStore.price!.name }}
        </ListboxButton>

        <div class="flex flex-col">
            <ListboxOptions
                v-if="isOpen"
                class="filter-options-list"
                static
            >
                <FilterPriceRange @click.stop/>

                <ListboxOption
                    class="filter-options-item"
                    :class="{ 'bg-gray-100': isSelected(item) }"
                    v-for="(item, key) in filterStore.priceRangeComponent.items"
                    :key="key"
                    :value="item"
                    @click="handlePriceClick(item)"
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
import { computed } from "vue";
import useLang from "@/Composables/useLang";
import FilterPriceRange from "@/Components/Filters/Price/FilterPriceRange.vue";

const filterStore = useFilterStore()
const priceRangeComponent = filterStore.priceRangeComponent

const props = defineProps<{
    isOpen: boolean
}>()

const handlePriceClick = (item: FilterRangeDTO) => {
    filterStore.setPrice(item)
}

const isSelected = (item: FilterRangeDTO): boolean => {
    return item.maxValue === filterStore.price.maxValue && item.minValue === filterStore.price.minValue
}
</script>

<style scoped>

</style>
