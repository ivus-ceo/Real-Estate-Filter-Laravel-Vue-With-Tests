import { defineStore } from 'pinia'
import { computed, ref } from "vue";
import type { FilterArea, FilterComponent, FilterDealType, FilterPrice, FilterRoom } from "@/types";
import { usePage } from "@inertiajs/vue3";

export const useFilterStore = defineStore('filter', () => {
    const page = usePage()
    const filterComponent = page.props['filter_component'] as FilterComponent
    const dealType = ref<FilterDealType>()
    const rooms = ref<FilterRoom[]>([])
    // const price = ref<FilterPrice>()
    // const area = ref<FilterArea>()

    // Set query filter values
    dealType.value = filterComponent.deal_types.find((dealType: FilterDealType) => dealType.exists_in_query)
    rooms.value = filterComponent.roominess.filter((room: FilterRoom) => room.exists_in_query)

    const setDealType = (value: FilterDealType): void => {
        dealType.value = value
    }

    const setRooms = (array: FilterRoom[]): void => {
        rooms.value = array
    }

    // const setPrice = (value: string): void => {
    //     price.value = (price.value !== value) ? value : ''
    // }
    //
    // const setArea = (value: string): void => {
    //     area.value = (area.value !== value) ? value : ''
    // }
    //
    // const isDealType = (value: string): boolean => {
    //     return dealType.value === value
    // }
    //
    // const hasRoom = (room: string): boolean => {
    //     return rooms.value.includes(room)
    // }
    //
    // const isPrice = (value: string): boolean => {
    //     return price.value === value
    // }
    //
    // const isArea = (value: string): boolean => {
    //     return area.value === value
    // }

    return {
        filterComponent,
        dealType, rooms,
        setDealType, setRooms,
        // dealType, rooms, price, area,
        // setDealType, setRooms, setPrice, setArea,
        // isDealType, hasRoom, isPrice, isArea,
    }
})
