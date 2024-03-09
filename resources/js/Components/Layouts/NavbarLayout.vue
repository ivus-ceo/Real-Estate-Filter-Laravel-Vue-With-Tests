<template>
    <nav class="flex justify-center flex-col gap-1 h-20">
        <!-- navbar top begin -->
        <div class="flex w-full gap-1">
            <a
                href="https://github.com/ivus-ceo/Real-Estate-Filter-Laravel-Vue-With-Tests"
                target="_blank"
                class="flex-1 bg-blue-500 font-semibold text-white text-center"
            >
                GitHub
            </a>
            <a
                href="https://www.linkedin.com/in/ivan-uskov/"
                target="_blank"
                class="flex-1 bg-blue-500 font-semibold text-white text-center"
            >
                LinkedIn
            </a>
            <a
                href="https://hh.ru/applicant/resumes?hhtmFrom=main&hhtmFromLabel=header"
                target="_blank"
                class="flex-1 bg-blue-500 font-semibold text-white text-center"
            >
                HeadHunter
            </a>
        </div>
        <!-- navbar top end -->

        <!-- navbar bottom begin -->
        <div class="flex w-full">
            <div class="flex-1">
                <Link
                    :href="route('public.home.index')"
                    class="nav-link"
                >
                    Real Estate Filter
                </Link>
            </div>

            <div v-if="$page.props.auth.user">
                <Link
                    :href="route('dashboard')"
                    class="nav-link"
                >
                    Dashboard
                </Link>
            </div>

            <div
                v-else
                class="flex gap-4"
            >
                <Link
                    :href="route('login')"
                    class="nav-link"
                >
                    Log in
                </Link>

                <Link
                    :href="route('register')"
                    class="nav-link"
                >
                    Register
                </Link>
            </div>
        </div>
        <!-- navbar bottom end -->
    </nav>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

<style scoped lang="postcss">
.nav-link {
    @apply font-semibold text-gray-600 hover:text-gray-900
}
</style>
