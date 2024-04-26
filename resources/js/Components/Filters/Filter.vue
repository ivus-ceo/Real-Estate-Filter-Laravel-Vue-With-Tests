<template>
    <div class="flex flex-col">
        <form
            class="flex gap-3 select-none"
            @submit.prevent
        >
            <FilterDealType/>
            <FilterRoominess/>
<!--            <FilterPrice/>-->
        </form>

        <div class="flex items-center justify-end">
            <div
                class="cursor-pointer"
                @click="filterStore.reset"
            >
                Reset
            </div>

            <div>
                Sorting
            </div>

            <div class="flex">
                <img src="/icons/filter/list-view.svg" alt="List">
                <img src="/icons/filter/grid-view.svg" alt="Grid">
                <img src="/icons/filter/map-view.svg" alt="Map" @click="emitter.emit('filter:resetPrice')">
            </div>
        </div>

<!--        <div class="flex h-14 bg-gray-100">-->
<!--            Tags-->
<!--        </div>-->

<!--        <div class="flex h-14 bg-gray-100">-->
<!--            Count object-->
<!--        </div>-->
    </div>
</template>

<script setup lang="ts">
import { useForm, usePage } from "@inertiajs/vue3";
import { useFilterStore } from "@/Stores/useFilterStore";
import FilterDealType from "@/Components/Filters/DealTypes/FilterDealType.vue";
import FilterRoominess from "@/Components/Filters/Roominess/FilterRoominess.vue";
import FilterPrice from "@/Components/Filters/Price/FilterPrice.vue";

const props = defineProps<{
    url: string
}>()

const filterStore = useFilterStore()
const form = useForm({
    // deal_type: filterStore.dealType,
    // rooms: filterStore.rooms,
    // price: filterStore.price,
    // area: filterStore.area,
})
</script>

<style scoped>

</style>
