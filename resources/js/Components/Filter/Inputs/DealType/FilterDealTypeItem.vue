<template>
    <div class="flex flex-1">
        <input
            class="hidden"
            :id="id"
            :value="dealType.value"
            type="radio"
            name="deal_type"
            @change="emit('update:modelValue', ($event.target as HTMLInputElement).value)"
        >

        <label
            class="cursor-pointer w-full h-full flex items-center justify-center"
            :class="{ 'bg-gray-100': isSelected }"
            :for="id"
        >
            {{ dealType.name }}
        </label>
    </div>
</template>

<script setup lang="ts">
import type { FilterDealType } from "@/types";
import useInputId from "@/Composables/Filter/useInputId";

const props = defineProps<{
    dealType: FilterDealType,
    isSelected: boolean
}>()

const emit = defineEmits(['update:modelValue'])
const id = useInputId(props.dealType.value)
</script>

<style scoped>

</style>
