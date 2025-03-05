<template>
    <Head title="Creer une tache" />
    <FrontEnd>
        <div class="mt-4 mx-4">
            <div class="flex justify-between">
                <h2>Ajouter une tache :</h2>
                <Link
                    :href="route('todo.index')"
                    class="bg-red-500 text-dark py-2 px-5 rounded mb-4 inline-block"
                >
                    Retour
                </Link>
            </div>
            <form @submit.prevent="saveTodo()">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-6">
                        <div class="mb-3">
                            <label>Titre de la tache</label>
                            <input
                                v-model="form.title"
                                type="text"
                                class="py-1 w-full"
                            >
                            <div v-if="errors.title">
                                {{ errors.title }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Plus d'infos sur la tache</label>
                            <textarea
                                v-model="form.more_info"
                                class="py-1 w-full"
                            />
                            <div v-if="errors.more_info">
                                {{ errors.more_info }}
                            </div>
                        </div>
                        <button
                            type="submit"
                            class="bg-blue-500 text-dark py-2 px-5 rounded mb-4"
                        >
                            Save
                        </button>
                        <Link
                            :href="route('todo.index')"
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

defineProps({
    errors: Object,
});

const form = useForm({
    title: "",
    more_info: "",
    statut: "",
});

const saveTodo = () => {

    const res = form.post(route('todo.store'));
    if(res){
        from.reset();
    }
}

</script>