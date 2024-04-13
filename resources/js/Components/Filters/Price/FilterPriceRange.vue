<template>
    <div class="relative px-6 py-4">
        <div class="flex h-24 items-end gap-0.5 rounded-b-lg overflow-hidden">
            <div
                v-for="item in priceRangeComponent.graph.items"
                class="w-full bg-black"
                :style="`height: ${item / priceRangeComponent.graph.max * 100}%`"
            ></div>
        </div>

        <div
            class="mb-3 px-4"
            ref="range"
        ></div>

        <div class="flex gap-3 items-center">
            <input
                class="w-full bg-gray-100 border-none rounded-lg"
                type="number"
                :min="minPrice"
                :max="maxPrice"
                v-model="currentMinPrice"
            >

            -

            <input
                class="w-full bg-gray-100 border-none rounded-lg"
                type="number"
                :min="minPrice"
                :max="maxPrice"
                v-model="currentMaxPrice"
            >
        </div>
    </div>
</template>

<script setup lang="ts">
import noUiSlider from 'nouislider';
import 'nouislider/dist/nouislider.css';
import { ref, onMounted, watch } from "vue";
import { useFilterStore } from "@/Stores/useFilterStore";
import { FilterRangeDTO } from "@/types";
import { API } from "nouislider/src/nouislider";
import useLang from "@/Composables/useLang";

const range = ref<HTMLDivElement>()
const priceRange = ref<API>()
const filterStore = useFilterStore()
const priceRangeComponent = filterStore.priceRangeComponent
// Minimal and maximal possible prices
const minPrice = priceRangeComponent.default.minValue
const maxPrice = priceRangeComponent.default.maxValue
// Current prices from query or default
const currentMinPrice = ref(priceRangeComponent.current.minValue)
const currentMaxPrice = ref(priceRangeComponent.current.maxValue)

const handleRangeInit = (): void => {
    priceRange.value = noUiSlider.create(range.value!, {
        start: [
            currentMinPrice.value,
            currentMaxPrice.value
        ],
        connect: true,
        step: 1,
        range: {
            'min': minPrice,
            'max': maxPrice
        },
    });

    priceRange.value?.on('slide', (values: (number | string)[]) => {
        currentMinPrice.value = Number(values[0])
        currentMaxPrice.value = Number(values[1])
        filterStore.setPrice(getCurrentPrice())
    })
}

const getCurrentPrice = (): FilterRangeDTO => {
    const name = useLang('base.filter.prices.between') as string;

    return {
        name: name
            .replace(':from', new Intl.NumberFormat('en-US').format(currentMinPrice.value))
            .replace(':to', new Intl.NumberFormat('en-US').format(currentMaxPrice.value)),
        minValue: currentMinPrice.value,
        maxValue: currentMaxPrice.value
    }
}

watch(currentMinPrice, () => {
    filterStore.setPrice(getCurrentPrice())
})

watch(currentMaxPrice, () => {
    filterStore.setPrice(getCurrentPrice())
})

onMounted(() => {
    handleRangeInit()
})
</script>

<style lang="postcss">
.noUi-target {
    @apply bg-gray-100 h-1 border-none
}

.noUi-connect {
    @apply bg-black h-1 border-none
}

.noUi-handle {
    @apply !bg-black !shadow-none !rounded-full !w-[16px] !h-[16px] !top-[-6px] cursor-pointer border-none absolute
}

.noUi-handle-lower {
    @apply !right-[0px]
}

.noUi-handle-upper {
    @apply !right-[-16px]
}

.noUi-handle:before,
.noUi-handle:after,
.noUi-touch-area {
    @apply !hidden
}
</style>
