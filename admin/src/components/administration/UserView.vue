<template>
  <div data-app>
    <v-container>
      <v-card class="p-3 mt-3">
        <v-container>
          <v-row>
            <v-col
              cols="12"
              sm="12"
              md="6"
              lg="6"
              xl="6"
              class="d-flex align-items-center"
            >
              <h2>{{ title }}</h2>
            </v-col>
            <!-- <v-col cols="12" sm="12" md="3" lg="3" xl="3" class="d-flex align-items-center"
                            style="justify-content: flex-end;">
                            <base-button type="primary" title="Agregar" @click="addRecord()" />
                        </v-col> -->
            <v-col cols="12" sm="12" md="6" lg="6" xl="6" class="">
              <v-text-field
                class="mt-3"
                variant="outlined"
                label="Buscar"
                type="text"
                v-model="search"
              ></v-text-field>
            </v-col>
          </v-row>
        </v-container>
        <v-data-table-server
          :headers="headers"
          :items-length="total"
          :items="records"
          :loading="loading"
          item-title="id"
          item-value="id"
          @update:options="getDataFromApi"
        >
          <template v-slot:[`item.actions`]="{ item }">
            <v-icon
              size="20"
              class="mr-2"
              @click="editItem(item.raw)"
              icon="mdi-pencil"
            />
            <!-- <v-icon size="20" class="mr-2" @click="deleteItem(item.raw)" icon="mdi-delete" /> -->
          </template>
          <template v-slot:no-data>
            <v-icon @click="initialize" icon="mdi-refresh" />
          </template>
        </v-data-table-server>
      </v-card>
    </v-container>

    <v-dialog v-model="dialog" max-width="800px" persistent>
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
              <!-- name -->
              <v-col cols="12" sm="6" md="6">
                <base-input
                  label="Nombre"
                  v-model="v$.editedItem.name.$model"
                  :rules="v$.editedItem.name"
                />
              </v-col>
              <!-- name -->

              <!-- company -->
              <v-col cols="12" sm="6" md="6">
                <base-input
                  label="Empresa"
                  v-model="v$.editedItem.company.$model"
                  :rules="v$.editedItem.company"
                />
              </v-col>
              <!-- company -->

              <!-- giro -->
              <v-col cols="12" sm="6" md="6">
                <base-input
                  label="Giro"
                  v-model="v$.editedItem.giro.$model"
                  :rules="v$.editedItem.giro"
                />
              </v-col>
              <!-- giro -->

              <!-- address -->
              <v-col cols="12" sm="6" md="6">
                <base-input
                  label="Dirección"
                  v-model="v$.editedItem.address.$model"
                  :rules="v$.editedItem.address"
                />
              </v-col>
              <!-- address -->

              <!-- department -->
              <v-col cols="12" sm="6" md="6">
                <base-input
                  label="Departamento"
                  v-model="v$.editedItem.department.$model"
                  :rules="v$.editedItem.department"
                />
              </v-col>
              <!-- department -->

              <!-- municipality -->
              <v-col cols="12" sm="6" md="6">
                <base-input
                  label="Municipio"
                  v-model="v$.editedItem.municipality.$model"
                  :rules="v$.editedItem.municipality"
                />
              </v-col>
              <!-- municipality -->

              <!-- nit -->
              <v-col cols="12" sm="4" md="4">
                <base-input
                  label="NIT"
                  v-model="v$.editedItem.nit.$model"
                  :rules="v$.editedItem.nit"
                />
              </v-col>
              <!-- nit -->

              <!-- iva -->
              <v-col cols="12" sm="4" md="4">
                <base-input
                  label="No. IVA"
                  v-model="v$.editedItem.iva.$model"
                  :rules="v$.editedItem.iva"
                />
              </v-col>
              <!-- iva -->

              <!-- dui -->
              <v-col cols="12" sm="4" md="4">
                <base-input
                  label="DUI"
                  v-model="v$.editedItem.dui.$model"
                  :rules="v$.editedItem.dui"
                />
              </v-col>
              <!-- dui -->

              <!-- phone -->
              <v-col cols="12" sm="4" md="4">
                <base-input
                  label="Teléfono fijo"
                  v-model="v$.editedItem.phone.$model"
                  :rules="v$.editedItem.phone"
                />
              </v-col>
              <!-- phone -->

              <!-- phone_call -->
              <v-col cols="12" sm="4" md="4">
                <base-input
                  label="Celular llamadas"
                  v-model="v$.editedItem.phone_call.$model"
                  :rules="v$.editedItem.phone_call"
                />
              </v-col>
              <!-- phone_call -->

              <!-- phone_whatsapp -->
              <v-col cols="12" sm="4" md="4">
                <base-input
                  label="Celular whatsapp"
                  v-model="v$.editedItem.phone_whatsapp.$model"
                  :rules="v$.editedItem.phone_whatsapp"
                />
              </v-col>
              <!-- phone_whatsapp -->

              <!-- email -->
              <v-col cols="12" sm="12" md="12">
                <base-input
                  label="Correo"
                  v-model="v$.editedItem.email.$model"
                  :rules="v$.editedItem.email"
                />
              </v-col>
              <!-- email -->

              <!-- rol  -->
              <v-col cols="12" sm="12" md="12">
                <v-select
                  variant="outlined"
                  label="Rol"
                  :items="roles"
                  item-title="name"
                  item-value="role"
                  v-model="v$.editedItem.role.$model"
                >
                </v-select>
              </v-col>
              <!-- rol -->
            </v-row>
            <!-- Form -->
            <v-row>
              <v-col align="center">
                <base-button type="secondary" style="background-color: #000C27" title="Guardar" @click="save" />
                <base-button
                  class="ms-1"
                  type="secondary"
                  style="background-color: #bd0102"
                  title="Cancelar"
                  @click="close"
                />
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
              <base-button
                type="primary"
                title="Confirmar"
                @click="deleteItemConfirm"
              />
              <base-button
                class="ms-1"
                type="secondary"
                title="Cancelar"
                @click="closeDelete"
              />
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
      dialog: false,
      dialogDelete: false,
      headers: [
        { title: "TIPO", key: "client_type" },
        { title: "NOMBRE", key: "name" },
        { title: "EMPRESA", key: "company" },
        { title: "NIT", key: "nit" },
        { title: "DUI", key: "dui" },
        { title: "CORREO", key: "email" },
        { title: "ACCIONES", key: "actions", sortable: false },
      ],
      records: [],
      roles: [],
      editedIndex: -1,
      title: "USUARIOS",
      total: 0,
      options: {},
      editedItem: {
        name: "",
        company: "",
        giro: "",
        address: "",
        department: "",
        municipality: "",
        nit: "",
        iva: "",
        dui: "",
        phone: "",
        phone_call: "",
        phone_whatsapp: "",
        email: "",
        client_type: 0,
        role: "",
      },
      defaultItem: {
        name: "",
        company: "",
        giro: "",
        address: "",
        department: "",
        municipality: "",
        nit: "",
        iva: "",
        dui: "",
        phone: "",
        phone_call: "",
        phone_whatsapp: "",
        email: "",
        client_type: 0,
        role: "",
      },
      loading: false,
      debounce: 0,
    };
  },

  watch: {
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  // Validations
  validations() {
    return {
      editedItem: {
        client_type: {
          minLength: minLength(1),
        },
        name: {
          minLength: minLength(1),
        },
        company: {
          minLength: minLength(1),
        },
        giro: {
          minLength: minLength(1),
        },
        address: {
          minLength: minLength(1),
        },
        department: {
          minLength: minLength(1),
        },
        municipality: {
          minLength: minLength(1),
        },
        nit: {
          minLength: minLength(1),
        },
        iva: {
          minLength: minLength(1),
        },
        dui: {
          minLength: minLength(1),
        },
        phone: {
          minLength: minLength(1),
        },
        phone_call: {
          minLength: minLength(1),
        },
        phone_whatsapp: {
          minLength: minLength(1),
        },
        email: {
          minLength: minLength(1),
        },
        role: {
          minLength: minLength(1),
        },
      },
    };
  },

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nuevo registro" : "Editar registro";
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

      let requests = [
        this.getDataFromApi(),
        backendApi.get("/role", {
          params: {
            itemsPerPage: -1,
          },
        }),
      ];

      const responses = await Promise.all(requests).catch((error) => {
        alert.error("No fue posible obtener el registro.");
      });

      if (responses) {
        this.roles = responses[1].data.data;
      }

      this.loading = false;
    },

    editItem(item) {
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
          const { data } = await backendApi.put(
            `updateUser/${edited.id}`,
            edited
          );

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
        const { data } = await backendApi.post(`user/`, this.editedItem);

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
        const { data } = await backendApi.delete(
          `/user/${this.editedItem.id}`,
          {
            params: {
              id: this.editedItem.id,
            },
          }
        );

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
          const { data } = await backendApi.get(`/user`, {
            params: { ...options, search: this.search },
          });

          this.records = data.data;
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
  },
};
</script>