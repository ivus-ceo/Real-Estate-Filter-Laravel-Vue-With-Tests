<template>
    <div
        class="filter-list-container"
        @click.stop="isOpen = !isOpen"
    >
        <div class="filter-list-label">
            {{ useLang('base.filter.deal') }}
        </div>

        <FilterDealTypeList
            :is-open="isOpen"
        />
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import useLang from "@/Composables/useLang";
import FilterDealTypeList from "@/Components/Filters/DealTypes/FilterDealTypeList.vue";

const isOpen = ref(false)
</script>

<style scoped>

</style>
