<template>
    <!-- @update:modelValue="(dealType: FilterDealType) => filterStore.setDealType(dealType)" -->
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
                <FilterPriceRange @click.stop />

                <ListboxOption
                    class="filter-options-item"
                    v-for="(price, key) in filterStore.filterComponent.prices"
                    :key="key"
                    :value="price"
                >
                    {{ price.name }}
                </ListboxOption>
            </ListboxOptions>
        </div>
    </Listbox>
</template>

<script setup lang="ts">
import { useFilterStore } from "@/Stores/useFilterStore";
import { Listbox, ListboxButton, ListboxOption, ListboxOptions } from "@headlessui/vue";
import type { FilterDealType } from "@/types";
import { computed } from "vue";
import useLang from "@/Composables/useLang";
import FilterPriceRange from "@/Components/Filters/Price/FilterPriceRange.vue";

const filterStore = useFilterStore()
const props = defineProps<{
    isOpen: boolean
}>()
</script>

<style scoped>

</style>
