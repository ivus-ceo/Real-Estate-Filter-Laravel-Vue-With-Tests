<template>
    <div class="flex">
        <FilterRoomItem
            v-for="(room, key) in rooms"
            :key="key"
            :room="room"
        />
    </div>
</template>

<script setup lang="ts">
import type { FilterRoom } from "@/types";
import FilterRoomItem from "@/Components/Filter/Inputs/Room/FilterRoomItem.vue";

const props = defineProps<{
    rooms: FilterRoom[]
}>()
</script>

<style scoped>

</style>
