<template>
    <Popover
        class="relative w-full filter-list-container"
        @click="handleSearchClick"
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
            v-model="searchValue"
        >

        <div
            v-show="isOpen"
            class="absolute top-[calc(100%+0.75rem)] left-0 z-10 w-full"
        >
            <PopoverPanel
                class="filter-list-container"
                static
                @click.stop
            >
                <div class="flex">
                    <div
                        v-for="(item, i) in filterStore.searchComponentDTO.items"
                        :key="i"
                    >
                        {{ item.name }}

                        <FilterTagList
                            :tags="item.list"
                        />
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
import { watchDebounced } from '@vueuse/core'
import { useFilterStore } from "@/Stores/useFilterStore";
import FilterTagList from "@/Components/Filters/Tags/FilterTagList.vue";

const props = defineProps<{
    label: string
}>()

const emit = defineEmits<{
    (event: 'update-value', value: boolean): void
}>()

const filterStore = useFilterStore()
const searchInput = ref<HTMLInputElement>()
const searchValue = ref<string>('')
const isOpen = ref(false)

watch(isOpen, () => {
    if (isOpen.value) {
        searchInput.value?.focus()
    }
})

watchDebounced(
    searchValue,
    () => {
        filterStore.setSearch({
            name: useTrans('base.filter.search_placeholder'),
            value: searchValue.value
        })
    },
    { debounce: 500, maxWait: 1000 }
)

const handleSearchClick = () => {
    searchInput.value?.focus()
}
</script>

<style scoped>

</style>
