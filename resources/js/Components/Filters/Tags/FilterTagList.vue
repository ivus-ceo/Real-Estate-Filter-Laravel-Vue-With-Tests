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
import FilterItem = App.DTOs.Filters.Items.FilterItem;
import FilterTagItem from "@/Components/Filters/Tags/FilterTagItem.vue";

const props = defineProps<{
    tags: FilterItem[]
}>()
</script>

<style scoped>

</style>
