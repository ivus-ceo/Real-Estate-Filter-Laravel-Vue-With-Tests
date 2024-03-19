<template>
<!--    <TabGroup>-->
<!--        <TabList>-->
<!--            <Tab>Tab 1</Tab>-->
<!--            <Tab>Tab 2</Tab>-->
<!--            <Tab>Tab 3</Tab>-->
<!--        </TabList>-->
<!--        <TabPanels>-->
<!--            <TabPanel>Content 1</TabPanel>-->
<!--            <TabPanel>Content 2</TabPanel>-->
<!--            <TabPanel>Content 3</TabPanel>-->
<!--        </TabPanels>-->
<!--    </TabGroup>-->


<!--    <form-->
<!--        class="flex h-14 bg-blue-500 select-none"-->
<!--        @submit.prevent-->
<!--    >-->
<!--        &lt;!&ndash; BEGIN DEALS &ndash;&gt;-->
<!--        <div class="flex">-->

<!--        </div>-->
<!--        &lt;!&ndash; END DEALS &ndash;&gt;-->

<!--        &lt;!&ndash; BEGIN ROOMS &ndash;&gt;-->
<!--        <div class="flex">-->
<!--            <div-->
<!--                v-for="(room, key) in filterComponent.rooms"-->
<!--                :key="key"-->
<!--                class="flex select-none"-->
<!--            >-->
<!--                <input-->
<!--                    :id="`filter-${room}`"-->
<!--                    :value="room"-->
<!--                    type="checkbox"-->
<!--                    class="hidden"-->
<!--                    multiple-->
<!--                    v-model="form.rooms"-->
<!--                >-->

<!--                <label-->
<!--                    :for="`filter-${room}`"-->
<!--                    :class="{ 'bg-red-400': form.rooms.includes(room as never) }"-->
<!--                    class="cursor-pointer"-->
<!--                >-->
<!--                    {{ room }}-->
<!--                </label>-->
<!--            </div>-->
<!--        </div>-->
<!--        &lt;!&ndash; BEGIN ROOMS &ndash;&gt;-->

<!--        &lt;!&ndash; BEGIN PRICE &ndash;&gt;-->
<!--        <Menu as="div" class="relative">-->
<!--            <MenuButton>Цена</MenuButton>-->
<!--            <MenuItems class="absolute">-->
<!--                &lt;!&ndash; Use the `active` state to conditionally style the active item. &ndash;&gt;-->
<!--                <MenuItem-->
<!--                    as="div"-->
<!--                    class="ui-active:bg-blue-500 ui-active:text-white ui-not-active:bg-white ui-not-active:text-black"-->
<!--                >-->
<!--                    Цена-->
<!--                </MenuItem>-->
<!--            </MenuItems>-->
<!--        </Menu>-->
<!--        &lt;!&ndash; BEGIN PRICE &ndash;&gt;-->

<!--        &lt;!&ndash; BEGIN PRICE &ndash;&gt;-->
<!--        <Menu as="div" class="relative">-->
<!--            <MenuButton>Площадь</MenuButton>-->
<!--            <MenuItems class="absolute">-->
<!--                &lt;!&ndash; Use the `active` state to conditionally style the active item. &ndash;&gt;-->
<!--                <MenuItem-->
<!--                    as="div"-->
<!--                    class="ui-active:bg-blue-500 ui-active:text-white ui-not-active:bg-white ui-not-active:text-black"-->
<!--                >-->
<!--                    Площадь-->
<!--                </MenuItem>-->
<!--            </MenuItems>-->
<!--        </Menu>-->
<!--        &lt;!&ndash; BEGIN PRICE &ndash;&gt;-->

<!--        {{ form }}-->
<!--    </form>-->

    <form
        class="flex h-14 border-[1px] border-gray-100 select-none"
        @submit.prevent
    >
        <FilterDealTypeList
            :deal-types="filterComponent.deal_types"
        />

        <FilterRoomList
            :rooms="filterComponent.rooms"
        />

        <FilterPriceList
            :prices="filterComponent.prices"
        />

        <FilterAreaList
            :areas="filterComponent.areas"
        />

        <pre>
            <span>Deal: {{ filterStore.dealType }}</span>
            <span>Roominess: {{ filterStore.rooms }}</span>
            <span>Price: {{ filterStore.price }}</span>
            <span>Area: {{ filterStore.area }}</span>
        </pre>
    </form>
</template>

<script setup lang="ts">
import { watch } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { useFilterStore } from "@/Stores/useFilterStore";
import FilterDealTypeList from "@/Components/Filter/Inputs/DealType/FilterDealTypeList.vue";
import FilterRoomList from "@/Components/Filter/Inputs/Room/FilterRoomList.vue";
import FilterPriceList from "@/Components/Filter/Inputs/Price/FilterPriceList.vue";
import FilterAreaList from "@/Components/Filter/Inputs/Area/FilterAreaList.vue";
import type { FilterComponent } from "@/types";

const props = defineProps<{
    url: string
}>()

const page = usePage()
const filterStore = useFilterStore()
const filterComponent = page.props['filter_component'] as FilterComponent
const form = useForm({
    deal_type: filterStore.dealType,
    rooms: filterStore.rooms,
    price: filterStore.price,
    area: filterStore.area,
})
</script>

<style scoped>

</style>
