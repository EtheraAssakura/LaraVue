<template>
    <Head title="" />
    <FrontEnd>

        <div v-if="$page.props.flash.message" class="edit mt-4 mx-5 px-4 py-2">
            {{ $page.props.flash.message }}
        </div>

        <div class="mt-4 mx-4">
            <div class="flex justify-between">
                <h2>To do :</h2>
                <Link 
                    :href="route('todo.create')"
                    class="bg-blue-500 text-dark p-3 rounded mb-4"
                >
                    Ajouter une tache
                </Link>
            </div>
            <ul>
                <li 
                    v-for="(item, index) in todo"
                    :key="index"
                >
                    <Link 
                        :href="route('todo.show',item.id)"
                    >
                        {{ item.title }}
                    </Link>
                </li>
                
            </ul>
        </div>
        

    </FrontEnd>
</template>

<script setup>
import FrontEnd from '@/Layouts/FrontEndLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    todo: Array,
});

</script>