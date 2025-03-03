<template>
    <nav class="flex justify-between p-4 bg-gray-200">
        <div class="text-lg">
            Todo LaraVue
        </div>
        <div v-if="$page.props.auth.user" class="text-lg">
            {{ $page.props.auth.user.name }}
        </div>
        <div>
            <ul class="flex gap-x-4 me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <Link class="text-dark" :href="route('todo.index')"> Accueil </Link>
                </li>
                <li v-if="$page.props.auth.user" class="nav-item">
                    <button @click="logout" class="text-dark"> Logout </button>
                </li>
                <li v-if="!$page.props.auth.user" class="nav-item">
                    <Link class="text-dark" :href="route('login')"> Login </Link>
                </li>
                <li v-if="!$page.props.auth.user" class="nav-item">
                    <Link class="text-dark" :href="route('register')"> Register </Link>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';


const logout = () => {
    router.post(route('logout'), {}, {
        onSuccess: () => {
            alert('Vous avez été déconnecté');
        },
        onError: (errors) => {
            console.error('Erreur lors de la déconnexion:', errors);
            alert('Erreur lors de la déconnexion. Veuillez réessayer.');
        }
    });
};

</script>