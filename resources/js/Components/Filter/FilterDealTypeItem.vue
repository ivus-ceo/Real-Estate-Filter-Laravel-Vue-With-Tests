<template>
    <div class="relative select-none">
        <input
            :id="`filter-${dealType}`"
            :value="dealType"
            type="radio"
            name="deal_type"
            class="hidden"
            @input="emit('update:modelValue', ($event.target as HTMLInputElement).value)"
        >

        <label
            :for="`filter-${dealType}`"
            :class="{ 'bg-red-400': isSelected }"
            class="cursor-pointer"
        >
            {{ useLang(`base.deal_types.${dealType}`) }}
        </label>
    </div>
</template>

<script setup lang="ts">
import useLang from "@/Composables/useLang";

const props = defineProps<{
    dealType: string
    isSelected: boolean
}>()

const emit = defineEmits(['update:modelValue'])
</script>

<style scoped>

</style>
