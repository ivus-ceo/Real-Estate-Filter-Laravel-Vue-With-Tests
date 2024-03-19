<template>
    <div class="flex w-[14%] border-r-[1px] border-gray-100">
        <FilterDealTypeItem
            v-for="(dealType, key) in dealTypes"
            :key="key"
            :deal-type="dealType"
        />
    </div>
</template>

<script setup lang="ts">
import type { FilterDealType } from "@/types";
import FilterDealTypeItem from "@/Components/Filter/Inputs/DealType/FilterDealTypeItem.vue";

const props = defineProps<{
    dealTypes: FilterDealType[]
}>()
</script>

<style scoped>

</style>
