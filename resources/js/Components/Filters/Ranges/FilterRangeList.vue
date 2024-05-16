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
import FilterItem = App.DTOs.Filters.Items.FilterItem;
import BaseRangeGraphComponent = App.DTOs.Components.Filters.Ranges.Graphs.BaseRangeGraphComponent;
import FilterRange = App.DTOs.Filters.Items.FilterRange;

const emit = defineEmits<{
    (event: 'update-values', values: [FilterItem, FilterItem]): void
}>()

const props = defineProps<{
    isOpen: boolean
    label: string
    min: number,
    max: number,
    currentMin: number,
    currentMax: number,
    items: FilterRange[]
    graph: BaseRangeGraphComponent
}>()
</script>

<style scoped>

</style>
