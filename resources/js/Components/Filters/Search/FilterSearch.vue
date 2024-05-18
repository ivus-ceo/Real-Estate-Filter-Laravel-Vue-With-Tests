<template>
    <Popover
        class="relative w-full filter-list-container"
        @click="handlePopoverClick"
    >
        <PopoverButton class="filter-list-label text-left pointer-events-none">
            {{ useTrans('base.filter.search') }}
        </PopoverButton>

        <input
            class="filter-list-value h-full p-0 border-none placeholder-black"
            ref="search"
            :placeholder="useTrans('base.filter.search_placeholder')"
            @click.stop.prevent
            @focusin="isOpen = true"
            @focusout="isOpen = false"
        >

        <div
            v-show="isOpen"
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
import useTrans from "@/Composables/Common/useTrans";
import { ref, watch } from "vue";

const props = defineProps<{
    label: string
}>()

const emit = defineEmits<{
    (event: 'update-value', value: boolean): void
}>()

const search = ref<HTMLInputElement>()
const isOpen = ref(false)

watch(isOpen, () => {
    if (isOpen.value) {
        search.value?.focus()
    }
})

const handlePopoverClick = () => {
    search.value?.focus()
}
</script>

<style scoped>

</style>
