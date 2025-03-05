<template>
    <Head title="Liste des taches" />
    <FrontEnd>
        <div
            v-if="$page.props.flash.message"
            class="edit mt-4 mx-5 px-4 py-2"
        >
            {{ $page.props.flash.message }}
        </div>

        <div class="mt-4 mx-4">
            <div>
                <Link
                    :href="route('todo.create')"
                    class="bg-blue-500 text-dark p-3 rounded mb-4"
                >
                    Ajouter une tache
                </Link>
            </div>
            <div class="flex space-x-2 py-5 mb-4">
                <button
                    class="bg-gray-200 px-4 py-2 rounded"
                    @click="filtre = 'to do'"
                >
                    To do
                </button>
                <button
                    class="bg-gray-200 px-4 py-2 rounded"
                    @click="filtre = 'en cours'"
                >
                    En cours
                </button>
                <button
                    class="bg-gray-200 px-4 py-2 rounded"
                    @click="filtre = 'terminé'"
                >
                    Terminé
                </button>
                <button
                    class="bg-gray-300 px-4 py-2 rounded"
                    @click="filtre = ''"
                >
                    Tout
                </button>
            </div>
            <ul class="py-5">
                <li
                    v-for="(item, index) in onlyFilter"
                    :key="index"
                >
                    <Link :href="route('todo.show',item.id)">
                        {{ item.title }}
                    </Link>
                    / {{ item.statut }}
                </li>
            </ul>
        </div>
    </FrontEnd>
</template>

<script setup>
import {ref, computed} from 'vue';
import FrontEnd from '@/Layouts/FrontEndLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

let filtre = ref('');

const onlyFilter = computed(() => {
    if (!filtre.value) {
        return props.todo; // Si pas de filtre, afficher tout
    }
    return props.todo.filter((item) => item.statut === filtre.value);
})

const props = defineProps({
    todo: Array,
});

</script>