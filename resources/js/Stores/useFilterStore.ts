import { defineStore } from 'pinia'
import { computed, ref } from "vue";
import { FilterRoom } from "@/types";

type ArrayOfStrings = Array<string>
type Rooms = ArrayOfStrings

export const useFilterStore = defineStore('filter', () => {
    const dealType = ref<string>('sale')
    const rooms = ref<Rooms>([])
    const price = ref<string>('')
    const area = ref<string>('')

    const setDealType = (value: string): void => {
        dealType.value = value
    }

    const setRooms = (room: string): void => {
        const index = rooms.value.indexOf(room)

        if (hasRoom(room)) {
            rooms.value.splice(index, 1)
            return
        }

        rooms.value = [...rooms.value, room]
    }

    const setPrice = (value: string): void => {
        price.value = (price.value !== value) ? value : ''
    }

    const setArea = (value: string): void => {
        area.value = (area.value !== value) ? value : ''
    }

    const isDealType = (value: string): boolean => {
        return dealType.value === value
    }

    const hasRoom = (room: string): boolean => {
        return rooms.value.includes(room)
    }

    const isPrice = (value: string): boolean => {
        return price.value === value
    }

    const isArea = (value: string): boolean => {
        return area.value === value
    }

    return {
        dealType, rooms, price, area,
        setDealType, setRooms, setPrice, setArea,
        isDealType, hasRoom, isPrice, isArea,
    }
})
