<template>
    <FrontEnd>
        <Head title="" />
        <Link 
            :href="route('todo.index')"
        >
            Direction la todo
        </Link>
    </FrontEnd>
</template>

<script setup>
import FrontEnd from '@/Layouts/FrontEndLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>