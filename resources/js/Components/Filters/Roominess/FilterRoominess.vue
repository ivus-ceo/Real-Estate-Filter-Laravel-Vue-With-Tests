<template>
    <div
        class="filter-list-container"
        @click.stop="isOpen = !isOpen"
    >
        <div class="filter-list-label">
            {{ useLang('base.filter.roominess') }}
        </div>

        <FilterRoominessList
            :is-open="isOpen"
        />
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import useLang from "@/Composables/useLang";
import FilterRoominessList from "@/Components/Filters/Roominess/FilterRoominessList.vue";

const isOpen = ref(false)
</script>

<style scoped>

</style>
