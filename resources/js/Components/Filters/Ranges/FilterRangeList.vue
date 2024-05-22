<template>
    <Listbox as="div">
        <ListboxButton class="filter-list-value">
            {{ label }}
        </ListboxButton>

        <div class="flex flex-col">
            <ListboxOptions
                v-show="isOpen"
                class="filter-options-list"
                static
            >
                <FilterRangeGraph
                    :current-min="currentMin"
                    :current-max="currentMax"
                    :graph="graph"
                    @click.stop
                />

                <FilterRangeSlider
                    :min="min"
                    :max="max"
                    :current-min="currentMin"
                    :current-max="currentMax"
                    @click.stop
                    @update-values="emit('update-values', $event)"
                />

                <ListboxOption
                    class="filter-options-item"
                    v-for="(item, key) in items"
                    :key="key"
                    :value="item"
                    @click="emit('update-values', [item.minItem, item.maxItem])"
                >
                    {{ item.name }}
                </ListboxOption>
            </ListboxOptions>
        </div>
    </Listbox>
</template>

<script setup lang="ts">
import { Listbox, ListboxButton, ListboxOption, ListboxOptions } from "@headlessui/vue";
import FilterRangeGraph from "@/Components/Filters/Ranges/FilterRangeGraph.vue";
import FilterRangeSlider from "@/Components/Filters/Ranges/FilterRangeSlider.vue";
import FilterItemDTO = App.DTOs.Filters.Items.FilterItemDTO;
import BaseRangeGraphComponentDTO = App.DTOs.Components.Filters.Ranges.Graphs.BaseRangeGraphComponentDTO;
import FilterRangeDTO = App.DTOs.Filters.Items.FilterRangeDTO;

const emit = defineEmits<{
    (event: 'update-values', values: [FilterItemDTO, FilterItemDTO]): void
}>()

const props = defineProps<{
    isOpen: boolean
    label: string
    min: number,
    max: number,
    currentMin: number,
    currentMax: number,
    items: FilterRangeDTO[]
    graph: BaseRangeGraphComponentDTO
}>()
</script>

<style scoped>

</style>
