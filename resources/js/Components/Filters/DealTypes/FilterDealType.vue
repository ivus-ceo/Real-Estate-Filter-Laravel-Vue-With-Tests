<template>
    <FilterDropdown
        :label="useTrans('base.filter.deal')"
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
import FilterDropdown from "@/Components/Filters/Dropdowns/FilterDropdown.vue";
import FilterDropdownList from "@/Components/Filters/Dropdowns/FilterDropdownList.vue";
import { useFilterStore } from "@/Stores/useFilterStore";
import FilterItem = App.DTOs.Filters.Items.FilterItem;
import useTrans from "@/Composables/Common/useTrans";

const isOpen = ref(false)
const filterStore = useFilterStore()

const handleUpdateValue = (item: FilterItem | FilterItem[]) => {
    if (!Array.isArray(item))
        filterStore.setDealType(item as FilterItem)
}
</script>

<style scoped>

</style>
