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
                v-for="(room, key) in filterStore.filterComponent.roominess"
                :key="key"
                :value="room"
                @click.prevent="handleRoominessClick(room)"
            >
                {{ room.name }}
            </ListboxOption>
        </ListboxOptions>
    </Listbox>
</template>

<script setup lang="ts">
import useLang from "@/Composables/useLang";
import { Listbox, ListboxButton, ListboxOption, ListboxOptions } from "@headlessui/vue";
import { useFilterStore } from "@/Stores/useFilterStore";
import type { FilterRoom } from "@/types";
import { computed, ref } from "vue";

const filterStore = useFilterStore()
const props = defineProps<{
    isOpen: boolean
}>()

const rooms = ref<FilterRoom[]>([filterStore.filterComponent.defaultRoominess])
const label = computed(() => {
    return filterStore.roominess
        .map((room: FilterRoom) => (room.value === '' && filterStore.roominess.length > 1) ? '' : room.name)
        .filter((name: string) => name !== '')
        .sort()
        .join(', ')
})

const handleRoominessClick = (room: FilterRoom): void => {
    const withoutAnyRoom = rooms.value.filter((room: FilterRoom) => room.value !== 'any')
    const withAnyRoom = rooms.value.filter((room: FilterRoom) => room.value === 'any')

    if (rooms.value.length === 0) { // If it has no roominess, add any roominess
        rooms.value = Object.values(filterStore.filterComponent.roominess).filter((room: FilterRoom) => room.value === 'any')
    } else if (room.value !== 'any') { // If it has any and was clicked explicit roominess, remove any roominess
        rooms.value = withoutAnyRoom
        filterStore.setRoominess(withoutAnyRoom)
    } else if (room.value === 'any') { // If it doesn't have any and was clicked any roominess, remove explicit roominess
        rooms.value = withAnyRoom
        filterStore.setRoominess(withAnyRoom)
    }
}
</script>

<style scoped>

</style>
