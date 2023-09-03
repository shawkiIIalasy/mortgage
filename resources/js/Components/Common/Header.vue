<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <v-app-bar prominent>
        <Link :href="route('home')" class="text-decoration-none mx-5 d-flex align-center">
            <span class="px-2">
                <v-img src="/images/logo.png" height="30" width="30" class="rounded"/>
            </span>
            <span>
                <v-toolbar-title class="text-primary font-weight-bold">Mortgages</v-toolbar-title>
            </span>
        </Link>

        <v-spacer></v-spacer>

        <v-tooltip text="Developed by Shawki Alassi">
            <template v-slot:activator="{ props }">
                <v-btn v-bind="props" icon="mdi-information-variant-circle-outline" variant="flat" color="primary"/>
            </template>
        </v-tooltip>

    </v-app-bar>
</template>
