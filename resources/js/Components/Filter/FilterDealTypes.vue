<template>
    <div class="flex">
        <div
            v-for="(dealType, key) in dealTypes"
            :key="key"
        >
            <input
                :id="`filter-${dealType}`"
                type="checkbox"
                name="deal_type"
            >
            <label
                :for="`filter-${dealType}`"
            >
                {{ useLang(`base.deal_types.${dealType}`) }}
            </label>
        </div>
    </div>
</template>

<script setup lang="ts">
import { usePage } from "@inertiajs/vue3";
import useLang from "@/Composables/useLang";

const page = usePage()
const dealTypes = page.props['filter_component']['deal_types']
</script>

<style scoped>

</style>
