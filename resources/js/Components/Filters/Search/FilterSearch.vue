<template>
    <Popover
        class="relative w-full filter-list-container"
        @click="isOpen = !isOpen"
    >
        <PopoverButton class="filter-list-label text-left pointer-events-none">
            Search
        </PopoverButton>

        <input class="filter-list-value h-full p-0 border-none">

        <div
            v-if="isOpen"
            class="absolute top-[calc(100%+0.75rem)] left-0 z-10 w-full"
        >
            <PopoverPanel
                class="filter-list-container"
                static
            >
                <div class="flex">
                    <div v-for="i in 5">
                        {{ i }}
                    </div>
                </div>
            </PopoverPanel>
        </div>
    </Popover>
</template>

<script setup lang="ts">
import { Popover, PopoverButton, PopoverPanel } from "@headlessui/vue";
import { ref } from "vue";

const isOpen = ref(false)
</script>

<style scoped>

</style>
