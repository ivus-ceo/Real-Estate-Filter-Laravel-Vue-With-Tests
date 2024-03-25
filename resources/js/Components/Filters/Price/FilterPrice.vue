<template>
    <div
        class="filter-list-container"
    >
        <div class="filter-list-label">
            {{ useLang('base.filter.price') }}
        </div>

        <FilterPriceRange/>
    </div>
</template>

<script setup lang="ts">
import useLang from "@/Composables/useLang";
import FilterPriceRange from "@/Components/Filters/Price/FilterPriceRange.vue";
</script>

<style scoped>

</style>
