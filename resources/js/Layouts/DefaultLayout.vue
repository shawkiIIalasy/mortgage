<script setup>
import Header from '@/Components/Common/Header.vue';
import Footer from "@/Components/Common/Footer.vue";
import LoanForm from "@/Components/Loans/LoanForm.vue";
import {ref} from "vue";

const dialog = ref(false);
</script>

<template>
    <v-app>
        <Header />
        <v-main>
            <v-container>
                <slot />

                <v-tooltip text="Create New Loan">
                    <template v-slot:activator="{ props }">
                        <v-btn v-bind="props" @click.stop="dialog = true" icon="mdi-plus" size="x-large" variant="flat" color="primary" class="position-fixed" style="bottom: 2rem; right: 2rem; z-index: 2" />
                    </template>
                </v-tooltip>

                <v-dialog
                    v-model="dialog"
                    max-width="600"
                >
                    <v-card class="mb-5">
                        <v-card-title>
                            Create New Loan
                        </v-card-title>
                        <v-card-item>
                            <LoanForm />
                        </v-card-item>
                    </v-card>
                </v-dialog>
            </v-container>
            <Footer />
        </v-main>
    </v-app>
</template>
