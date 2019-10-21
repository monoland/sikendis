<template>
    <v-page-wrap crud absolute searchable with-progress>
        <template #toolbar-default>
            <v-btn-tips @click="openLink" label="PENGGUNA" icon="photo_filter" :show="!disabled.link" />
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
                        hide-details
                    ></v-text-field>
                </v-col>

                <v-col cols="12">
                    <v-switch 
                        label="Tetapkan sebagai biro penanggung jawab."
                        v-model="record.root" 
                        hide-details
                        inset 
                    ></v-switch>
                </v-col>
            </v-row>
        </v-page-form>
    </v-page-wrap>
</template>

<script>
import { pageMixins } from '@apps/mixins/PageMixins';

export default {
    name: 'page-agency',

    mixins: [pageMixins],

    route: [
        { path: 'agency', name: 'agency', root: 'monoland' },
    ],

    data:() => ({
        // 
    }),

    created() {
        this.auth.pageinfo = null;

        this.tableHeaders([
            { text: 'Name', value: 'name' },
            { text: 'Updated', value: 'updated_at', class: 'datetime-field' }
        ]);

        this.pageInfo({
            icon: 'people',
            title: 'Daftar OPD',
        });

        this.dataUrl(`/api/agency`);

        this.setRecord({
            id: null,
            name: null,
        });
    },

    methods: {
        openLink: function() {
            this.auth.pageinfo = this.record.name;
            this.$router.push({ name: 'agency-user', params: { agency: this.record.id } });
        },
    }
};
</script>