<template>
    <div class="filter-list-container">
        <div class="filter-list-label">
            {{ label }}
        </div>

        <slot/>
    </div>
</template>

<script setup lang="ts">
const props = defineProps<{
    label: string
}>()
</script>

<style scoped>

</style>
