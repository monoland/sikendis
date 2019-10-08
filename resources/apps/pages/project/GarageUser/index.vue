<template>
    <v-page-wrap crud absolute searchable with-progress>
        <template #navigate>
            <v-btn-tips class="mr-2" @click="$router.go(-1)" label="garage" icon="arrow_back" :show="true" />
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
                        label="Nama Pengguna"
                        :color="$root.theme"
                        v-model="record.name"
                    ></v-text-field>
                </v-col>

                <v-col cols="4">
                    <v-select
                        label="Hak Akses"
                        :items="authents"
                        v-model="record.authent_id"
                    ></v-select>
                </v-col>

                <v-col cols="12">
                    <v-text-field
                        label="Alamat email"
                        :color="$root.theme"
                        v-model="record.email"
                    ></v-text-field>
                </v-col>
            </v-row>
        </v-page-form>
    </v-page-wrap>
</template>

<script>
import { pageMixins } from '@apps/mixins/PageMixins';

export default {
    name: 'page-garage-user',

    mixins: [pageMixins],

    route: [
        { path: 'garage/:garage/garage-user', name: 'garage-user', root: 'monoland' },
    ],

    computed: {
        authents: function() {
            if (this.combos && this.combos.hasOwnProperty('authents')) {
                return this.combos.authents;
            }
            
            return [];
        }
    },

    data:() => ({
        // 
    }),

    created() {
        this.tableHeaders([
            { text: 'Name', value: 'name' },
            { text: 'Updated', value: 'updated_at', class: 'datetime-field' }
        ]);

        this.pageInfo({
            icon: 'people',
            title: 'Pengguna',
        });

        this.dataUrl(`/api/garage/${this.$route.params.garage}/user`);

        this.setRecord({
            id: null,
            name: null,
            email: null,
            authent_id: null
        });
    }
};
</script>