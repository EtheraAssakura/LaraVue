<template>
    <Head title="Home" />
    <FrontEnd>

        <Link :href="route('todo.index')" class="mx-5 py-2 px-5">
            Direction la todo
        </Link>

    </FrontEnd>
</template>

<script setup>
import FrontEnd from '@/Layouts/FrontEndLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>