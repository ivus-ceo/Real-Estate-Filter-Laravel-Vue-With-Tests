<template>
    <Listbox as="div">
        <ListboxButton class="filter-list-value">
            {{ value }}
        </ListboxButton>

        <div class="flex flex-col">
            <ListboxOptions
                v-show="isOpen"
                class="filter-options-list"
                static
            >
                <!--                <Range-->
                <!--                    class="mx-6 my-4"-->
                <!--                    :min="priceRangeComponent.default.minValue"-->
                <!--                    :max="priceRangeComponent.default.maxValue"-->
                <!--                    :current-min="filterStore.price.minValue"-->
                <!--                    :current-max="filterStore.price.maxValue"-->
                <!--                    :graph="priceRangeComponent.graph"-->
                <!--                    reset-event="filter:resetPrice"-->
                <!--                    update-event="filter:updatePrice"-->
                <!--                />-->

                <ListboxOption
                    class="filter-options-item"
                    v-for="(item, key) in items"
                    :key="key"
                    :value="item"
                    @click="emit('update-values', item)"
                >
                    {{ item.name }}
                </ListboxOption>
            </ListboxOptions>
        </div>
    </Listbox>
</template>

<script setup lang="ts">
import { Listbox, ListboxButton, ListboxOption, ListboxOptions } from "@headlessui/vue";
import type { FilterRangeDTO } from "@/types";

const emit = defineEmits<{
    (e: 'update-values', item: FilterRangeDTO): void
    // (e: 'update-min-value', value: string): void
    // (e: 'update-max-value', value: string): void
}>()

const props = defineProps<{
    isOpen: boolean
    value: string
    items: FilterRangeDTO[]
}>()
</script>

<style scoped>

</style>
