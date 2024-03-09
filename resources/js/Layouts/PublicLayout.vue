<template>
    <div class="container mx-auto">
        <NavbarLayout/>

        <main>
            <slot/>
        </main>
    </div>
</template>

<script setup lang="ts">
import NavbarLayout from "@/Components/Layouts/NavbarLayout.vue";
</script>

<style scoped>

</style>
