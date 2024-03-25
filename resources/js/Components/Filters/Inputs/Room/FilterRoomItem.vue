<template>
    <div class="flex flex-1">
        <input
            class="hidden"
            :id="id"
            :value="room.value"
            type="checkbox"
            name="rooms"
            multiple
            @change="filterStore.setRooms(room.value)"
        >

        <label
            class="cursor-pointer w-14 h-full aspect-square flex items-center justify-center"
            :class="{ 'bg-gray-100': filterStore.hasRoom(room.value) }"
            :for="id"
        >
            {{ room.name }}
        </label>
    </div>
</template>

<script setup lang="ts">
import type { FilterRoom } from "@/types";
import useInputId from "@/Composables/Filter/useInputId";
import { useFilterStore } from "@/Stores/useFilterStore";

const props = defineProps<{
    room: FilterRoom
}>()

const id = useInputId(props.room.value)
const filterStore = useFilterStore()
</script>

<style scoped>

</style>
