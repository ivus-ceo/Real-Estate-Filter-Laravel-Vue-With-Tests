<template>
    <div
        class="mb-3 px-4"
        ref="range"
    ></div>
</template>

<script setup lang="ts">
import 'nouislider/dist/nouislider.css';
import noUiSlider from "nouislider";
import { onMounted, ref } from "vue";

const range = ref<HTMLDivElement>()
const props = defineProps<{
    min: number
    max: number
    currentMin: number
    currentMax: number
}>()

const emit = defineEmits(['update'])

onMounted(() => {
    const priceRange = noUiSlider.create(range.value!, {
        start: [
            props.currentMin,
            props.currentMax
        ],
        connect: true,
        step: 1,
        range: {
            'min': props.min,
            'max': props.max
        },
    });

    priceRange.on('slide', (values: (number | string)[]) => {
        emit('update', [
            Number(values[0]),
            Number(values[1])
        ])
    })
})
</script>

<style>
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

.white-circle {
    @apply absolute w-[8px] h-[8px] bg-white rounded-full top-[50%] translate-y-[-50%]
}


.noUi-handle-lower:before {
    @apply white-circle right-0 translate-x-[-130%]
}

.noUi-handle-upper:before {
    @apply white-circle left-0 translate-x-[50%]
}

.noUi-handle:after,
.noUi-touch-area {
    @apply hidden
}
</style>
