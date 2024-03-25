<template>
    <Page
        title="Real Estate Filter 🏠"
        description="Search for properties based on various criteria such as location, price range, amenities, and more."
    >
        <Filter
            :url="route('api.filter.rooms')"
        />
    </Page>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import PublicLayout from "@/Layouts/PublicLayout.vue";
import Page from "@/Components/Pages/Page.vue";
import Filter from "@/Components/Filters/Filter.vue";

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
}>();

defineOptions({
    layout: PublicLayout
})
</script>

<style scoped>

</style>
