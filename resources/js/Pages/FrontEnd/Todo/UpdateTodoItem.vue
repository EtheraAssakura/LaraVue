<template>
    <Head title="Modifié une tache" />
    <FrontEnd>
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
                            <input
                                v-model="form.title"
                                type="text"
                                class="py-1 w-full"
                            >
                        </div>
                        <div class="mb-3">
                            <label>Plus d'infos sur la tache</label>
                            <textarea
                                v-model="form.more_info"
                                class="py-1 w-full"
                            />
                        </div>
                        <div class="mb-3">
                            <label>Statut</label>
                            <select v-model="form.statut">
                                <option value="to do">
                                    To do
                                </option>
                                <option value="en cours">
                                    En cours
                                </option>
                                <option value="termine">
                                    Terminé
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Tags</label>
                            <input
                                v-model="form.tags"
                                type="text"
                                class="py-1 w-full"
                                placeholder="Séparez les tags par des virgules"
                            >
                        </div>
                        <button
                            type="submit"
                            class="bg-blue-500 text-dark py-2 px-5 rounded mb-4"
                        >
                            Update
                        </button>
                        <Link
                            :href="route('todo.show', todo.id)"
                            class="bg-red-500 text-dark py-2 px-5 rounded mb-4 inline-block"
                        >
                            Retour
                        </Link>
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
    statut: props.todo.statut,
    tags: props.todo.tags.map(tags => tags.name.en).join(', '),
});


const updateTodo = () => {

    const res = form.put(route('todo.update', props.todo.id));
    if(res){
        from.reset();
    }
}

</script>