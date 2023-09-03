<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import AmortizationTable from "@/Components/Amortizations/AmortizationTable.vue";
import ExtraPaymentTable from "@/Components/ExtraPayments/ExtraPaymentTable.vue";
import {ref} from "vue";
import {usePage} from '@inertiajs/vue3';

defineOptions({layout: DefaultLayout});

const page = usePage();
const loading = ref(false);
const loan = ref({});

const loadLoan = () => {
    loading.value = true;
    axios
        .get(route('loans.show', {id: page.props.ziggy.route.parameters.id}))
        .then(response => {
            loan.value = response.data.data;
        }).finally(() => {
        loading.value = false;
    });
};

loadLoan();
</script>

<template>
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
                Term: {{ loan.yearly_term }} years
            </v-card-text>
            <v-card-text v-if="loan.extra_payment" class="font-weight-bold">
                Fixed Monthly Extra Payment: {{ loan.extra_payment }}
            </v-card-text>
        </v-card-item>
    </v-card>

    <v-card variant="elevated" elevation="5" class="mb-5 rounded-lg">
        <v-card-title class="text-primary font-weight-bold">
            Loans Amortization Schedules Details:
        </v-card-title>
        <v-card-item>
            <AmortizationTable />
        </v-card-item>
    </v-card>

    <v-card variant="elevated" elevation="5" class="mb-5 rounded-lg">
        <v-card-title class="text-primary font-weight-bold">
            Loans Extra Payment Schedules Details:
        </v-card-title>
        <v-card-item>
            <ExtraPaymentTable />
        </v-card-item>
    </v-card>
</template>
