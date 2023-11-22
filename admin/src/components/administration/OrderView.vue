<template>
    <div data-app>
        <v-container>
            <v-card class="p-3 mt-3">
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="12" md="6" lg="6" xl="6" class="d-flex align-items-center">
                            <h2>{{ title }}</h2>
                        </v-col>
                        <!-- <v-col cols="12" sm="12" md="3" lg="3" xl="3" class="d-flex align-items-center"
                            style="justify-content: flex-end;">
                            <base-button type="primary" title="Agregar" @click="addRecord()" />
                        </v-col> -->
                        <v-col cols="12" sm="12" md="6" lg="6" xl="6" class="">
                            <v-text-field class="mt-3" variant="outlined" label="Buscar" type="text"
                                v-model="search"></v-text-field>
                        </v-col>
                    </v-row>
                </v-container>

                <!-- filters -->
                <v-container class="pb-5 mb-5">
                    <v-row>
                        <v-tabs grow background-color="transparent">
                            <v-tab @click="filter = 'Reservada'">Reservadas</v-tab>
                            <v-tab @click="filter = 'Facturada'">Facturadas</v-tab>
                            <v-tab @click="filter = 'Anulada'">Anuladas</v-tab>
                        </v-tabs>
                    </v-row>
                </v-container>
                <!-- filters -->
                <v-data-table-server :headers="headers" :items-length="total" :items="records" :loading="loading"
                    item-title="id" item-value="id" @update:options="getDataFromApi">
                    <template v-slot:[`item.actions`]="{ item }">
                        <v-icon size="20" class="mr-2" @click="editItem(item.raw)" icon="mdi-eye" />
                        <!-- <v-icon size="20" class="mr-2" @click="editItem(item.raw)" icon="mdi-delete" /> -->
                        <!-- <v-icon size="20" class="mr-2" @click="deleteItem(item.raw)" icon="mdi-delete" /> -->
                    </template>
                    <template v-slot:no-data>
                        <v-icon @click="initialize" icon="mdi-refresh" />
                    </template>
                </v-data-table-server>
            </v-card>
        </v-container>

        <v-dialog v-model="dialog" max-width="900px" persistent>
            <v-card>
                <v-card-title>
                    <h2 class="mx-auto pt-3 mb-3 text-center black-secondary">
                        {{ formTitle }}
                    </h2>
                </v-card-title>

                <v-card-text>
                    <v-container>
                        <!-- Form -->
                        <v-row class="pt-3">
                            <v-col cols="12" sm="12" md="12">
                                <h2 class="fw-bold">ORDEN</h2>
                                <hr>
                            </v-col>

                            <!-- created_at -->
                            <v-col cols="12" sm="3" md="3">
                                <h4 class="text-normal text-uppercase">Pedido realizado</h4>
                                <p>{{ editedItem.created_at }}</p>
                            </v-col>
                            <!-- created_at -->
                            <!-- name -->
                            <v-col cols="12" sm="4" md="4">
                                <h4 class="text-normal text-uppercase">Usuario</h4>
                                <p>{{ editedItem.infoUser.name ?? editedItem.infoUser.company }}</p>
                            </v-col>
                            <!-- name -->
                            <!-- state -->
                            <v-col cols="12" sm="3" md="3">
                                <h4 class="text-normal text-uppercase">Estado</h4>
                                <p>{{ editedItem.state.name }}</p>
                            </v-col>
                            <!-- state -->
                            <!-- subtotal -->
                            <v-col cols="12" sm="2" md="2">
                                <h4 class="text-normal text-uppercase">Total</h4>
                                <p>${{ editedItem.subtotal }}</p>
                            </v-col>
                            <!-- subtotal -->
                            <!-- typeDelivery -->
                            <v-col cols="12" sm="4" md="4">
                                <h4 class="text-normal text-uppercase">Tipo de entrega</h4>
                                <p>{{ editedItem.typeDelivery == 'delivery' ? 'A domicilio' : 'Entrega en tienda' }}</p>
                            </v-col>
                            <!-- typeDelivery -->
                            <!-- store -->
                            <v-col cols="12" sm="4" md="4">
                                <h4 class="text-normal text-uppercase">Tienda</h4>
                                <p>{{ editedItem.store.name }}</p>
                            </v-col>
                            <!-- store -->
                            <!-- address -->
                            <v-col cols="12" sm="4" md="4">
                                <h4 class="text-normal text-uppercase">Dirección</h4>
                                <p>{{ editedItem.store.address }}</p>
                            </v-col>
                            <!-- address -->



                            <v-col cols="12" sm="12" md="12">
                                <h2 class="fw-bold pt-5">DETALLE DE LA ORDEN</h2>
                                <hr>
                            </v-col>
                            <v-col cols="12" sm="12" md="12">
                                <v-table>
                                    <thead>
                                        <tr>
                                            <th class="text-left">
                                                Producto
                                            </th>
                                            <th class="text-left">
                                                Cantidad
                                            </th>
                                            <th class="text-left">
                                                Precio
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(cart, index) in editedItem.cart" :key="index">
                                            <td style="width: 40%;">
                                                <p>{{ cart.product.titulo }}</p>
                                            </td>
                                            <td>
                                                <p>{{ cart.quantity }}</p>
                                            </td>
                                            <td>
                                                <p>{{ cart.price.toFixed(2) }}</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </v-table>
                            </v-col>
                            <v-col cols="12" sm="12" md="12">
                                <h2 class="fw-bold pt-5">Estado</h2>
                                <hr>
                            </v-col>
                            <!-- state_name  -->
                            <v-col cols="12" sm="12" md="12">
                                <v-select variant="outlined" label="Estado" :items="states" item-title="name"
                                    item-value="name" v-model="v$.editedItem.state.name.$model">
                                </v-select>
                            </v-col>
                            <!-- state_name -->
                        </v-row>
                        <!-- Form -->
                        <v-row>
                            <v-col align="center">
                                <base-button type="primary" title="Guardar" @click="changeState" />
                                <base-button class="ms-1" type="secondary" title="Cancelar" @click="close" />
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
            </v-card>
        </v-dialog>

        <v-dialog v-model="dialogDelete" max-width="400px">
            <v-card class="h-100">
                <v-container>
                    <h1 class="black-secondary text-center mt-3 mb-3">
                        Eliminar registro
                    </h1>
                    <v-row>
                        <v-col align="center">
                            <base-button type="primary" title="Confirmar" @click="deleteItemConfirm" />
                            <base-button class="ms-1" type="secondary" title="Cancelar" @click="closeDelete" />
                        </v-col>
                    </v-row>
                </v-container>
            </v-card>
        </v-dialog>
    </div>
</template>
  
<script>
import { useVuelidate } from "@vuelidate/core";
import { messages } from "@/utils/validators/i18n-validators";
import { helpers, minLength, required, email } from "@vuelidate/validators";

import orderApi from "@/services/orderApi";
import backendApi from "@/services/backendApi";

import BaseButton from "@/components/base-components/BaseButton.vue";
import BaseInput from "@/components/base-components/BaseInput.vue";
import BaseSelect from "@/components/base-components/BaseSelect.vue";
import useAlert from "@/composables/useAlert";

const { alert } = useAlert();
const langMessages = messages["es"].validations;

export default {
    components: { BaseButton, BaseInput, BaseSelect },
    setup() {
        return { v$: useVuelidate() };
    },
    data() {
        return {
            search: "",
            selected: [],
            filter: "Reservada",
            dialog: false,
            dialogDelete: false,
            headers: [
                { title: "USUARIO", key: "infoUser.name", sortable: false },
                { title: "TIENDA", key: "store.name", sortable: false },
                { title: "SUBTOTAL", key: "subtotal", sortable: false },
                { title: "FECHA", key: "created_at", sortable: false },
                { title: "ACCIONES", key: "actions", sortable: false },
            ],
            records: [],
            editedIndex: -1,
            title: "ORDENES",
            total: 0,
            options: {},
            editedItem: {
                name: "",
                address: "",
                subtotal: "",
                created_at: "",
                typeDelivery: "",
                state: {
                    name: ""
                },
            },
            defaultItem: {
                name: "",
                address: "",
                subtotal: "",
                created_at: "",
                typeDelivery: "",
                state: {
                    name: ""
                },
            },
            loading: false,
            debounce: 0,
            states: []
        };
    },

    // Validations
    validations() {
        return {
            editedItem: {
                name: {
                    minLength: minLength(1),
                },
                address: {
                    minLength: minLength(1),
                },
                subtotal: {
                    minLength: minLength(1),
                },
                created_at: {
                    minLength: minLength(1),
                },
                typeDelivery: {
                    minLength: minLength(1),
                },
                state: {
                    name: {
                        minLength: minLength(1),
                    },
                },
            },
        };
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "Nuevo registro" : " ";
        },
    },

    watch: {
        search(val) {
            this.getDataFromApi();
        },
        dialog(val) {
            val || this.close();
        },
        dialogBlock(val) {
            val || this.closeBlock();
        },
        dialogDelete(val) {
            val || this.closeDelete();
        },
        filter: {
            handler() {
                this.getDataFromApi();
            },
        },
    },

    created() {
        this.initialize();
    },

    beforeMount() {
        this.getDataFromApi({ page: 1, itemsPerPage: 10, sortBy: [], search: "" });
    },

    methods: {
        async initialize() {
            this.loading = true;
            this.records = [];

            let requests = [this.getDataFromApi(), backendApi.get('/state', {
                params: {
                    itemsPerPage: -1
                }
            })];

            const responses = await Promise.all(requests).catch((error) => {
                alert.error("No fue posible obtener el registro.");
            });

            if (responses) {
                this.states = responses[1].data.data;
            }

            this.loading = false;
        },

        editItem(item) {
            console.log(item)
            this.editedIndex = this.records.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        close() {
            this.dialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        async save() {
            this.v$.$validate();
            if (this.v$.$invalid) {
                alert.error("Campos obligatorios");
                return;
            }

            // Updating record
            if (this.editedIndex > -1) {
                const edited = Object.assign(
                    this.records[this.editedIndex],
                    this.editedItem
                );

                try {
                    const { data } = await backendApi.put(`/order/${edited.id}`, edited);

                    alert.success(data.message);
                } catch (error) {
                    alert.error("No fue posible actualizar el registro.");
                }

                this.close();
                this.initialize();
                return;
            }

            //Creating record
            try {
                const { data } = await backendApi.post(`/order`, this.editedItem);

                alert.success(data.message);
            } catch (error) {
                alert.error("No fue posible crear el registro.");
            }

            this.close();
            this.initialize();
            return;
        },

        deleteItem(item) {
            this.editedIndex = this.records.indexOf(item);
            this.editedItem = Object.assign({}, item);

            this.dialogDelete = true;
        },

        closeDelete() {
            this.dialogDelete = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        async deleteItemConfirm() {
            try {
                const { data } = await backendApi.delete(`/order/${this.editedItem.id}`, {
                    params: {
                        id: this.editedItem.id,
                    },
                });

                alert.success(data.message);
            } catch (error) {
                this.close();
            }

            this.initialize();
            this.closeDelete();
        },

        getDataFromApi(options) {
            this.loading = true;
            this.records = [];

            //debounce
            clearTimeout(this.debounce);
            this.debounce = setTimeout(async () => {
                try {
                    const { data } = await backendApi.get(`/order`, {
                        params: { ...options, search: this.search, filter: this.filter, },
                    });

                    this.records = data.data;
                    console.log(this.records);
                    this.total = data.total;
                    this.loading = false;
                } catch (error) {
                    alert.error("No fue posible obtener los registros.");
                }
            }, 500);
        },

        addRecord() {
            this.dialog = true;
            this.editedIndex = -1;
            this.editedItem = Object.assign({}, this.defaultItem);
            this.v$.$reset();
        },

        async changeState() {
            try {
                const { data } = await backendApi.post(`/order/changeState`, {
                    id: this.editedItem.id, state: this.editedItem.state.name
                });

                alert.success(data.message);
            } catch (error) {
                alert.error("No fue posible actualizar el registro.");
            }

            this.close();
            this.initialize();
        },
    },
};
</script>