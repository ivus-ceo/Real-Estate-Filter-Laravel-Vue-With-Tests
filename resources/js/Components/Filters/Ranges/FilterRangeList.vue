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
                    @click="emit('update-values', [item.minValue, item.maxValue])"
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
import type { FilterInputDTO, FilterRangeDTO, FilterRangeGraph as FilterRangeGraphType } from "@/types";

const emit = defineEmits<{
    (event: 'update-values', values: [FilterInputDTO, FilterInputDTO]): void
}>()

const props = defineProps<{
    isOpen: boolean
    label: string
    items: FilterRangeDTO[]
    min: number,
    max: number,
    currentMin: number,
    currentMax: number,
    graph: FilterRangeGraphType
}>()
</script>

<style scoped>

</style>
