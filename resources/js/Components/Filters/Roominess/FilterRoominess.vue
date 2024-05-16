<template>
    <FilterDropdown
        :label="useTrans('base.filter.roominess')"
        @click="isOpen = !isOpen"
    >
        <FilterDropdownList
            :is-open="isOpen"
            :multiple="true"
            :label="label"
            :items="filterStore.roominessDropdownComponentDTO.items"
            @update-value="handleUpdateValue"
        />
    </FilterDropdown>
</template>

<script setup lang="ts">
import { computed, ref } from "vue";
import FilterDropdown from "@/Components/Filters/Dropdowns/FilterDropdown.vue";
import FilterDropdownList from "@/Components/Filters/Dropdowns/FilterDropdownList.vue";
import { useFilterStore } from "@/Stores/useFilterStore";
import FilterItem = App.DTOs.Filters.Items.FilterItem;
import useTrans from "@/Composables/Common/useTrans";

const isOpen = ref(false)
const filterStore = useFilterStore()
const label = computed(() => {
    return filterStore.roominess
        .map((item: FilterItem) => (item.value === '' && filterStore.roominess.length > 1) ? '' : item.name)
        .filter((name: string) => name !== '')
        .sort()
        .join(', ')
})

const handleUpdateValue = (items: FilterItem | FilterItem[]): void => {
    if (Array.isArray(items))
        filterStore.setRoominess(items)
}

const isSelected = (item: FilterItem): boolean => {
    const roominess = filterStore.roominess
    return roominess.filter((room: FilterItem) => {
        return room.value === item.value
    }).length > 0
}
</script>

<style scoped>

</style>
