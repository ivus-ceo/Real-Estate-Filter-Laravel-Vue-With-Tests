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
            :current-deal-type="form.deal_type"
            v-model="form.deal_type"
        />

        <FilterRoomList
            :rooms="filterComponent.rooms"
            :current-rooms="form.rooms"
            v-model="form.rooms"
        />

        <pre>
            {{ form }}
        </pre>
    </form>
</template>

<script setup lang="ts">
import { useForm, usePage } from "@inertiajs/vue3";
import { FilterComponent } from "@/types";
import FilterDealTypeList from "@/Components/Filter/Inputs/DealType/FilterDealTypeList.vue";
import FilterRoomList from "@/Components/Filter/Inputs/Room/FilterRoomList.vue";
import { watch } from "vue";
import { Menu, MenuButton, MenuItem, MenuItems, Tab, TabGroup, TabList, TabPanel, TabPanels } from "@headlessui/vue";

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
