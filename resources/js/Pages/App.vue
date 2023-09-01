<script setup>
import { Head } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

defineOptions({ layout: DefaultLayout });

defineProps({
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Mortgage" />

    <div>
        Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
    </div>
</template>
