<template>
    <Listbox
        as="div"
        @update:modelValue="(dealType: FilterInputDTO) => filterStore.setDealType(dealType)"
    >
        <ListboxButton class="filter-list-value">
            {{ filterStore.dealType.name }}
        </ListboxButton>
        <ListboxOptions
            v-show="isOpen"
            class="filter-options-list"
            static
        >
            <ListboxOption
                class="filter-options-item"
                :class="{ 'bg-gray-100': filterStore.dealType.value === item.value }"
                v-for="(item, key) in filterStore.dealTypeDropdownComponentDTO.items"
                :key="key"
                :value="item"
            >
                {{ item.name }}
            </ListboxOption>
        </ListboxOptions>
    </Listbox>
</template>

<script setup lang="ts">
import { useFilterStore } from "@/Stores/useFilterStore";
import { Listbox, ListboxButton, ListboxOption, ListboxOptions } from "@headlessui/vue";
import type { FilterInputDTO } from "@/types";

const filterStore = useFilterStore()
const props = defineProps<{
    isOpen: boolean
}>()
</script>

<style scoped>

</style>
