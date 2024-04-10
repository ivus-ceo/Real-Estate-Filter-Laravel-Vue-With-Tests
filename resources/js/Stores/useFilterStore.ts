import { defineStore } from 'pinia'
import { computed, ref } from "vue";
import type {
    FilterComponent,
    FilterDealTypes,
    FilterDealType,
    FilterRoominess,
    FilterRoom,
    FilterPrices,
    FilterPrice,
} from "@/types";
import { usePage } from "@inertiajs/vue3";

export const useFilterStore = defineStore('filter', () => {
    const page = usePage()
    const filterComponent = page.props['filterComponent'] as FilterComponent
    const dealType = ref<FilterDealType>()
    const roominess = ref<FilterRoominess>([])
    const price = ref<FilterPrice>()

    const setDealType = (value: FilterDealType): void => {
        dealType.value = value
    }

    const setRoominess = (array: FilterRoominess): void => {
        roominess.value = array
    }

    const setPrice = (value: FilterPrice): void => {

    }

    const reset = (): void => {
        dealType.value = filterComponent.defaultDealType
        roominess.value = [filterComponent.defaultRoominess]
        price.value = filterComponent.defaultPrice
    }

    // Set default filter values by query
    reset()

    return {
        filterComponent,
        dealType, roominess, price,
        setDealType, setRoominess, setPrice
    }
})
