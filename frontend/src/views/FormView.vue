<template>
  <div class="main-content main-content-login">
    <v-container>
      <v-row>
        <v-col cols="12" lg="12" md="12" sm="12" xs="12" class="content-area">
          <div class="site-main">
            <h3 class="custom_blog_title fw-bold">Cliente nuevo</h3>
            <div class="customer_login">
              <v-row style="justify-content: center">
                <v-col cols="12" lg="8" md="8" sm="8" class="col-lg-6 col-md-6 col-sm-12">
                  <div class="login-item">
                    <div class="title-login" style="
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                      ">
                      <h5 class="text-uppercase fw-bold">
                        Formulario cliente nuevo
                      </h5>
                      <img src="" alt="img" height="50" />
                    </div>
                    <form class="login">
                      <div class="social-account">
                        <h6 class="title-social">Documentos a presentar:</h6>
                        <h6 class="text-social">
                          Persona Natural no Contribuyente: DUI y NIT <br />
                          Contribuyente: Tarjeta de IVA y NIT, en caso de ser
                          Persona Natural Contribuyente debera presentar DUI,
                          Tarjeta de IVA y NIT
                        </h6>
                        <!-- <a href="#" class="mxh-item facebook">
                          <i
                            class="icon fa fa-facebook-square"
                            aria-hidden="true"
                          ></i>
                          <span class="text">FACEBOOK</span>
                        </a>
                        <a href="#" class="mxh-item twitter">
                          <i class="icon fa fa-twitter" aria-hidden="true"></i>
                          <span class="text">TWITTER</span>
                        </a> -->
                      </div>
                      <v-row>
                        <v-col cols="12" sm="12" md="4">
                          <BaseInput type="date" variant="outlined" label="Fecha" />
                        </v-col>
                        <v-col cols="12" sm="12" md="4">
                          <v-checkbox v-model="naturalPerson" label="No contribuyente"></v-checkbox>
                        </v-col>
                        <v-col cols="12" sm="12" md="4">
                          <v-checkbox v-model="company" label="Contribuyente"></v-checkbox>
                        </v-col>
                        <v-col cols="12" sm="12" md="12" v-if="naturalPerson">
                          <BaseInput type="text" variant="outlined" label="Nombre" />
                        </v-col>
                        <v-col cols="12" sm="12" md="12" v-if="company">
                          <BaseInput type="text" variant="outlined" label="Empresa" />
                        </v-col>
                        <v-col cols="12" sm="12" md="12" v-if="company">
                          <BaseInput type="text" variant="outlined" label="Giro" />
                        </v-col>
                        <v-col cols="12" sm="12" md="12" v-if="naturalPerson || company">
                          <BaseInput type="text" variant="outlined" label="Dirección" />
                        </v-col>
                        <v-col cols="12" sm="12" md="6" v-if="naturalPerson || company">
                          <BaseInput type="text" variant="outlined" label="Departamento" />
                        </v-col>
                        <v-col cols="12" sm="12" md="6" v-if="naturalPerson || company">
                          <BaseInput type="text" variant="outlined" label="Municipio" />
                        </v-col>
                        <v-col cols="12" sm="12" md="6" v-if="naturalPerson || company">
                          <BaseInput type="text" variant="outlined" label="NIT" />
                        </v-col>
                        <v-col cols="12" sm="12" md="6" v-if="company">
                          <BaseInput type="text" variant="outlined" label="Registro I.V.A." />
                        </v-col>
                        <v-col cols="12" sm="12" md="6" v-if="naturalPerson">
                          <BaseInput type="text" variant="outlined" label="DUI" />
                        </v-col>
                        <v-col cols="12" sm="12" md="6" v-if="naturalPerson || company">
                          <BaseInput type="text" variant="outlined" label="Teléfono fijo" />
                        </v-col>
                        <v-col cols="12" sm="12" md="6" v-if="naturalPerson || company">
                          <BaseInput type="text" variant="outlined" label="Celular llamadas" />
                        </v-col>
                        <v-col cols="12" sm="12" md="6" v-if="naturalPerson || company">
                          <BaseInput type="text" variant="outlined" label="Celular whatsapp" />
                        </v-col>
                        <v-col cols="12" sm="12" md="12" v-if="naturalPerson || company">
                          <BaseInput type="email" variant="outlined" label="Correo electónico" />
                        </v-col>
                      </v-row>
                      <p class="form-row pt-4">
                        <input type="submit" class="button-submit" value="Enviar" />
                      </p>
                      <h6 class="text-social text-black pt-4" style="
                          line-height: 15px;
                          font-size: 12px;
                          font-weight: 500;
                        ">

                      </h6>
                    </form>
                  </div>
                </v-col>
              </v-row>
            </div>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import BaseInput from "@/components/base-components/BaseInput.vue";
import BaseTextArea from "@/components/base-components/BaseTextArea.vue";
import BaseSelect from "@/components/base-components/BaseSelect.vue";

export default {
  components: { BaseInput, BaseTextArea, BaseSelect },

  data() {
    return {
      naturalPerson: "",
      company: "",
    };
  },
};
</script>

<style scope></style>