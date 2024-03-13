<template>
    <form
        @submit.prevent="form.post(route('api.filter.rooms'))"
        :action="route('api.filter.rooms')"
    >
        <FilterDealTypes/>
    </form>
</template>

<script setup lang="ts">
import FilterDealTypes from "@/Components/Filter/FilterDealTypes.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    deal_type: [],
})
</script>

<style scoped>

</style>
