<template>
    <div class="flex">
        <FilterRoomItem
            v-for="(room, key) in filterComponent.rooms"
            :key="key"
            :room="room"
            :is-selected="props.rooms.includes(room)"
            @update:modelValue="(value) => { emit('update:modelValue', value) }"
        />
    </div>
</template>

<script setup lang="ts">
import FilterRoomItem from "@/Components/Filter/FilterRoomItem.vue";
import { usePage } from "@inertiajs/vue3";
import { FilterComponent } from "@/types";

const props = defineProps<{
    rooms: Array<string>
}>()

const emit = defineEmits(['update:modelValue'])

const page = usePage()
const filterComponent = page.props['filter_component'] as FilterComponent
</script>

<style scoped>

</style>
