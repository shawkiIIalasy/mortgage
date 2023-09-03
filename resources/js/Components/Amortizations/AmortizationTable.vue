<script>
import { Link } from '@inertiajs/vue3';

export default {
    components: {Link},
    data: () => ({
        headers: [
            { title: 'Month Number', key: 'month_number', align: 'end' },
            { title: 'Starting Balance', key: 'start_balance', align: 'end' },
            { title: 'Monthly Payment', key: 'amount', align: 'end' },
            { title: 'Principal', key: 'principal_amount', align: 'end' },
            { title: 'Interest', key: 'interest_amount', align: 'end' },
            { title: 'Ending Balance', key: 'end_balance', align: 'end'},
            { title: 'Actions', key: 'actions', align: 'end' },
        ],
        itemPerPage: 15,
        items: [],
        meta: [],
        links: [],
        loading: true,
    }),
    async created() {
        await this.loadItems();
    },
    methods: {
        loadItems(page = 1) {
            this.loading = true
            axios
                .get(route('amortizations.index', {loan: this.$page.props.ziggy.route.parameters.id, page}))
                .then(response => {
                    this.items = response.data.data;
                    this.links = response.data.links;
                    this.meta = response.data.meta;
                }).finally(() => {
                    this.loading = false;
            });
        },
    },
}
</script>

<template>
    <v-data-table-server
        v-model:items-per-page="itemPerPage"
        :headers="headers"
        :items-length="parseInt(meta.total)"
        :items="items"
        :loading="loading"
        hide-actions
        @update:page="loadItems"
    >
    </v-data-table-server>
</template>
