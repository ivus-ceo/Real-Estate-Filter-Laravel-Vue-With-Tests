<template>
    <div class="flex flex-wrap">
        <FilterTagItem
            v-for="(tag, key) in tags"
            :key="key"
            :tag="tag"
        />
    </div>
</template>

<script setup lang="ts">
import FilterItemDTO = App.DTOs.Filters.Items.FilterItemDTO;
import FilterTagItem from "@/Components/Filters/Tags/FilterTagItem.vue";

const props = defineProps<{
    tags: FilterItemDTO[]
}>()
</script>

<style scoped>

</style>
