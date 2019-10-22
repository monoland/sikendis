<template>
    <v-page-wrap :enable-delete="enableDelete" :enable-edit="enableEdit" crud absolute searchable with-progress>
        <template #toolbar-default>
            <template v-if="auth.authent === 'kabiro' || auth.authent === 'pptk' || auth.authent === 'kpa'">
                <v-btn-tips @click="openApproval" label="PERSETUJUAN" icon="verified_user" :show="!disabled.link" />
            </template>
            
            <template v-if="auth.authent === 'operator' && (record.status === 'approval' || record.status === 'work-order')">
                <v-btn-tips @click="openDelivery" label="SURAT JALAN" icon="local_shipping" :show="!disabled.link" />
            </template>
            
            <template v-if="auth.authent === 'tata-usaha'">
                <v-btn-tips @click="openInvoice" label="INVOICE" icon="payment" :show="!disabled.link" />
            </template>
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
                <v-col md="10" sm="12">
                    <v-combobox
                        label="No. Polisi"
                        :items="polices"
                        :color="$root.theme"
                        v-model="record.vehicle"
                    ></v-combobox>
                </v-col>

                <v-col md="2" sm="12">
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

        <!-- approval -->
        <v-page-dialog
            title="Persetujuan"
            subtitle="form persetujuan pengajuan service"
            submit-name="approve"
            v-model="approval"
            small
            @approve="submitApprove"
            @cancel="approval = false"
        >
            <v-row>
                <v-col md="6" sm="12">
                    <v-combobox
                        label="No. Polisi"
                        :items="polices"
                        :color="$root.theme"
                        v-model="record.vehicle"
                        readonly
                    ></v-combobox>
                </v-col>

                <v-col md="4" sm="12" v-if="auth.authent === 'pptk' || auth.authent === 'kpa'">
                    <v-combobox
                        label="Bengkel"
                        :items="garages"
                        :color="$root.theme"
                        :readonly="auth.authent === 'kpa'"
                        v-model="record.garage"
                    ></v-combobox>
                </v-col>

                <v-col md="2" sm="12">
                    <v-date-menu
                        type="month"
                        label="Periode"
                        :color="$root.theme"
                        v-model="record.periode"
                        readonly
                    ></v-date-menu>
                </v-col>

                <v-col cols="12">
                    <v-textarea
                        label="Catatan"
                        :color="$root.theme"
                        v-model="record.notes"
                        readonly
                    ></v-textarea>
                </v-col>
            </v-row>
        </v-page-dialog>

        <!-- spk -->
        <v-page-dialog
            title="Surat Perintah Kerja"
            subtitle="preview surat perintah kerja"
            submit-name="print"
            v-model="preview"
            @print="printDelivery"
            @cancel="preview = false"
        >
            <v-row id="print-area">
                <v-col cols="12" align="center">
                    <div class="title text-uppercase font-weight-bold">surat perintah kerja</div>
                    <div class="subtitle-2 text-uppercase">nomor: {{ record.id + '/' + record.periode + '/BIROUMUM' }}</div>
                </v-col>

                <v-col cols="12">
                    <div class="body-1">Kepada Yth;</div>
                    <div class="body-1"><span class="field d-inline-block" style="width: 100px;">Perusahaan</span><span class="value font-weight-bold">: {{ record.garage ? record.garage.text : '' }}</span></div>
                    <div class="body-1"><span class="field d-inline-block" style="width: 100px;">Alamat</span><span class="value font-weight-bold">: {{ record.garage ? record.garage.address : '' }}</span></div>
                    <div class="body-1"><span class="field d-inline-block" style="width: 100px;">Telepon</span><span class="value font-weight-bold">: {{ record.garage ? record.garage.phone : '' }}</span></div>
                    <p>&nbsp;</p>
                    <div class="body-1">Untuk melaksanakan service kendaraan roda 2 (dua) dan atau kendaraan roda 4 (empat) dan atau kendaraan roda 6 (enam) milik Pemerintah Provinsi Banten, sesuai data berikut ini:</div>
                    <div class="body-1"><span class="field d-inline-block" style="width: 100px;">Merek</span><span class="value font-weight-bold">: {{ record.vehicle ? record.vehicle.brand : '' }}</span></div>
                    <div class="body-1"><span class="field d-inline-block" style="width: 100px;">Type</span><span class="value font-weight-bold">: {{ record.vehicle ? record.vehicle.type : '' }}</span></div>
                    <div class="body-1"><span class="field d-inline-block" style="width: 100px;">No. Polisi</span><span class="value font-weight-bold">: {{ record.police_id }}</span></div>
                    <div class="body-1"><span class="field d-inline-block" style="width: 100px;">Pemegang</span><span class="value font-weight-bold">: {{ record.vehicle ? record.vehicle.name : '' }}</span></div>
                    <p>&nbsp;</p>
                </v-col>
                <v-col cols="6"></v-col>
                <v-col cols="6" align="center">
                    <div class="body-1">Serang, {{ record.created_at }}</div>
                    <div class="body-1 text-uppercase font-weight-bold">kepala biro umum</div>
                    <div class="body-1 text-uppercase font-weight-bold">setda provinsi banten</div>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <div class="body-1 font-weight-bold">Drs. H. AHMAD SYAUKANI, M.Si</div>
                </v-col>
            </v-row>
        </v-page-dialog>

        <!-- invoice -->
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
                    >
                        <template v-slot:item.qty="{ value }">
                            {{ $root.formatCurrency(value) }}
                        </template>

                        <template v-slot:item.price="{ value }">
                            {{ $root.formatCurrency(value) }}
                        </template>

                        <template v-slot:item.amount="{ value }">
                            {{ $root.formatCurrency(value) }}
                        </template>
                    </v-data-table>
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
        enableDelete: function() {
            return this.record.status === 'disposition';
        },

        enableEdit: function() {
            return this.auth.authent === 'operator' && this.record.status === 'disposition';
        },

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
        approval: false,
        invoice: false,
        preview: false,

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
            { text: 'Qty', sortable: false, align: 'end', value: 'qty' },
            { text: 'Harga', sortable: false, align: 'end', value: 'price' },
            { text: 'Total', sortable: false, align: 'end', value: 'amount' },
        ]
    }),

    created() {
        this.tableHeaders([
            { text: 'No.Pol', value: 'police_id' },
            { text: 'Periode', value: 'periode' },
            { text: 'Status', value: 'status' },
            { text: 'Updated', value: 'updated_at', class: 'datetime-field' }
        ]);

        this.pageInfo({
            icon: 'people',
            title: 'Pengajuan Service',
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
                notes: null,
                status: null
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
            this.approval = true;
        },

        openDelivery: function() {
            this.preview = true;
        },

        submitApprove: async function() {
            try {
                switch (this.auth.authent) {
                    case 'kabiro':
                        await this.http.post(`/api/service/${this.record.id}/submission`);        
                        break;
                    
                    case 'pptk':
                        await this.http.post(`/api/service/${this.record.id}/examine`, {
                            garage: this.record.garage.value
                        });
                        break;
                    
                    case 'kpa':
                        await this.http.post(`/api/service/${this.record.id}/approval`);
                        break;
                
                    default:
                        break;
                }

                this.approval = false;
                this.recordReload();
            } catch (error) {
                this.$store.dispatch('errors', error);   
            }
        },

        printDelivery: async function() {
            try {
                if (this.record.status === 'approval') {
                    await this.http.post(`/api/service/${this.record.id}/workorder`);
                }

                let win = window.open('', 'PRINT', 'height=600,width=800');
                    win.document.write('<html>');
                    win.document.write('<head>');
                    win.document.write('<title>Print Preview</title>');
                    win.document.write('</head>');
                    win.document.write('<body>');
                    win.document.write('<div data-app="true" class="v-application v-application--is-ltr theme--light">');
                    win.document.write('<div class="v-application--wrap">');
                    win.document.write('<main class="v-content">');
                    win.document.write('<div class="v-content__wrap">');
                    win.document.write('<div class="row" style="padding-top: 160px; background-color: #ffffff;">');
                    win.document.write(document.getElementById('print-area').innerHTML);
                    win.document.write('</div>');
                    win.document.write('</div>');
                    win.document.write('</main>');
                    win.document.write('</div>');
                    win.document.write('</div>');
                    win.document.write('</body>');
                    win.document.write('</html>');

                let css = win.document.createElement('link');
                    css.type = 'text/css';
                    css.rel = 'stylesheet';
                    css.href = '/styles/monoland.css?version=1'; 
                    css.media = 'all';
                    win.document.getElementsByTagName("head")[0].appendChild(css);

                setTimeout(() => {
                    win.document.close();
                    win.focus();
                    win.print();
                    win.close();
                }, 500);

                this.preview = false;
                this.recordReload();
            } catch (error) {
                this.$store.dispatch('errors', error);   
            }
        }
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