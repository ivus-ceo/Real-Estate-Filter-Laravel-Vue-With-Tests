<template>
    <div class="flex flex-1">
        <input
            class="hidden"
            :id="id"
            :value="dealType.value"
            type="radio"
            name="deal_type"
            @change="filterStore.setDealType(dealType.value)"
        >

        <label
            class="cursor-pointer w-full h-full flex items-center justify-center"
            :class="{ 'bg-gray-100': filterStore.isDealType(dealType.value) }"
            :for="id"
        >
            {{ dealType.name }}
        </label>
    </div>
</template>

<script setup lang="ts">
import type { FilterDealType } from "@/types";
import useInputId from "@/Composables/Filter/useInputId";
import { useFilterStore } from "@/Stores/useFilterStore";

const props = defineProps<{
    dealType: FilterDealType
}>()

const id = useInputId(props.dealType.value)
const filterStore = useFilterStore()
</script>

<style scoped>

</style>
