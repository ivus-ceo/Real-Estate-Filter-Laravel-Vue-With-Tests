<template>
    <Listbox
        as="div"
        @update:modelValue="(dealType: FilterDealType) => filterStore.setDealType(dealType)"
    >
        <ListboxButton class="filter-list-value">
            {{ filterStore!.dealType!.name }}
        </ListboxButton>
        <ListboxOptions
            v-if="isOpen"
            class="filter-options-list"
            static
        >
            <ListboxOption
                class="filter-options-item"
                v-for="(dealType, key) in filterStore.filterComponent.dealTypes"
                :key="key"
                :value="dealType"
            >
                {{ dealType.name }}
            </ListboxOption>
        </ListboxOptions>
    </Listbox>
</template>

<script setup lang="ts">
import { useFilterStore } from "@/Stores/useFilterStore";
import { Listbox, ListboxButton, ListboxOption, ListboxOptions } from "@headlessui/vue";
import type { FilterDealType } from "@/types";

const filterStore = useFilterStore()
const props = defineProps<{
    isOpen: boolean
}>()
</script>

<style scoped>

</style>
