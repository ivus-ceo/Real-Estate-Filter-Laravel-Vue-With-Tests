<template>
    <div class="relative flex gap-3">
        <input
            class="w-full bg-gray-100 border-none rounded-lg"
            ref="minInput"
            type="number"
            :min="min"
            :max="max"
            :value="currentMin"
            @input="handleInputChange"
        >

        <span class="flex items-center">
            —
        </span>

        <input
            class="w-full bg-gray-100 border-none rounded-lg"
            ref="maxInput"
            type="number"
            :min="min"
            :max="max"
            :value="currentMax"
            @input="handleInputChange"
        >
    </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from "vue";

const props = defineProps<{
    min: number
    max: number
    currentMin: number
    currentMax: number
}>()

const emit = defineEmits(['update'])

const minInput = ref<HTMLInputElement>()
const maxInput = ref<HTMLInputElement>()

const handleInputChange = () => {
    let min = Number(minInput.value?.value)
    let max = Number(maxInput.value?.value)

    if (min > props.max) {
        min = props.max
        minInput.value!.value = props.max.toString()
    } else if (min < props.min) {
        min = props.min
        minInput.value!.value = props.min.toString()
    }

    if (max > props.max) {
        max = props.max
        maxInput.value!.value = props.max.toString()
    } else if (max < props.min) {
        max = props.min
        maxInput.value!.value = props.max.toString()
    }

    emit('update', [min, max])
}

onMounted(() => {
    minInput.value
})
</script>

<style scoped>

</style>
