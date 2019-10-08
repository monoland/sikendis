<template>
    <v-menu ref="datepicker"
        :close-on-content-click="false"
        :return-value.sync="date"
        v-model="modal"
        offset-y
        width="290px"
    >
        <template v-slot:activator="{ on }">
            <v-text-field
                autocomplete="off"
                v-model="date"
                :color="color"
                :label="label"
                readonly
                v-on="on"
            ></v-text-field>
        </template>

        <v-date-picker v-model="date" no-title :type="type" @input="$refs.datepicker.save(date)"></v-date-picker>
    </v-menu>
</template>

<script>
export default {
    name: 'v-date-menu',

    props: {
        color: {
            type: String,
            default: ''
        },

        label: {
            type: String,
            default: ''
        },

        type: {
            type: String,
            default: 'date'
        },

        value: null
    },

    data:() => ({
        date: null,
        modal: false
    }),
    
    created() {
        if (this.value) this.date = this.value;
    },

    watch: {
        date: function (newVal) {
            if (newVal) this.$emit('input', newVal);
        },

        value: function(newVal) {
            if (newVal) this.date = newVal;
        }
    }
};
</script>