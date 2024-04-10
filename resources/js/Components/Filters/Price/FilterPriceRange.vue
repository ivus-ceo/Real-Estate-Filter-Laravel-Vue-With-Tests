<template>
<!-- class="!absolute !left-0 !bottom-[-16px] !w-full !h-1 !border-none !bg-gray-100 !shadow-none" -->
    <div class="relative">
        <div
            ref="price"
        ></div>
    </div>
</template>

<script setup lang="ts">
import noUiSlider from 'nouislider';
import 'nouislider/dist/nouislider.css';
import { ref, onMounted } from "vue";

const price = ref<HTMLDivElement>()

onMounted(() => {
    noUiSlider.create(price.value!, {
        start: [20, 80],
        connect: true,
        range: {
            'min': 0,
            'max': 100
        },
    });
})
</script>

<style lang="postcss">
/*
.noUi-connect {
    @apply bg-black
}

.noUi-handle {
    @apply !bg-black !shadow-none !w-[14px] !h-[14px] !top-[-5px] cursor-pointer border-none absolute
}

.noUi-handle-lower {
    @apply !right-[-14px]
}

.noUi-handle-upper {
    @apply !right-0
}

/* !top-[4px] !translate-y-[-50%]

.noUi-handle:before,
.noUi-handle:after,
.noUi-touch-area {
    @apply !hidden
}*/
</style>
