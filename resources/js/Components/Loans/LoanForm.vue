<script>
import Validation from "@/Mixins/Validation.js";
import ResponseAlert from "@/Components/Alerts/ResponseAlert.vue";

export default {
    components: {ResponseAlert},
    mixins: [Validation],
    data: () => ({
        amount: '',
        interest_rate: '',
        yearly_term: 0,
        extra_payment: '',
        loading: false,
        response: {
            type: '',
            message: '',
            messages: []
        },
    }),
    methods: {
        submit() {
            this.$refs.loanForm.validate();
            if (!this.$refs.loanForm.isValid) {
                return;
            }
            this.loading = true
            const data = {
                "amount": this.amount,
                "interest_rate": this.interest_rate,
                "yearly_term": this.yearly_term,
            };

            if (this.extra_payment.length) {
                data['extra_payment'] = this.extra_payment;
            }

            axios
                .post(route('loans.store'), data)
                .then(response => {
                    this.response.type = 'success';
                    this.response.message = 'Loan Created Successfully';
                    this.$refs.loanForm.reset();
                }).catch(error => {
                    console.log();
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
    <ResponseAlert :type="response.type" :message="response.message" :messages="response.messages" class="mb-5"/>
    <v-form ref="loanForm" @submit.prevent="submit">
        <v-container>
            <v-row>
                <v-text-field
                    v-model="amount"
                    :rules="[rules.required, rules.between(amount, 0,100000)]"
                    label="Loan Amount"
                    required
                ></v-text-field>
            </v-row>

            <v-row>
                <v-text-field
                    v-model="interest_rate"
                    :rules="[rules.required, rules.between(interest_rate, 0,100)]"
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
                        v-model="yearly_term"
                        thumb-label="always"
                        :rules="[rules.between(yearly_term, 1,35)]"
                        min="1"
                        max="35"
                        :step="1"
                    ></v-slider>
                </div>
            </v-row>

            <v-row>
                <v-text-field
                    v-model="extra_payment"
                    :rules="[rules.between(extra_payment, 0, amount)]"
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
</template>
