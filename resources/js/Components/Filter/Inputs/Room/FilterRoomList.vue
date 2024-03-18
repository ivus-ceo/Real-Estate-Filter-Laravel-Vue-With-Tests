<template>
    <div class="flex">
        <FilterRoomItem
            v-for="(room, key) in rooms"
            :key="key"
            :room="room"
            :is-selected="hasRoom(room.value)"
            @update:modelValue="handleRoomChange"
        />
    </div>
</template>

<script setup lang="ts">
import type { FilterRoom } from "@/types";
import FilterRoomItem from "@/Components/Filter/Inputs/Room/FilterRoomItem.vue";
import { ref } from "vue";

const props = defineProps<{
    rooms: FilterRoom[]
    currentRooms: Array<string>
}>()

const emit = defineEmits(['update:modelValue'])

const handleRoomChange = (room: string) => {
    const index = props.currentRooms.indexOf(room);
    const rooms = (hasRoom(room)) ?
        props.currentRooms.splice(index, 1) :
        [...props.currentRooms, room]

    emit('update:modelValue', rooms)
}

const hasRoom = (room: string): boolean => {
    return props.currentRooms.includes(room);
}
</script>

<style scoped>

</style>
