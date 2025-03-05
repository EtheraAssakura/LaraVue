<template>
    <Head title="Tache" />
    <FrontEnd>
        <div
            v-if="$page.props.flash.message"
            class="bg-red-500 mt-4 mx-5 px-4 py-2"
        >
            {{ $page.props.flash.message }}
        </div>

        <div class="mt-4 mx-4">
            <div class="flex justify-between">
                <h2>{{ todo.title }}</h2>
                <Link
                    :href="route('todo.index')"
                    class="bg-red-500 text-dark py-2 px-5 rounded mb-4 inline-block"
                >
                    Retour
                </Link>
            </div>
            <p>{{ todo.more_info }}</p>
            <p>{{ todo.statut }}</p>
            <br>
            <Link
                :href="route('todo.edit', todo.id)"
                class="edit text-white py-2 px-5 rounded inline-block"
            >
                Edit
            </Link>
            <button
                class="bg-red-500 py-2 px-5 rounded"
                @click="deleteTodo(todo.id)"
            >
                Delete
            </button>
        </div>
    </FrontEnd>
</template>

<script setup>
import FrontEnd from '@/Layouts/FrontEndLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    todo: Object,
});

const form = useForm({})

const deleteTodo = (TodoId) => {

    if(confirm('Veut tu vraiment supprimer la tache ?')){
        return form.delete(route('todo.destroy', TodoId))
    }
}

</script>