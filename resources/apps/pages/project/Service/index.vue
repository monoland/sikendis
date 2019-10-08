<template>
    <v-page-wrap crud absolute searchable with-progress>
        <template #toolbar-default>
            <v-btn-tips @click="openApproval" label="PERSETUJUAN" icon="verified_user" :show="!disabled.link" />
            <v-btn-tips @click="printDelivery" label="SURAT JALAN" icon="local_shipping" :show="!disabled.link" />
            <v-btn-tips @click="openInvoice" label="INVOICE" icon="payment" :show="!disabled.link" />
        </template>

        <v-desktop-table v-if="desktop"
            single
        ></v-desktop-table>

        <v-mobile-table icon="perm_identity" v-else>
            <template v-slot:default="{ item }">
                <v-list-item-content>
                    <v-list-item-title>{{ item.name }}</v-list-item-title>
                    <v-list-item-subtitle class="f-nunito">{{ item.email }}</v-list-item-subtitle>
                </v-list-item-content>
            </template>
        </v-mobile-table>

        <v-page-form small>
            <v-row>
                <v-col cols="6">
                    <v-combobox
                        label="No. Polisi"
                        :items="polices"
                        :color="$root.theme"
                        v-model="record.vehicle"
                    ></v-combobox>
                </v-col>

                <v-col cols="4">
                    <v-combobox
                        label="Bengkel"
                        :items="garages"
                        :color="$root.theme"
                        v-model="record.garage"
                    ></v-combobox>
                </v-col>

                <v-col cols="2">
                    <v-date-menu
                        type="month"
                        label="Periode"
                        :color="$root.theme"
                        v-model="record.periode"
                    ></v-date-menu>
                </v-col>

                <v-col cols="12">
                    <v-textarea
                        label="Catatan"
                        :color="$root.theme"
                        v-model="record.notes"
                    ></v-textarea>
                </v-col>
            </v-row>
        </v-page-form>

        <v-page-dialog
            title="Invoice"
            v-model="invoice"
            @cancel="closeInvoice"
            @submit="submitInvoice"
        >
            <v-row>
                <v-col cols="3">
                    <v-text-field
                        label="Refs Invoice"
                        v-model="record.refs_invoice"
                    ></v-text-field>
                </v-col>

                <v-col cols="6"></v-col>

                <v-col cols="3">
                    <v-date-menu
                        label="Tanggal"
                        v-model="record.date_invoice"
                    ></v-date-menu>
                </v-col>
            </v-row>

            <v-row>
                <v-col cols="7">
                    <v-combobox
                        autocomplete="off"
                        :items="items"
                        label="Item"
                        v-model="detail.item"
                        hide-details
                    ></v-combobox>
                </v-col>

                <v-col cols="2">
                    <v-number-field
                        label="Qty"
                        v-model="detail.qty"
                        hide-details
                    ></v-number-field>
                </v-col>

                <v-col cols="3">
                    <v-number-field
                        label="Harga"
                        v-model="detail.price"
                        hide-details
                    ></v-number-field>
                </v-col>

                <v-col cols="12">
                    <v-text-field
                        append-outer-icon="add"
                        label="Catatan"
                        @click:append-outer="addDetail"
                        v-model="detail.notes"
                    ></v-text-field>
                </v-col>
            </v-row>

            <v-row no-gutters>
                <v-col cols="12">
                    <v-data-table
                        :items="record.details"
                        :headers="detailHeaders"
                        hide-default-footer
                    ></v-data-table>
                </v-col>
            </v-row>

            <v-row>
                <v-col cols="9"></v-col>
                <v-col cols="3">
                    <v-number-field
                        align-right
                        label="Subtotal"
                        v-model="record.subtotal"
                        readonly
                        hide-details
                    ></v-number-field>
                </v-col>

                <v-col cols="9"></v-col>
                <v-col cols="3">
                    <v-number-field
                        align-right
                        label="Diskon"
                        v-model="record.disc"
                        hide-details
                    ></v-number-field>
                </v-col>

                <v-col cols="9"></v-col>
                <v-col cols="3">
                    <v-number-field
                        align-right
                        label="Pajak"
                        v-model="record.tax"
                        readonly
                        hide-details
                    ></v-number-field>
                </v-col>

                <v-col cols="9"></v-col>
                <v-col cols="3">
                    <v-number-field
                        align-right
                        label="Total"
                        v-model="record.total"
                        readonly
                    ></v-number-field>
                </v-col>
            </v-row>
            
        </v-page-dialog>
    </v-page-wrap>
</template>

<script>
import { pageMixins } from '@apps/mixins/PageMixins';

export default {
    name: 'page-service',

    mixins: [pageMixins],

    route: [
        { path: 'service', name: 'service', root: 'monoland' },
    ],

    computed: {
        garages: function() {
            if (this.combos && this.combos.hasOwnProperty('garages')) {
                return this.combos.garages;
            }
            
            return [];
        },

        polices: function() {
            if (this.combos && this.combos.hasOwnProperty('polices')) {
                return this.combos.polices;
            }
            
            return [];
        },

        items: function() {
            if (this.combos && this.combos.hasOwnProperty('items')) {
                return this.combos.items;
            }
            
            return [];
        },

        subtotal: function() {
            if (this.record.details) {
                return this.record.details.reduce((total, detail) => {
                    return total + parseFloat(parseInt(detail.qty) * parseFloat(detail.price));
                }, 0);
            } else {
                return 0;
            }
        },

        tax: function() {
            let calc = (parseFloat(this.record.subtotal) - parseFloat(this.record.disc)) * 10/100;

            if (isNaN(calc)) {
                return 0;
            }

            return calc;
        },

        total: function() {
            let calc = parseFloat(this.record.subtotal) - parseFloat(this.record.disc) - parseFloat(this.record.tax);
            
            if (isNaN(calc)) {
                return 0;
            }

            return calc;
        }
    },

    data:() => ({
        invoice: false,

        detail: {
            item: null,
            value: null,
            text: null,
            unit: null,
            qty: 0,
            price: 0,
            amount: 0,
            notes: null
        },

        detailHeaders: [
            { text: 'Item', sortable: false, value: 'text' },
            { text: 'Unit', sortable: false, value: 'unit' },
            { text: 'Qty', sortable: false, value: 'qty' },
            { text: 'Harga', sortable: false, value: 'price' },
            { text: 'Total', sortable: false, value: 'amount' },
        ]
    }),

    created() {
        this.tableHeaders([
            { text: 'No.Pol', value: 'police_id' },
            { text: 'Bengkel', value: 'garage.text' },
            { text: 'Periode', value: 'periode' },
            { text: 'Updated', value: 'updated_at', class: 'datetime-field' }
        ]);

        this.pageInfo({
            icon: 'people',
            title: 'Service',
        });

        this.dataUrl(`/api/service`);

        this.setRecord({
            id: null,
            vehicle: null,
            garage: null,
            periode: null,
            police_id: null,
            notes: null,
            subtotal: 0,
            disc: 0,
            tax: 0,
            total: 0,
            date_invoice: null,
            refs_invoice: null,
            details: [],
        });
    },

    methods: {
        openInvoice: function() {
            this.invoice = true;
        },

        closeInvoice: function() {
            this.invoice = false;
        },

        addDetail: function() {
            let item = this.detail.item;
                delete this.detail.item;

            this.detail.amount = parseInt(this.detail.qty) * parseFloat(this.detail.price);
            this.detail.value = item.value;
            this.detail.text = item.text;
            this.detail.unit = item.unit;

            this.record.details.push(this.detail);
            
            this.resetDetail();
        },

        resetDetail: function() {
            this.detail = {
                item: null,
                value: null,
                text: null,
                unit: null,
                qty: 0,
                price: 0,
                amount: 0,
                notes: null
            }
        },

        submitInvoice: async function() {
            try {
                await this.http.post(`/api/service/${this.record.id}/invoice`, this.record);
                this.$store.dispatch('message', 'proses simpan berhasil!');
                this.invoice = false;
            } catch (error) {
                this.$store.dispatch('errors', error);
            }
        },

        openApproval: function() {
            // 
        },

        printDelivery: function() {
            // 
        },
    },

    watch: {
        subtotal: function(newValue) {
            this.record.subtotal = newValue;
        },

        tax: function(newValue) {
            this.record.tax = newValue;
        },

        total: function(newValue) {
            this.record.total = newValue;
        }
    }
};
</script>