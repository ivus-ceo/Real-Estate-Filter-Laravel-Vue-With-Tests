<template>
    <div class="filter-list-container">
        <small class="filter-list-label">
            {{ label }}
        </small>

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
