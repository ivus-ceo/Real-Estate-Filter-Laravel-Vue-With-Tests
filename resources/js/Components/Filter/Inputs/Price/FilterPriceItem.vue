<template>
    <MenuItem
        as="div"
        class="bg-transparent border-t-[1px] border-gray-100 p-4 cursor-pointer"
        :class="{ '!bg-gray-100': filterStore.isPrice(price.value) }"
        @click.prevent="filterStore.setPrice(price.value)"
    >
        {{ price.name }}
    </MenuItem>
</template>

<script setup lang="ts">
import { MenuItem } from "@headlessui/vue";
import type { FilterPrice } from "@/types";
import { useFilterStore } from "@/Stores/useFilterStore";

const props = defineProps<{
    price: FilterPrice
}>()

const filterStore = useFilterStore()
</script>

<style scoped>

</style>
