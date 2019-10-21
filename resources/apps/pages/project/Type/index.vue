<template>
    <v-page-wrap crud absolute searchable with-progress>
        <template #navigate>
            <v-btn-tips @click="$router.go(-1)" label="brand" icon="arrow_back" :show="true" />
        </template>

        <template #toolbar-default>
            <v-btn-tips @click="openLink" label="DAFTAR-KENDARAAN" icon="photo_filter" :show="!disabled.link" />
        </template>

        <v-widget table v-if="desktop">
            <v-data-table
                v-model="table.selected"
                :headers="headers"
                :items="records"
                :single-select="true"
                :loading="table.loader"
                :options.sync="table.options"
                :server-items-length="table.total"
                :footer-props="table.footerProps"
                item-key="id"
                show-select
            >
                <template #:progress>
                    <v-progress-linear :color="color" height="1" indeterminate></v-progress-linear>
                </template>

                <template v-slot:item.maxi="{ value }">
                    {{ $root.formatCurrency(value) }}
                </template>

                <template v-slot:item.warn="{ value }">
                    {{ $root.formatCurrency(value) }}
                </template>
            </v-data-table>
        </v-widget>

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
                <v-col cols="12">
                    <v-text-field
                        label="Nama"
                        :color="$root.theme"
                        v-model="record.name"
                    ></v-text-field>
                </v-col>

                <v-col cols="4">
                    <v-text-field
                        label="Tahun"
                        :color="$root.theme"
                        v-model="record.year"
                    ></v-text-field>
                </v-col>

                <v-col cols="4">
                    <v-number-field
                        label="Pagu"
                        :color="$root.theme"
                        v-model="record.maxi"
                    ></v-number-field>
                </v-col>

                <v-col cols="4">
                    <v-number-field
                        label="Pengingat"
                        :color="$root.theme"
                        v-model="record.warn"
                    ></v-number-field>
                </v-col>
            </v-row>
        </v-page-form>
    </v-page-wrap>
</template>

<script>
import { pageMixins } from '@apps/mixins/PageMixins';

export default {
    name: 'page-type',

    mixins: [pageMixins],

    route: [
        { path: 'brand/:brand/type', name: 'type', root: 'monoland' },
    ],

    data:() => ({
        // 
    }),

    created() {
        this.tableHeaders([
            { text: 'Name', value: 'name' },
            { text: 'Tahun', value: 'year' },
            { text: 'Pagu', value: 'maxi' },
            { text: 'Peringatan', value: 'warn' },
            { text: 'Updated', value: 'updated_at', class: 'datetime-field' }
        ]);

        this.pageInfo({
            icon: 'people',
            title: 'Type',
        });

        this.dataUrl(`/api/brand/${this.$route.params.brand}/type`);

        this.setRecord({
            id: null,
            name: null,
            year: null,
            maxi: 0,
            warn: 0
        });
    },

    methods: {
        openLink: function() {
            this.auth.pageinfo = this.auth.pageinfo + ' ' + this.record.name;
            
            this.$router.push({ name: 'vehicle', query: { type: this.record.id } });
        },
    }
};
</script>