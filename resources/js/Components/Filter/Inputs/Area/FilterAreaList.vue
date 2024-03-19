<template>
    <div class="flex">
        <Menu
            as="div"
            class="relative w-56"
        >
            <MenuButton
                class="w-full h-full text-left px-6 border-x-[1px] border-gray-100"
            >
                {{ useLang('base.filter.area') }}
            </MenuButton>
            <MenuItems class="absolute w-full bg-white border-x-[1px] border-b-[1px] border-gray-100">
                <FilterAreaItem
                    v-for="(area, key) in areas"
                    :key="key"
                    :area="area"
                />
            </MenuItems>
        </Menu>
    </div>
</template>

<script setup lang="ts">
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import FilterAreaItem from "@/Components/Filter/Inputs/Area/FilterAreaItem.vue";
import type { FilterArea } from "@/types";
import useLang from "../../../../Composables/useLang";

const props = defineProps<{
    areas: FilterArea[]
}>()
</script>

<style scoped>

</style>
