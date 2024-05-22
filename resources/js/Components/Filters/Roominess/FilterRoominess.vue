<template>
    <FilterDropdown
        :label="useTrans('base.filter.roominess')"
        @click="isOpen = !isOpen"
    >
        <FilterDropdownList
            :is-open="isOpen"
            :multiple="true"
            :label="label"
            :items="filterStore.filterRoominessDropdownComponentDTO.items"
            @update-value="handleUpdateValue"
        />
    </FilterDropdown>
</template>

<script setup lang="ts">
import { computed, ref } from "vue";
import FilterDropdown from "@/Components/Filters/Dropdowns/FilterDropdown.vue";
import FilterDropdownList from "@/Components/Filters/Dropdowns/FilterDropdownList.vue";
import { useFilterStore } from "@/Stores/useFilterStore";
import FilterItemDTO = App.DTOs.Filters.Items.FilterItemDTO;
import useTrans from "@/Composables/Common/useTrans";

const isOpen = ref(false)
const filterStore = useFilterStore()
const label = computed(() => {
    return filterStore.roominess
        .map((item: FilterItemDTO) => (item.value === '' && filterStore.roominess.length > 1) ? '' : item.name)
        .filter((name: string) => name !== '')
        .sort()
        .join(', ')
})

const handleUpdateValue = (items: FilterItemDTO | FilterItemDTO[]): void => {
    if (Array.isArray(items))
        filterStore.setRoominess(items)
}
</script>

<style scoped>

</style>
