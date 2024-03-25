<template>
<!--    <form-->
<!--        class="flex h-14 border-[1px] border-gray-100 select-none"-->
<!--        @submit.prevent-->
<!--    >-->
<!--        <FilterDealTypeList-->
<!--            :deal-types="filterComponent.deal_types"-->
<!--        />-->

<!--        <FilterRoomList-->
<!--            :rooms="filterComponent.rooms"-->
<!--        />-->

<!--        <FilterPriceList-->
<!--            :prices="filterComponent.prices"-->
<!--        />-->

<!--        <FilterAreaList-->
<!--            :areas="filterComponent.areas"-->
<!--        />-->

<!--        <FilterSearch-->
<!--        />-->

<!--        <pre>-->
<!--            <span>Deal: {{ filterStore.dealType }}</span>-->
<!--            <span>Roominess: {{ filterStore.rooms }}</span>-->
<!--            <span>Price: {{ filterStore.price }}</span>-->
<!--            <span>Area: {{ filterStore.area }}</span>-->
<!--        </pre>-->
<!--    </form>-->
</template>

<script setup lang="ts">
// import { watch } from "vue";
// import { useForm, usePage } from "@inertiajs/vue3";
// import { useFilterStore } from "@/Stores/useFilterStore";
// import FilterDealTypeList from "@/Components/Filter/Inputs/DealType/FilterDealTypeList.vue";
// import FilterRoomList from "@/Components/Filter/Inputs/Room/FilterRoomList.vue";
// import FilterPriceList from "@/Components/Filter/Inputs/Price/FilterPriceList.vue";
// import FilterAreaList from "@/Components/Filter/Inputs/Area/FilterAreaList.vue";
// import type { FilterComponent } from "@/types";
// import FilterSearch from "@/Components/Filter/Inputs/Search/FilterSearch.vue";
//
// const props = defineProps<{
//     url: string
// }>()
//
// const page = usePage()
// const filterStore = useFilterStore()
// const filterComponent = page.props['filter_component'] as FilterComponent
// const form = useForm({
//     deal_type: filterStore.dealType,
//     rooms: filterStore.rooms,
//     price: filterStore.price,
//     area: filterStore.area,
// })
</script>

<style scoped>

</style>
