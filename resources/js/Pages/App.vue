<script setup>
import { Head } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import LoanTable from "@/Components/Loans/LoanTable.vue";

defineOptions({ layout: DefaultLayout });

</script>

<template>
    <Head title="Mortgages" />

    <v-card variant="elevated" elevation="5" class="mb-5 rounded-lg">
        <v-card-title class="text-primary font-weight-bold">
            Loans List
        </v-card-title>
        <v-card-item>
            <LoanTable />
        </v-card-item>
    </v-card>
</template>
