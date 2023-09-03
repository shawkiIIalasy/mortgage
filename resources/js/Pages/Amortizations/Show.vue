<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import {ref} from "vue";
import {usePage} from '@inertiajs/vue3';

defineOptions({layout: DefaultLayout});

const page = usePage();
const loading = ref(false);
const loan = ref({});
const amortization = ref({});

const loadAmortization = () => {
    loading.value = true;
    axios
        .get(route('amortizations.show', {amortization: page.props.ziggy.route.parameters.id, loan: page.props.ziggy.route.parameters.loan}))
        .then(response => {
            amortization.value = response.data.data;
            loan.value = response.data.data.loan;
        }).finally(() => {
        loading.value = false;
    });
};

loadAmortization();
</script>

<template>
    <v-card variant="elevated" elevation="5" class="mb-5 rounded-lg">
        <v-card-title class="text-primary font-weight-bold">
            Loan Amortization Details:
        </v-card-title>
        <v-card-item>
            <v-card-text class="font-weight-bold">
                Month Number: {{ amortization.month_number }}
            </v-card-text>
            <v-card-text class="font-weight-bold">
                Starting Balance: {{ amortization.start_balance }}
            </v-card-text>
            <v-card-text class="font-weight-bold">
                Monthly Payment: {{ amortization.amount }}
            </v-card-text>
            <v-card-text class="font-weight-bold">
                Principal: {{ amortization.principal_amount }}
            </v-card-text>
            <v-card-text class="font-weight-bold">
                Interest: {{ amortization.interest_amount }}
            </v-card-text>
            <v-card-text class="font-weight-bold">
                Ending Balance: {{ amortization.end_balance }}
            </v-card-text>
        </v-card-item>
    </v-card>

    <v-card variant="elevated" elevation="5" class="mb-5 rounded-lg">
        <v-card-title class="text-primary font-weight-bold">
            Loans Details:
        </v-card-title>
        <v-card-item>
            <v-card-text class="font-weight-bold">
                Loan Amount: {{ loan.amount }}
            </v-card-text>
            <v-card-text class="font-weight-bold">
                Interest Rate: {{ loan.interest_rate }}%
            </v-card-text>
            <v-card-text class="font-weight-bold">
                Effective Interest Rate: {{ loan.yearly_effective_interest_rate }}%
            </v-card-text>
            <v-card-text class="font-weight-bold">
                Term: {{ loan.yearly_term }} years
            </v-card-text>
            <v-card-text v-if="loan.extra_payment" class="font-weight-bold">
                Fixed Monthly Extra Payment: {{ loan.extra_payment }}
            </v-card-text>
        </v-card-item>
    </v-card>
</template>
