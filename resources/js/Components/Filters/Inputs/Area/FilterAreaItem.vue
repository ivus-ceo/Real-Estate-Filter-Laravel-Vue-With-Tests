<template>
    <MenuItem
        as="div"
        class="bg-transparent border-t-[1px] border-gray-100 p-4 cursor-pointer"
        :class="{ '!bg-gray-100': filterStore.isArea(area.value) }"
        @click.prevent="filterStore.setArea(area.value)"
    >
        {{ area.name }}
    </MenuItem>
</template>

<script setup lang="ts">
import { MenuItem } from "@headlessui/vue";
import type { FilterArea } from "@/types";
import { useFilterStore } from "@/Stores/useFilterStore";

const props = defineProps<{
    area: FilterArea
}>()

const filterStore = useFilterStore()
</script>

<style scoped>

</style>
