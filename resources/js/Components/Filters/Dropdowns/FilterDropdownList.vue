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
import type { FilterInputDTO } from "@/types";
import { ref } from "vue";

const emit = defineEmits<{
    (event: 'update-value', value: FilterInputDTO | FilterInputDTO[]): void
}>()

const props = withDefaults(
    defineProps<{
        isOpen: boolean
        label: string
        items: FilterInputDTO[]
        multiple?: boolean
    }>(),
    {
        multiple: false
    }
)

const selectedItems = ref<FilterInputDTO[]>([])

const handleAnyMultipleOptionClick = (item: FilterInputDTO): void => {
    selectedItems.value = [item]
    emit('update-value', selectedItems.value)
}

const handleMultipleOptionClick = (item: FilterInputDTO): void => {
    // Remove any roominess if something was selected
    selectedItems.value = selectedItems.value.filter((room: FilterInputDTO) => {
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
