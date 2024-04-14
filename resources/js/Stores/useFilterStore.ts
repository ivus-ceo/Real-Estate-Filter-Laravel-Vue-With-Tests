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
    const dealType = ref<FilterInputDTO>(dealTypeDropdownComponentDTO.default)
    const roominess = ref<FilterInputDTO[]>([roominessDropdownComponent.default])
    const price = ref<FilterRangeDTO>(priceRangeComponent.current)

    const setDealType = (value: FilterInputDTO): void => {
        dealType.value = value
    }

    const resetDealType = (): void => {
        body.value[dealTypeDropdownComponentDTO.query] = dealTypeDropdownComponentDTO.default
        dealType.value = dealTypeDropdownComponentDTO.default
    }

    const setRoominess = (array: FilterInputDTO[]): void => {
        roominess.value = array
    }

    const resetRoominess = (): void => {
        body.value[roominessDropdownComponent.query] = [roominessDropdownComponent.default]
        roominess.value = [roominessDropdownComponent.default]
    }

    const setPrice = (value: FilterRangeDTO): void => {
        price.value = value
    }

    const resetPrice = (): void => {
        body.value[priceRangeComponent.query] = [priceRangeComponent.default]
        price.value = priceRangeComponent.default
        useEmitter.emit('filter:resetPrice')
    }

    // Resets all filter values and body to default
    const reset = (): void => {
        resetDealType()
        resetRoominess()
        resetPrice()
    }

    return {
        filterComponentDTO, dealTypeDropdownComponentDTO, roominessDropdownComponent, priceRangeComponent,
        dealType, roominess, price,
        setDealType, setRoominess, setPrice,
        reset
    }
})
