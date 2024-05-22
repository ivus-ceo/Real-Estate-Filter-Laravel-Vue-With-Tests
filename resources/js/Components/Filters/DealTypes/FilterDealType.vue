<template>
    <FilterDropdown
        :label="useTrans('base.filter.deal')"
        @click="isOpen = !isOpen"
    >
        <FilterDropdownList
            :is-open="isOpen"
            :label="filterStore.dealType.name"
            :items="filterStore.filterDealTypeDropdownComponentDTO.items"
            @update-value="handleUpdateValue"
        />
    </FilterDropdown>
</template>

<script setup lang="ts">
import { ref } from "vue";
import FilterDropdown from "@/Components/Filters/Dropdowns/FilterDropdown.vue";
import FilterDropdownList from "@/Components/Filters/Dropdowns/FilterDropdownList.vue";
import { useFilterStore } from "@/Stores/useFilterStore";
import FilterItemDTO = App.DTOs.Filters.Items.FilterItemDTO;
import useTrans from "@/Composables/Common/useTrans";

const isOpen = ref(false)
const filterStore = useFilterStore()

const handleUpdateValue = (item: FilterItemDTO | FilterItemDTO[]) => {
    if (!Array.isArray(item))
        filterStore.setDealType(item as FilterItemDTO)
}
</script>

<style scoped>

</style>
