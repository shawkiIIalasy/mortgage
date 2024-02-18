<script>
import Validation from "@/Mixins/Validation.js";
import ResponseAlert from "@/Components/Alerts/ResponseAlert.vue";
import {router} from "@inertiajs/vue3";
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

export default {
    layout: DefaultLayout,
    components: {ResponseAlert},
    mixins: [Validation],
    emits: ['onSuccess'],
    data: () => ({
        loan: {},
        loading: false,
        response: {
            type: '',
            message: '',
            messages: []
        }
    }),
    async created() {
        await this.loadLoan();
    },
    methods: {
        async loadLoan() {
            this.loading = true;
            await axios
                .get(route('loans.show', {id: this.$page.props.ziggy.route.parameters.id}))
                .then(response => {
                    this.loan = response.data.data;
                }).finally(() => {
                this.loading = false;
            });
        },
        submit() {
            this.$refs.loanForm.validate();
            if (!this.$refs.loanForm.isValid) {
                return;
            }
            this.loading = true
            const data = {
                "amount": this.loan.amount,
                "interest_rate": this.loan.interest_rate,
                "yearly_term": this.loan.yearly_term,
            };

            if (this.loan.extra_payment.length) {
                data['extra_payment'] = this.loan.extra_payment;
            }

            axios
                .put(route('loans.update', {id: this.$page.props.ziggy.route.parameters.id}), data)
                .then(response => {
                    this.response.type = 'success';
                    this.response.message = 'Loan Updated Successfully';
                    this.$refs.loanForm.reset();
                    this.$emit('onSuccess');
                    router.visit(route('views.loans.show', {id: response.data.data.id}));
                }).catch(error => {
                this.response.type = 'error';
                this.response.messages = Object.values(error.response.data.errors);
            }).finally(() => {
                this.loading = false;
            });

        }
    }
}
</script>

<template>
    <v-card>
        <v-card-title>Update Loan</v-card-title>
        <v-card-item>
            <ResponseAlert :type="response.type" :message="response.message" :messages="response.messages" class="mb-5"/>
            <v-form ref="loanForm" @submit.prevent="submit">
                <v-container>
                    <v-row>
                        <v-text-field
                            v-model="loan.amount"
                            :rules="[rules.required, rules.between(loan.amount, 0,100000)]"
                            label="Loan Amount"
                            required
                        ></v-text-field>
                    </v-row>

                    <v-row>
                        <v-text-field
                            v-model="loan.interest_rate"
                            :rules="[rules.required, rules.between(loan.interest_rate, 0,100)]"
                            label="Interest Rate"
                            required
                        ></v-text-field>
                    </v-row>
                    <v-row>
                        <div class="w-100">
                            <div class="text-caption">
                                Term (Years)
                            </div>
                            <v-slider
                                v-model="loan.yearly_term"
                                thumb-label="always"
                                :rules="[rules.between(loan.yearly_term, 1,35)]"
                                min="1"
                                max="35"
                                :step="1"
                            ></v-slider>
                        </div>
                    </v-row>

                    <v-row>
                        <v-text-field
                            v-model="loan.extra_payment"
                            :rules="[rules.between(loan.extra_payment, 0, loan.amount)]"
                            label="Fixed Monthly Extra Payment"
                        ></v-text-field>
                    </v-row>

                    <v-row class="justify-end">
                        <v-btn
                            :loading="loading"
                            type="submit"
                            class="my-2"
                            text="Submit"
                        ></v-btn>
                    </v-row>
                </v-container>
            </v-form>
        </v-card-item>
    </v-card>

</template>
