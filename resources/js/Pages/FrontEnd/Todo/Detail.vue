<template>
    <FrontEnd>
        <Head title="Tache" />
        <div class="mt-4 mx-4">
            <div class="flex justify-between">
                <h2>{{ todo.title }}</h2>
            </div>
            <p>{{ todo.more_info }}</p>
            <br>
        
            <Link 
                :href="route('todo.edit', todo.id)"
                class="edit text-white py-2 px-5 rounded"
            >
                Edit
            </Link>
            <button
                @click="deleteTodo(todo.id)"
                class="bg-red-500 py-2 px-5 rounded"
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