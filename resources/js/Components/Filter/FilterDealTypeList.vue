<template>
    <div class="flex">
        <FilterDealTypeItem
            v-for="(dealType, key) in filterComponent.deal_types"
            :key="key"
            :deal-type="dealType"
            :is-selected="dealType === props.dealType"
            @update:modelValue="(value: string) => { emit('update:modelValue', value) }"
        />
    </div>
</template>

<script setup lang="ts">
import { usePage } from "@inertiajs/vue3";
import FilterDealTypeItem from "@/Components/Filter/FilterDealTypeItem.vue";
import { FilterComponent } from "@/types";

const props = defineProps<{
    dealType: string
}>()

const emit = defineEmits(['update:modelValue'])

const page = usePage()
const filterComponent = page.props['filter_component'] as FilterComponent
</script>

<style scoped>

</style>
