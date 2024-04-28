import { defineStore } from 'pinia'
import { computed, ref } from "vue";
import type {
    FilterBody,
    FilterComponentDTO,
    FilterInputDTO,
    FilterRangeDTO,
} from "@/types";
import { usePage } from "@inertiajs/vue3";
import useEmitter from "@/Composables/Common/useEmitter";

export const useFilterStore = defineStore('filter', () => {
    const page = usePage()
    const body = ref<FilterBody>({})
    const filterComponentDTO = page.props['filterComponent'] as FilterComponentDTO
    const dealTypeDropdownComponentDTO = filterComponentDTO.dealTypeDropdownComponent
    const roominessDropdownComponent = filterComponentDTO.roominessDropdownComponent
    const priceRangeComponent = filterComponentDTO.priceRangeComponent
    // Set filter values
    const dealType = ref<FilterInputDTO>(dealTypeDropdownComponentDTO.queryItem ?? dealTypeDropdownComponentDTO.defaultItem)
    const roominess = ref<FilterInputDTO[]>(roominessDropdownComponent.queryItems ?? roominessDropdownComponent.defaultItems)
    const minPrice = ref<FilterInputDTO>(priceRangeComponent.minQueryItem ?? priceRangeComponent.minDefaultItem)
    const maxPrice = ref<FilterInputDTO>(priceRangeComponent.maxQueryItem ?? priceRangeComponent.maxDefaultItem)

    const setDealType = (value: FilterInputDTO): void => {
        dealType.value = value
    }

    const resetDealType = (): void => {
        body.value[dealTypeDropdownComponentDTO.queryName] = dealTypeDropdownComponentDTO.queryItem ?? dealTypeDropdownComponentDTO.defaultItem
        dealType.value = dealTypeDropdownComponentDTO.queryItem ?? dealTypeDropdownComponentDTO.defaultItem
    }

    const setRoominess = (value: FilterInputDTO[]): void => {
        roominess.value = value
    }

    const resetRoominess = (): void => {
        body.value[roominessDropdownComponent.queryName] = roominessDropdownComponent.queryItems ?? roominessDropdownComponent.defaultItems
        roominess.value = roominessDropdownComponent.queryItems ?? roominessDropdownComponent.defaultItems
    }

    const setMinPrice = (value: FilterInputDTO): void => {
        minPrice.value = value
    }

    const setMaxPrice = (value: FilterInputDTO): void => {
        maxPrice.value = value
    }

    const setPrices = (values: [FilterInputDTO, FilterInputDTO]): void => {
        minPrice.value = values[0]
        maxPrice.value = values[1]
    }

    const resetMinPrice = (): void => {
        body.value[priceRangeComponent.minQueryName] = priceRangeComponent.minDefaultItem
        minPrice.value = priceRangeComponent.minDefaultItem
    }

    const resetMaxPrice = (): void => {
        body.value[priceRangeComponent.maxQueryName] = priceRangeComponent.maxDefaultItem
        maxPrice.value = priceRangeComponent.maxDefaultItem
    }

    const resetPrices = (): void => {
        resetMinPrice()
        resetMaxPrice()
        useEmitter.emit('filter:resetRange')
    }

    // Resets all filter values and body to default
    const reset = (): void => {
        resetDealType()
        resetRoominess()
        resetPrices()
    }

    return {
        filterComponentDTO, dealTypeDropdownComponentDTO, roominessDropdownComponent, priceRangeComponent,
        dealType, roominess, minPrice, maxPrice,
        setDealType, setRoominess, setMinPrice, setMaxPrice, setPrices,
        reset
    }
})
