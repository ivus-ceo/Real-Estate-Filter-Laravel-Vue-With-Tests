<template>
    <div
        class="filter-list-container"
        @click.stop="isOpen = !isOpen"
    >
        <div class="filter-list-label">
            {{ label }}
        </div>

        <FilterPriceList
            :is-open="isOpen"
        />
    </div>
</template>

<script setup lang="ts">
import useLang from "@/Composables/useLang";
import FilterPriceList from "@/Components/Filters/Price/FilterPriceList.vue";
import { computed, ref } from "vue";
import { useFilterStore } from "@/Stores/useFilterStore";

const isOpen = ref(false)
const filterStore = useFilterStore()

const label = computed(() => {
    return useLang(`base.filter.${filterStore.dealType?.value}_price`)
})
</script>

<style scoped>

</style>
