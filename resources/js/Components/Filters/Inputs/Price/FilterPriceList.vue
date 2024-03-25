<template>
    <div class="flex">
        <Menu
            as="div"
            class="relative w-56"
        >
            <MenuButton
                class="w-full h-full text-left px-6"
            >
                {{ useLang('base.filter.price') }}
            </MenuButton>
            <MenuItems class="absolute w-full bg-white border-x-[1px] border-b-[1px] border-gray-100">
                <FilterPriceItem
                    v-for="(price, key) in prices"
                    :key="key"
                    :price="price"
                />
            </MenuItems>
        </Menu>
    </div>
</template>

<script setup lang="ts">
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import useLang from "../../../../Composables/useLang";
import FilterPriceItem from "@/Components/Filter/Inputs/Price/FilterPriceItem.vue";
import type { FilterPrice } from "@/types";

const props = defineProps<{
    prices: FilterPrice[]
}>()
</script>

<style scoped>

</style>
