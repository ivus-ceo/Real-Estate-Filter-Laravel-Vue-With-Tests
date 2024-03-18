<template>
    <div class="flex w-[14%] border-r-[1px] border-gray-100">
        <FilterDealTypeItem
            v-for="(dealType, key) in dealTypes"
            :key="key"
            :deal-type="dealType"
            :is-selected="dealType.value === currentDealType"
            @update:modelValue="handleDealTypeChange"
        />
    </div>
</template>

<script setup lang="ts">
import type { FilterDealType } from "@/types";
import FilterDealTypeItem from "@/Components/Filter/Inputs/DealType/FilterDealTypeItem.vue";

const props = defineProps<{
    dealTypes: FilterDealType[],
    currentDealType: string
}>()

const emit = defineEmits(['update:modelValue'])

const handleDealTypeChange = (dealType: string) => {
    emit('update:modelValue', dealType)
}
</script>

<style scoped>

</style>
