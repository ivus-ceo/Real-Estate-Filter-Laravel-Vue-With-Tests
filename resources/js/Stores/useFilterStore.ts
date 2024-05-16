import { defineStore } from 'pinia'
import { computed, ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import useEmitter from "@/Composables/Common/useEmitter";
import FilterComponentDTO = App.DTOs.Components.Filters.FilterComponentDTO;
import FilterItem = App.DTOs.Filters.Items.FilterItem;
import type { FilterQueries } from "@/types";

export const useFilterStore = defineStore('filter', () => {
    const page = usePage()
    const body = ref<FilterQueries>({})
    const filterComponentDTO = page.props['filterComponentDTO'] as FilterComponentDTO
    const dealTypeDropdownComponentDTO = filterComponentDTO.dealTypeDropdownComponent
    const roominessDropdownComponentDTO = filterComponentDTO.roominessDropdownComponent
    const priceRangeComponentDTO = filterComponentDTO.priceRangeComponent
    // const areaRangeComponentDTO = filterComponentDTO.areaRangeComponent
    // Set filter values
    const dealType = ref<FilterItem>(dealTypeDropdownComponentDTO.queryItem ?? dealTypeDropdownComponentDTO.defaultItem)
    const roominess = ref<FilterItem[]>(roominessDropdownComponentDTO.queryItems ?? roominessDropdownComponentDTO.defaultItems)
    const minPrice = ref<FilterItem>(priceRangeComponentDTO.minQueryItem ?? priceRangeComponentDTO.minDefaultItem)
    const maxPrice = ref<FilterItem>(priceRangeComponentDTO.maxQueryItem ?? priceRangeComponentDTO.maxDefaultItem)
    // const minArea = ref<FilterInputDTO>(areaRangeComponent.minQueryItem ?? areaRangeComponent.minDefaultItem)
    // const maxArea = ref<FilterInputDTO>(areaRangeComponent.maxQueryItem ?? areaRangeComponent.maxDefaultItem)

    const setDealType = (value: FilterItem): void => {
        dealType.value = value
    }

    const resetDealType = (): void => {
        const item = dealTypeDropdownComponentDTO.defaultItem
        body.value[dealTypeDropdownComponentDTO.query] = item.value
        dealType.value = item
    }

    const setRoominess = (value: FilterItem[]): void => {
        roominess.value = value
    }

    const resetRoominess = (): void => {
        const items = roominessDropdownComponentDTO.defaultItems
        body.value[roominessDropdownComponentDTO.query] = items.map((item: FilterItem) => item.value)
        roominess.value = items
    }

    const setMinPrice = (value: FilterItem): void => {
        minPrice.value = value
    }

    const setMaxPrice = (value: FilterItem): void => {
        maxPrice.value = value
    }

    const setPrices = (values: [FilterItem, FilterItem]): void => {
        minPrice.value = values[0]
        maxPrice.value = values[1]
    }

    const resetMinPrice = (): void => {
        const item = priceRangeComponentDTO.minDefaultItem
        body.value[priceRangeComponentDTO.minQuery] = item.value
        minPrice.value = item
    }

    const resetMaxPrice = (): void => {
        const item = priceRangeComponentDTO.maxDefaultItem
        body.value[priceRangeComponentDTO.maxQuery] = item.value
        maxPrice.value = item
    }

    const resetPrices = (): void => {
        resetMinPrice()
        resetMaxPrice()
        useEmitter.emit('filter:resetRange')
    }

    // const setMinArea = (value: FilterInputDTO): void => {
    //     minArea.value = value
    // }
    //
    // const setMaxArea = (value: FilterInputDTO): void => {
    //     maxArea.value = value
    // }
    //
    // const setAreas = (values: [FilterInputDTO, FilterInputDTO]): void => {
    //     minArea.value = values[0]
    //     maxArea.value = values[1]
    // }
    //
    // const resetMinArea = (): void => {
    //     body.value[areaRangeComponent.minQueryName] = areaRangeComponent.minDefaultItem
    //     minArea.value = areaRangeComponent.minDefaultItem
    // }
    //
    // const resetMaxArea = (): void => {
    //     body.value[areaRangeComponent.maxQueryName] = areaRangeComponent.maxDefaultItem
    //     maxArea.value = areaRangeComponent.maxDefaultItem
    // }
    //
    // const resetAreas = (): void => {
    //     resetMinArea()
    //     resetMaxArea()
    //     useEmitter.emit('filter:resetRange')
    // }

    // Resets all filter values and body to default
    const reset = (): void => {
        resetDealType()
        resetRoominess()
        resetPrices()
        // resetAreas()
    }

    return {
        filterComponentDTO, dealTypeDropdownComponentDTO, roominessDropdownComponentDTO, priceRangeComponentDTO, // areaRangeComponent,
        dealType, roominess, minPrice, maxPrice, //minArea, maxArea,
        setDealType, setRoominess,  setMinPrice, setMaxPrice, setPrices, //setMinArea, setMaxArea, setAreas,
        reset
    }
})
