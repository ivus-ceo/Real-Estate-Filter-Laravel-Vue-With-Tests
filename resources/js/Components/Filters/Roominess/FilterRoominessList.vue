<template>
    <Listbox
        as="div"
        multiple
        v-model="rooms"
        @update:modelValue="filterStore.setRooms(rooms)"
    >
        <ListboxButton class="filter-list-value">
            {{ label }}
        </ListboxButton>
        <ListboxOptions
            v-if="isOpen"
            class="absolute top-[100%] left-0 w-full"
            static
        >
            <ListboxOption
                v-for="(room, key) in filterStore.filterComponent.roominess"
                :key="key"
                :value="room"
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

// const test = (room: FilterRoom) => {
//     console.log(rooms)
//     // (room: FilterRoom) => filterStore.setRooms(room)
// }
const rooms = ref<FilterRoom[]>([])
const label = computed(() => {
    return filterStore.rooms
        .map((room: FilterRoom) => (room.value === '' && filterStore.rooms.length > 1) ? '' : room.name)
        .filter((name: string) => name !== '')
        .sort()
        .join(', ')
})
</script>

<style scoped>

</style>
