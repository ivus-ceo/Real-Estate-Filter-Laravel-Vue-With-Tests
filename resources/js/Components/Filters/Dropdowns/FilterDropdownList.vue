<template>
    <Listbox
        as="div"
        :multiple="multiple"
        v-model="selectedItems"
    >
        <ListboxButton class="filter-list-value">
            {{ label }}
        </ListboxButton>

        <div class="flex flex-col">
            <ListboxOptions
                v-show="isOpen"
                class="filter-options-list"
                static
            >
                <ListboxOption
                    class="filter-options-item"
                    v-if="multiple"
                    v-for="(item, key) in items"
                    :key="key"
                    :id="item.value"
                    :value="item"
                    @click="item.value === 'any' ? handleAnyMultipleOptionClick(item) : handleMultipleOptionClick(item)"
                >
                    {{ item.name }}
                </ListboxOption>

                <ListboxOption
                    class="filter-options-item"
                    v-if="!multiple"
                    v-for="(item, key) in items"
                    :id="item.value"
                    :key="key"
                    :value="item"
                    @click="emit('update-value', selectedItems)"
                >
                    {{ item.name }}
                </ListboxOption>
            </ListboxOptions>
        </div>
    </Listbox>
</template>

<script setup lang="ts">
import { Listbox, ListboxButton, ListboxOption, ListboxOptions } from "@headlessui/vue";
import { ref } from "vue";
import FilterItem = App.DTOs.Filters.Items.FilterItem;

const emit = defineEmits<{
    (event: 'update-value', value: FilterItem | FilterItem[]): void
}>()

const props = withDefaults(
    defineProps<{
        isOpen: boolean
        label: string
        items: Record<string, FilterItem>
        multiple?: boolean
    }>(),
    {
        multiple: false
    }
)

const selectedItems = ref<FilterItem[]>([])

const handleAnyMultipleOptionClick = (item: FilterItem): void => {
    selectedItems.value = [item]
    emit('update-value', selectedItems.value)
}

const handleMultipleOptionClick = (item: FilterItem): void => {
    // Remove any roominess if something was selected
    selectedItems.value = selectedItems.value.filter((room: FilterItem) => {
        return room.value !== 'any'
    })

    // If nothing is selected, select any
    if (selectedItems.value.length === 0) {
        const anyOption = document.querySelector('.filter-options-item[id="any"]') as HTMLLIElement
        anyOption.click()
        return
    }

    emit('update-value', selectedItems.value)
}
</script>

<style scoped>

</style>
