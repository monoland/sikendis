<template>
    <v-page-wrap crud absolute searchable with-progress>
        <template #navigate>
            <v-btn-tips @click="$router.go(-1)" label="brand" icon="arrow_back" :show="true" />
        </template>

        <template #toolbar-default>
            <v-btn-tips @click="openLink" label="item" icon="photo_filter" :show="!disabled.link" />
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
            this.$router.push({ name: 'vehicle', query: { type: this.record.id } });
        },
    }
};
</script>