<template>
    <form
        class="flex"
        @submit.prevent
    >
<!--        <FilterDealTypeList-->
<!--            :deal-type="form.deal_type"-->
<!--            v-model="form.deal_type"-->
<!--        />-->
<!--        <FilterRoomList-->
<!--            :rooms="form.rooms"-->
<!--            v-model="form.rooms"-->
<!--        />-->
        {{ form }}
    </form>
</template>

<script setup lang="ts">
import { useForm, usePage } from "@inertiajs/vue3";
import FilterDealTypeList from "@/Components/Filter/FilterDealTypeList.vue";
import FilterRoomList from "@/Components/Filter/FilterRoomList.vue";
import { watch } from "vue";
import { FilterComponent } from "@/types";

const props = defineProps<{
    url: string
}>()

const form = useForm({
    deal_type: 'sale',
    rooms: [],
})

const page = usePage()
const filterComponent = page.props['filter_component'] as FilterComponent

// watch(
//     () => form.deal_type,
//     (value: string) => {
//         form.get(props.url)
//     }
// )
</script>

<style scoped>

</style>
