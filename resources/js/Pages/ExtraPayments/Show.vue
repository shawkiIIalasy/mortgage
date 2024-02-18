<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import {ref} from "vue";
import {usePage} from '@inertiajs/vue3';

defineOptions({layout: DefaultLayout});

const page = usePage();
const loading = ref(false);
const loan = ref({});
const extraPayment = ref({});

const loadExtraPayment = () => {
    loading.value = true;
    axios
        .get(route('extra-payments.show', {extra_payment: page.props.ziggy.route.parameters.id, loan: page.props.ziggy.route.parameters.loan}))
        .then(response => {
            extraPayment.value = response.data.data;
            loan.value = response.data.data.loan;
        }).finally(() => {
        loading.value = false;
    });
};

loadExtraPayment();
</script>

<template>
    <v-card variant="elevated" elevation="5" class="mb-5 rounded-lg">
        <v-card-title class="text-primary font-weight-bold">
            Loan Extra Payment Details:
        </v-card-title>
        <v-card-item>
            <v-card-text class="font-weight-bold">
                Month Number: {{ extraPayment.month_number }}
            </v-card-text>
            <v-card-text class="font-weight-bold">
                Starting Balance: {{ extraPayment.start_balance }}
            </v-card-text>
            <v-card-text class="font-weight-bold">
                Monthly Payment: {{ extraPayment.amount }}
            </v-card-text>
            <v-card-text class="font-weight-bold">
                Principal: {{ extraPayment.principal_amount }}
            </v-card-text>
            <v-card-text class="font-weight-bold">
                Interest: {{ extraPayment.interest_amount }}
            </v-card-text>
            <v-card-text class="font-weight-bold">
                Extra Payment: {{ extraPayment.extra_amount }}
            </v-card-text>
            <v-card-text class="font-weight-bold">
                Ending Balance: {{ extraPayment.end_balance }}
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
