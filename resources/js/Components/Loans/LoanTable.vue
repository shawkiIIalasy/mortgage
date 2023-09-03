<script>
import { Link } from '@inertiajs/vue3';

export default {
    components: {Link},
    data: () => ({
        headers: [
            { title: 'Id', key: 'id', align: 'end' },
            { title: 'Loan Amount', key: 'amount', align: 'end' },
            { title: 'Interest Rate', key: 'interest_rate', align: 'end' },
            { title: 'Term (years)', key: 'yearly_term', align: 'end'},
            { title: 'Fixed Monthly Extra Payment', key: 'extra_payment', align: 'end' },
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
                .get(route('loans.index', {page}))
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
        <template v-slot:item.actions="{ item }">
            <Link :href="route('views.loans.show', {id: item.raw.id})">
                <v-icon size="small" class="me-2" icon="mdi-magnify"/>
            </Link>
            <Link :href="route('views.loans.show', {id: item.raw.id})">
                <v-icon size="small" icon="mdi-pencil"/>
            </Link>
        </template>
    </v-data-table-server>
</template>
