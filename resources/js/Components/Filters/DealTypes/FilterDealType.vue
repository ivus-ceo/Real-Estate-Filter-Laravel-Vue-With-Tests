<template>
    <FilterDropdown
        :label="useLang('base.filter.deal')"
        @click="isOpen = !isOpen"
    >
        <FilterDropdownList
            :is-open="isOpen"
            :label="filterStore.dealType.name"
            :items="filterStore.dealTypeDropdownComponentDTO.items"
            @update-value="handleUpdateValue"
        />
    </FilterDropdown>
</template>

<script setup lang="ts">
import { ref } from "vue";
import useLang from "@/Composables/useLang";
import FilterDropdown from "@/Components/Filters/Dropdowns/FilterDropdown.vue";
import FilterDropdownList from "@/Components/Filters/Dropdowns/FilterDropdownList.vue";
import { useFilterStore } from "@/Stores/useFilterStore";
import type { FilterInputDTO } from "@/types";

const isOpen = ref(false)
const filterStore = useFilterStore()

const handleUpdateValue = (item: FilterInputDTO) => {
    filterStore.setDealType(item)
}
</script>

<style scoped>

</style>
