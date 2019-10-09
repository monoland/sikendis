<template>
    <v-page-wrap crud absolute searchable with-progress>
        <template #toolbar-default>
            <v-btn-tips @click="openLink" label="garage-user" icon="photo_filter" :show="!disabled.link" />
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
                <v-col cols="8">
                    <v-text-field
                        label="Nama"
                        :color="$root.theme"
                        v-model="record.name"
                    ></v-text-field>
                </v-col>

                <v-col cols="4">
                    <v-text-field
                        label="Telpon"
                        :color="$root.theme"
                        v-model="record.phone"
                    ></v-text-field>
                </v-col>

                <v-col cols="12">
                    <v-textarea
                        label="Alamat"
                        :color="$root.theme"
                        v-model="record.address"
                    ></v-textarea>
                </v-col>
            </v-row>
        </v-page-form>
    </v-page-wrap>
</template>

<script>
import { pageMixins } from '@apps/mixins/PageMixins';

export default {
    name: 'page-garage',

    mixins: [pageMixins],

    route: [
        { path: 'garage', name: 'garage', root: 'monoland' },
    ],

    data:() => ({
        // 
    }),

    created() {
        this.tableHeaders([
            { text: 'Nama Bengkel', value: 'name' },
            { text: 'Alamat', value: 'address' },
            { text: 'Telpon', value: 'phone' },
            { text: 'Updated', value: 'updated_at', class: 'datetime-field' }
        ]);

        this.pageInfo({
            icon: 'people',
            title: 'Daftar Bengkel',
        });

        this.dataUrl(`/api/garage`);

        this.setRecord({
            id: null,
            name: null,
        });
    },

    methods: {
        openLink: function() {
            this.$router.push({ name: 'garage-user', params: { garage: this.record.id } });
        },
    }
};
</script>