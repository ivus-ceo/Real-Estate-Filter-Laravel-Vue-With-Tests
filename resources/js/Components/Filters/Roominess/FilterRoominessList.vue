<template>
    <Listbox
        as="div"
        multiple
        v-model="rooms"
    >
        <ListboxButton class="filter-list-value">
            {{ label }}
        </ListboxButton>
        <ListboxOptions
            v-if="isOpen"
            class="filter-options-list"
            static
        >
            <ListboxOption
                class="filter-options-item"
                v-for="(item, key) in filterStore.roominessDropdownComponent.items"
                :key="key"
                :value="item"
                @click.prevent="handleRoominessClick(item)"
            >
                {{ item.name }}
            </ListboxOption>
        </ListboxOptions>
    </Listbox>
</template>

<script setup lang="ts">
import useLang from "@/Composables/useLang";
import { Listbox, ListboxButton, ListboxOption, ListboxOptions } from "@headlessui/vue";
import { useFilterStore } from "@/Stores/useFilterStore";
import { computed, ref } from "vue";
import type { FilterInputDTO } from "@/types";

const filterStore = useFilterStore()
const props = defineProps<{
    isOpen: boolean
}>()

const rooms = ref<FilterInputDTO[]>([filterStore.roominessDropdownComponent.default])
const label = computed(() => {
    return filterStore.roominess
        .map((item: FilterInputDTO) => (item.value === '' && filterStore.roominess.length > 1) ? '' : item.name)
        .filter((name: string) => name !== '')
        .sort()
        .join(', ')
})

const handleRoominessClick = (item: FilterInputDTO): void => {
    const withoutAnyRoom = rooms.value.filter((item: FilterInputDTO) => item.value !== 'any')
    const withAnyRoom = rooms.value.filter((item: FilterInputDTO) => item.value === 'any')

    if (rooms.value.length === 0) { // If it has no roominess, add any roominess
        rooms.value = Object.values(filterStore.roominessDropdownComponent.items).filter((item: FilterInputDTO) => item.value === 'any')
    } else if (item.value !== 'any') { // If it has any and was clicked explicit roominess, remove any roominess
        rooms.value = withoutAnyRoom
        filterStore.setRoominess(withoutAnyRoom)
    } else if (item.value === 'any') { // If it doesn't have any and was clicked any roominess, remove explicit roominess
        rooms.value = withAnyRoom
        filterStore.setRoominess(withAnyRoom)
    }
}
</script>

<style scoped>

</style>
