<template>
    <FilterDropdown
        :label="useLang('base.filter.deal')"
        @click="isOpen = !isOpen"
    >
        <FilterDropdownList
            :is-open="isOpen"
            :multiple="true"
            :label="label"
            :items="filterStore.roominessDropdownComponent.items"
            @update-value="handleUpdateValue"
        />
    </FilterDropdown>
</template>

<script setup lang="ts">
import { computed, ref } from "vue";
import useLang from "@/Composables/useLang";
import FilterDropdown from "@/Components/Filters/Dropdowns/FilterDropdown.vue";
import FilterDropdownList from "@/Components/Filters/Dropdowns/FilterDropdownList.vue";
import { useFilterStore } from "@/Stores/useFilterStore";
import type { FilterInputDTO } from "@/types";

const isOpen = ref(false)
const filterStore = useFilterStore()
const label = computed(() => {
    return filterStore.roominess
        .map((item: FilterInputDTO) => (item.value === '' && filterStore.roominess.length > 1) ? '' : item.name)
        .filter((name: string) => name !== '')
        .sort()
        .join(', ')
})

const handleUpdateValue = (items: FilterInputDTO[]): void => {
    items.map((item: FilterInputDTO) => {
        console.log(item.name)
    })

    filterStore.setRoominess(items)
}

const isSelected = (item: FilterInputDTO): boolean => {
    const roominess = filterStore.roominess
    return roominess.filter((room: FilterInputDTO) => {
        return room.value === item.value
    }).length > 0
}
</script>

<style scoped>

</style>
