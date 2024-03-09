<template>
    <div class="relative">
        <Head
            :title="title"
            :description="description"
        />

        <slot/>
    </div>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    title: string
    description: string
}>()
</script>

<style scoped>

</style>
