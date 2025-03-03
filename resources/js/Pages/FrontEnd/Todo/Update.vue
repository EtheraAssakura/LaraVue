<template>
    <FrontEnd>
        <Head title="Modifié une tache" />
        <div class="mt-4 mx-4">
            <div class="flex justify-between">
                <h2>Modifié la tache :</h2>
                <Link 
                    :href="route('todo.index')"
                    class="bg-red-500 text-dark py-2 px-5 rounded mb-4 inline-block"
                >
                    Retour
                </Link>
            </div>
            <form @submit.prevent="updateTodo()">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-6">
                        <div class="mb-3">
                            <label>Titre de la tache</label>
                            <input type="text" v-model="form.title" class="py-1 w-full">
                        </div>
                        <div class="mb-3">
                            <label>Plus d'infos sur la tache</label>
                            <textarea v-model="form.more_info" class="py-1 w-full"></textarea>
                        </div>
                        <Link 
                            :href="route('todo.index')"
                            class="bg-red-500 text-dark py-2 px-5 rounded mb-4 inline-block"
                        >
                            Retour
                        </Link>
                        <button
                            type="submit"
                            class="bg-blue-500 text-dark py-2 px-5 rounded mb-4"
                        >
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </FrontEnd>
</template>

<script setup>
import FrontEnd from '@/Layouts/FrontEndLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    todo: Object,
})

const form = useForm({
    title: props.todo.title,
    more_info: props.todo.more_info,
});

const updateTodo = () => {

    const res = form.put(route('todo.update', props.todo.id));
    if(res){
        from.reset();
    }
}

</script>