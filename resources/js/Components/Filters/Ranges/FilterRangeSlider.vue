<template>
    <div class="px-6 pb-3">
        <div
            class="px-4"
            ref="range"
        ></div>
    </div>
</template>

<script setup lang="ts">
import 'nouislider/dist/nouislider.css';
import noUiSlider, { API } from "nouislider";
import { onMounted, ref } from "vue";
import type { FilterInputDTO } from "@/types";
import useEmitter from "@/Composables/Common/useEmitter";

const props = defineProps<{
    min: number
    max: number
    currentMin: number
    currentMax: number
}>()

const emit = defineEmits<{
    (event: 'update-values', values: [FilterInputDTO, FilterInputDTO]): void
}>()

const range = ref<HTMLDivElement>()
const rangeSlider = ref<API>()

onMounted(() => {
    rangeSlider.value = noUiSlider.create(range.value!, {
        start: [
            Number(props.currentMin),
            Number(props.currentMax)
        ],
        connect: true,
        step: 1,
        range: {
            min: Number(props.min),
            max: Number(props.max)
        },
    });

    rangeSlider.value.on('slide', (values: (number | string)[]) => {
        emit('update-values', [
            { name: '', value: values[0].toString() },
            { name: '', value: values[1].toString() }
        ])
    })
})

useEmitter.on('filter:resetRange', () => {
    rangeSlider.value?.set([props.min, props.max])
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
