<script setup>
import { onMounted, ref } from "vue";

import { toast } from "vue3-toastify";

import { messages } from "@/utils/validators/i18n-validators";
import { helpers, minLength, required, email } from "@vuelidate/validators";

import backendApi from "@/services/backendApi";

import BaseInput from "@/components/base-components/BaseInput.vue";
import BaseTextArea from "@/components/base-components/BaseTextArea.vue";
import useVuelidate from "@vuelidate/core";

const langMessages = messages["es"].validations;

const contactInfo = ref({
  name: "",
  email: "",
  phone: "",
  company: "",
  message: "",
});

const rules = {
  name: {
    required: helpers.withMessage(langMessages.required, required),
    minLength: helpers.withMessage(
      ({ $params }) => langMessages.minLength($params),
      minLength(2)
    ),
  },
  email: {
    required: helpers.withMessage(langMessages.required, required),
    minLength: helpers.withMessage(
      ({ $params }) => langMessages.minLength($params),
      minLength(1)
    ),
    email: helpers.withMessage(langMessages.email, email),
  },
  phone: {
    required: helpers.withMessage(langMessages.required, required),
    minLength: helpers.withMessage(
      ({ $params }) => langMessages.minLength($params),
      minLength(9)
    ),
  },
  company: {
    required: helpers.withMessage(langMessages.required, required),
    minLength: helpers.withMessage(
      ({ $params }) => langMessages.minLength($params),
      minLength(1)
    ),
  },
  message: {
    required: helpers.withMessage(langMessages.required, required),
    minLength: helpers.withMessage(
      ({ $params }) => langMessages.minLength($params),
      minLength(1)
    ),
  },
};

const v$ = useVuelidate(rules, contactInfo);

const validateForm = async (e) => {
  e.preventDefault();
  await v$.value.$validate();

  if (v$.value.$invalid) {
    toast.error("Campos requeridos.");
    return;
  }

  try {
    const { data } = await backendApi.post(
      "/notification/email",
      contactInfo.value
    );

    // console.log(data)
    toast.success(data.message);
  } catch (error) {
    console.log(error);
    toast.error(error.response.data.message);
  }
};
</script>

<template>
  <!-- Contact section -->
  <section class="services-section contacto" id="services">
    <!-- Services Titles -->
    <div class="services-content-reverse services-content" style="background-color: #000c27">
      <!-- <div class="services-img"> -->
      <!-- <div class="google-map"> -->
      <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1mmAzkNtQxwAkTemiySh3FhQ2g9ZEaqs&ehbc=2E312F&noprof=1"
        width="650" height="450" style="border: 0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      <!-- </div> -->
      <!-- </div> -->
      <div class="services-text">
        <h3 class="services-title" style="color: #bd0102">CONTACTO</h3>
        <h1 class="services-subtitle text-white">
          Ut Provide Act <br />
          Nunc Elit Phasellus
        </h1>
        <p class="services-p mb-0 text-white">
          Lorem ipsum convallis enim nulla, ac euismod nunc<br />
          Ut commodo suscipit elit ac pulvinar. Lorem ipsum convallis enim
          nulla, <br />
          ac euismod nunc ullamcorper Ut commodo suscipit elit ac pulvinar.
        </p>
      </div>
    </div>
    <!-- /.Services Titles -->

    <div class="sucursales">
      <div class="services-text">
        <!-- <h3 class="services-title text-center">SUCURSALES</h3> -->
        <h1 class="services-subtitle text-center">Nuestras Sucursales</h1>
        <p class="services-p mb-0 text-center">
          Lorem ipsum convallis enim nulla, ac euismod nunc<br />
          Ut commodo suscipit elit ac pulvinar. Lorem ipsum convallis enim
          nulla.
        </p>
      </div>
    </div>

    <!-- Contact Us Section -->
    <!-- Services Cards -->
    <div class="contact-section" id="contact">
      <div class="service-reveal">
        <div class="row row-cols-1 row-cols-md-4 g-4">
          <div class="col mt-1">
            <div class="card-contact zoom">
              <div class="card-contact-content">
                <!-- <div class="card-contact-icon">
                  <img
                    src="/logos/map-marker-alt-solid.svg"
                    style="
                      filter: invert(5%) sepia(31%) saturate(6815%)
                        hue-rotate(209deg) brightness(90%) contrast(104%);
                    "
                    class="icon-contact"
                    alt="icon-contact"
                  />
                </div> -->
                <div class="card-contact-info">
                  <h4 class="card-contact-subtitle">San Salvador</h4>
                  <p class="fs-6">
                    Mundo Cerámico, Boulevar los Proceres, 1-A, San Salvador.
                  </p>
                  <hr class="mt-1 mb-1" />
                  <p class="mb-0 fs-6">Lunes - Viernes: 8:00 am - 6:00 pm</p>
                  <p class="mb-0 fs-6">Sabado: 8:00 am - 2:00 pm</p>
                  <hr />
                  <div class="pt-2">
                    <a href="https://ul.waze.com/ul?ll=13.68323591%2C-89.22569990&navigate=yes&zoom=17&utm_campaign=default&utm_source=waze_website&utm_medium=lm_share_location"
                      target="_blank" class="btn-waze">WAZE
                      <img src="logos/icon-waze-download.png" alt="waze button" /></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col mt-1">
            <div class="card-contact zoom">
              <div class="card-contact-content">
                <!-- <div class="card-contact-icon">
                  <img
                    src="/logos/paper-plane-regular.svg"
                    style="
                      filter: invert(5%) sepia(31%) saturate(6815%)
                        hue-rotate(209deg) brightness(90%) contrast(104%);
                    "
                    class="icon-contact"
                    alt="icon-contact"
                  />
                </div> -->
                <div class="card-contact-info">
                  <h4 class="card-contact-subtitle">Santa Ana</h4>
                  <p class="fs-6">
                    Mundo Cerámico, Barrio Nuevo, 10 Av. Sur y 25 Calle Poniente
                  </p>
                  <hr class="mt-1 mb-1" />
                  <p class="mb-0 fs-6">Lunes - Viernes: 8:00 am - 5:00 pm</p>
                  <p class="mb-0 fs-6">Sabado: 8:00 am - 12:00 m</p>
                  <hr />
                  <div class="pt-2">
                    <a href="https://ul.waze.com/ul?ll=13.98381677%2C-89.56349839&navigate=yes&zoom=17&utm_campaign=default&utm_source=waze_website&utm_medium=lm_share_location"
                      target="_blank" class="btn-waze">WAZE
                      <img src="logos/icon-waze-download.png" alt="waze button" /></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col mt-1">
            <div class="card-contact zoom">
              <div class="card-contact-content">
                <!-- <div class="card-contact-icon">
                  <img
                    src="/logos/calendar-alt-regular.svg"
                    style="
                      filter: invert(5%) sepia(31%) saturate(6815%)
                        hue-rotate(209deg) brightness(90%) contrast(104%);
                    "
                    class="icon-contact"
                    alt="icon-contact"
                  />
                </div> -->

                <div class="card-contact-info">
                  <h4 class="card-contact-subtitle">Sonsonate</h4>
                  <p class="fs-6">
                    Lotificación Inclan, Calle hacia Acajutla Lote 1-A
                  </p>
                  <hr class="mt-1 mb-1" />
                  <p class="mb-0 fs-6">Lunes - Viernes: 8:00 am - 5:00 pm</p>
                  <p class="mb-0 fs-6">Sabado: 8:00 am - 12:00 m</p>
                  <hr />
                  <div class="pt-2">
                    <a href="https://ul.waze.com/ul?ll=13.71366363%2C-89.72582568&navigate=yes&zoom=17&utm_campaign=default&utm_source=waze_website&utm_medium=lm_share_location"
                      target="_blank" class="btn-waze">WAZE
                      <img src="logos/icon-waze-download.png" alt="waze button" /></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col mt-1">
            <div class="card-contact zoom">
              <div class="card-contact-content">
                <!-- <div class="card-contact-icon">
                  <img
                    src="/logos/calendar-alt-regular.svg"
                    style="
                      filter: invert(5%) sepia(31%) saturate(6815%)
                        hue-rotate(209deg) brightness(90%) contrast(104%);
                    "
                    class="icon-contact"
                    alt="icon-contact"
                  />
                </div> -->

                <div class="card-contact-info">
                  <h4 class="card-contact-subtitle">Metapán</h4>
                  <p class="fs-6">
                    Barrio Nuevo, 5° Calle Oriente y Carretera Anguiatu
                  </p>
                  <hr class="mt-1 mb-1" />
                  <p class="mb-0 fs-6">Lunes - Viernes: 8:00 am - 5:00 pm</p>
                  <p class="mb-0 fs-6">Sabado: 8:00 am - 12:00 m</p>
                  <hr />
                  <div class="pt-2">
                    <a href="https://ul.waze.com/ul?ll=14.33301124%2C-89.44353927&navigate=yes&zoom=17&utm_campaign=default&utm_source=waze_website&utm_medium=lm_share_location"
                      target="_blank" class="btn-waze">WAZE
                      <img src="logos/icon-waze-download.png" alt="waze button" /></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Form -->
    <!-- <div class="page-main-content">
      <v-container>
        <v-row>
          <v-col sm="12">
            <v-card class="shadow">
              <v-row class="p-0">
                <v-col lg="8" class="no-padding">
                  <div class="form-message">
                    <h2 class="title">Envíanos un mensaje!</h2>
                    <form action="#" class="zentimo-contact-fom">
                      <v-row>
                        <v-col cols="12" sm="12" md="6" class="pt-0">
                          <BaseInput type="text" label="Nombre" v-model="v$.name.$model" :rules="v$.name" />
                        </v-col>

                        <v-col cols="12" sm="12" md="6" class="pt-0">
                          <BaseInput type="text" label="Celular" v-model="v$.phone.$model" :rules="v$.phone"
                            v-mask="'0000-0000'" />
                        </v-col>

                        <v-col cols="12" sm="12" md="12" class="pt-0">
                          <BaseInput type="email" label="Correo Electrónico" v-model="v$.email.$model"
                            :rules="v$.email" />
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col cols="12" sm="12" md="12" class="pt-0">
                          <BaseInput type="text" label="Empresa" v-model="v$.company.$model" :rules="v$.company" />
                        </v-col>
                        <v-col cols="12" sm="12" md="12" class="pt-0">
                          <BaseTextArea type="text" label="Mensaje" v-model="v$.message.$model" :rules="v$.message">
                          </BaseTextArea>
                        </v-col>
                      </v-row>

                      <p>
                        <input type="submit" value="ENVIAR MENSAJE" class="form-control-submit button-submit"
                          @click="validateForm" />
                      </p>
                    </form>
                  </div>
                </v-col>
                <v-col lg="4" class="no-padding">
                  <div class="form-contact-information">
                    <form action="#" class="zentimo-contact-info">
                      <h2 class="title">Información de contacto</h2>
                      <div class="info">
                        <div class="item address">
                          <span class="icon">
                            <v-icon class="m-0" style="color: #0065eb" icon="mdi-map-marker"></v-icon>
                          </span>
                          <span class="text">
                            Col. Miramonte Calle Principal y Pje.10 N° 17-B, San
                            Salvador, San Salvador.
                          </span>
                        </div>
                        <div class="item phone">
                          <span class="icon"><v-icon class="m-0" style="color: #0065eb" icon="mdi-phone"></v-icon>
                          </span>
                          <span class="text"> (+503) 7988 6948 </span>
                        </div>
                        <div class="item email">
                          <span class="icon"><v-icon class="m-0" style="color: #0065eb" icon="mdi-email"></v-icon>
                          </span>
                          <span class="text text-lowercase">
                            /span>
                        </div>
                        <div class="item clock">
                          <span class="icon"><v-icon class="m-0" style="color: #0065eb" icon="mdi-clock"></v-icon>
                          </span>
                          <span class="text">
                            Lun - Vie 8:00 AM - 5:00 PM <br />
                            Sab 8:00 AM - 12:00 M <br>
                          </span>
                        </div>
                      </div>
                      <div class="socials">
                        <a href="" class="social-item" target="_blank">
                          <v-icon class="m-0" icon="mdi-facebook"></v-icon>
                        </a>
                        <a href="" class="social-item"
                          target="_blank">
                          <v-icon class="m-0" icon="mdi-instagram"></v-icon>
                        </a>
                        <a href="" class="social-item" target="_blank">
                          <v-icon class="m-0" icon="mdi-whatsapp"></v-icon>
                        </a>
                      </div>
                    </form>
                  </div>
                </v-col>
              </v-row>
            </v-card>
          </v-col>

        </v-row>
      </v-container>
    </div> -->
    <!-- Form -->
  </section>
  <!-- /.Contact section -->
</template>

<style scoped></style>