import { defineStore } from 'pinia'
import { computed, ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import useEmitter from "@/Composables/Common/useEmitter";
import FilterComponentDTO = App.DTOs.Components.Filters.FilterComponentDTO;
import FilterItemDTO = App.DTOs.Filters.Items.FilterItemDTO;
import type { FilterQueries } from "@/types";

export const useFilterStore = defineStore('filter', () => {
    const page = usePage()
    const body = ref<FilterQueries>({})
    const filterComponentDTO = page.props['filterComponentDTO'] as FilterComponentDTO
    const filterDealTypeDropdownComponentDTO = filterComponentDTO.filterDealTypeDropdownComponentDTO
    const filterRoominessDropdownComponentDTO = filterComponentDTO.filterRoominessDropdownComponentDTO
    const filterPriceRangeComponentDTO = filterComponentDTO.filterPriceRangeComponentDTO
    const filterAreaRangeComponentDTO = filterComponentDTO.filterAreaRangeComponentDTO
    const filterSearchComponentDTO = filterComponentDTO.filterSearchComponentDTO
    // Set filter values
    const dealType = ref<FilterItemDTO>(filterDealTypeDropdownComponentDTO.queryItem ?? filterDealTypeDropdownComponentDTO.defaultItem)
    const roominess = ref<FilterItemDTO[]>(filterRoominessDropdownComponentDTO.queryItems ?? filterRoominessDropdownComponentDTO.defaultItems)
    const minPrice = ref<FilterItemDTO>(filterPriceRangeComponentDTO.minQueryItem ?? filterPriceRangeComponentDTO.minDefaultItem)
    const maxPrice = ref<FilterItemDTO>(filterPriceRangeComponentDTO.maxQueryItem ?? filterPriceRangeComponentDTO.maxDefaultItem)
    const minArea = ref<FilterItemDTO>(filterAreaRangeComponentDTO.minQueryItem ?? filterAreaRangeComponentDTO.minDefaultItem)
    const maxArea = ref<FilterItemDTO>(filterAreaRangeComponentDTO.maxQueryItem ?? filterAreaRangeComponentDTO.maxDefaultItem)
    const search = ref<FilterItemDTO>(filterSearchComponentDTO.queryItem ?? filterSearchComponentDTO.defaultItem)

    const setDealType = (value: FilterItemDTO): void => {
        dealType.value = value
    }

    const resetDealType = (): void => {
        const item = filterDealTypeDropdownComponentDTO.defaultItem
        body.value[filterDealTypeDropdownComponentDTO.query] = item.value
        dealType.value = item
    }

    const setRoominess = (value: FilterItemDTO[]): void => {
        roominess.value = value
    }

    const resetRoominess = (): void => {
        const items = filterRoominessDropdownComponentDTO.defaultItems
        body.value[filterRoominessDropdownComponentDTO.query] = items.map((item: FilterItemDTO) => item.value)
        roominess.value = items
    }

    const setMinPrice = (value: FilterItemDTO): void => {
        minPrice.value = value
    }

    const setMaxPrice = (value: FilterItemDTO): void => {
        maxPrice.value = value
    }

    const setPrices = (values: [FilterItemDTO, FilterItemDTO]): void => {
        minPrice.value = values[0]
        maxPrice.value = values[1]
    }

    const resetMinPrice = (): void => {
        const item = filterPriceRangeComponentDTO.minDefaultItem
        body.value[filterPriceRangeComponentDTO.minQuery] = item.value
        minPrice.value = item
    }

    const resetMaxPrice = (): void => {
        const item = filterPriceRangeComponentDTO.maxDefaultItem
        body.value[filterPriceRangeComponentDTO.maxQuery] = item.value
        maxPrice.value = item
    }

    const resetPrices = (): void => {
        resetMinPrice()
        resetMaxPrice()
        useEmitter.emit('filter:resetRange')
    }

    const setMinArea = (value: FilterItemDTO): void => {
        minArea.value = value
    }

    const setMaxArea = (value: FilterItemDTO): void => {
        maxArea.value = value
    }

    const setAreas = (values: [FilterItemDTO, FilterItemDTO]): void => {
        minArea.value = values[0]
        maxArea.value = values[1]
    }

    const resetMinArea = (): void => {
        const item = filterAreaRangeComponentDTO.minDefaultItem
        body.value[filterAreaRangeComponentDTO.minQuery] = item.value
        minArea.value = item
    }

    const resetMaxArea = (): void => {
        const item = filterAreaRangeComponentDTO.maxDefaultItem
        body.value[filterAreaRangeComponentDTO.maxQuery] = item.value
        maxArea.value = item
    }

    const resetAreas = (): void => {
        resetMinArea()
        resetMaxArea()
        useEmitter.emit('filter:resetRange')
    }

    const setSearch = (value: FilterItemDTO): void => {
        search.value = value
    }

    const resetSearch = (): void => {
        const item = filterSearchComponentDTO.defaultItem
        body.value[filterSearchComponentDTO.query] = item.value
        search.value = item
    }

    // Resets all filter values and body to default
    const reset = (): void => {
        resetDealType()
        resetRoominess()
        resetPrices()
        resetAreas()
        resetSearch()
    }

    return {
        // DTOs
        filterComponentDTO, filterDealTypeDropdownComponentDTO,
        filterRoominessDropdownComponentDTO, filterPriceRangeComponentDTO,
        filterAreaRangeComponentDTO, filterSearchComponentDTO,
        // Filterables
        dealType, roominess,
        minPrice, maxPrice,
        minArea, maxArea,
        search,
        // Methods
        setDealType, setRoominess,
        setMinPrice, setMaxPrice,
        setPrices, setMinArea,
        setMaxArea, setAreas,
        setSearch,
        reset
    }
})
