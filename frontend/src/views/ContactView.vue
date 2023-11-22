<script setup>
import { ref } from "vue";

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
  <section class="services-section" id="services">
    <!-- Services Titles -->
    <div class="services-content-reverse services-content">
      <div class="services-img">
        <div class="google-map">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3876.5846540991756!2d-89.22861812593692!3d13.68300139888471!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f63304aef05fb9b%3A0x49730054de7f4352!2sMundo%20Cer%C3%A1mico!5e0!3m2!1ses!2ssv!4v1700664381854!5m2!1ses!2ssv"
            width="600"
            height="450"
            style="border: 0"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
          ></iframe>
        </div>
        <!-- <img src="/test/img-6.jpg" class="services-image" alt="servicios mundo ceramico"> -->
      </div>
      <div class="services-text">
        <h3 class="services-title">CONTACTO</h3>
        <h1 class="services-subtitle">
          Ut Provide Act <br />
          Nunc Elit Phasellus
        </h1>
        <p class="services-p mb-0">
          Lorem ipsum convallis enim nulla, ac euismod nunc<br />
          Ut commodo suscipit elit ac pulvinar. Lorem ipsum convallis enim
          nulla, <br />
          ac euismod nunc ullamcorper Ut commodo suscipit elit ac pulvinar.
        </p>
      </div>
    </div>
    <!-- /.Services Titles -->

    <!-- Contact Us Section -->
    <!-- Services Cards -->
    <div class="contact-section" id="contact">
      <div class="service-reveal">
        <div class="row row-cols-1 row-cols-md-3 g-3">
          <div class="col mt-1">
            <div class="card-contact zoom" style="width: 18rem">
              <div class="card-contact-content">
                <div class="card-contact-icon">
                  <img
                    src="/logos/map-marker-alt-solid.svg"
                    style="
                      filter: invert(5%) sepia(31%) saturate(6815%)
                        hue-rotate(209deg) brightness(90%) contrast(104%);
                    "
                    class="icon-contact"
                    alt="icon-contact"
                  />
                </div>
                <div class="card-contact-info">
                  <h4 class="card-contact-subtitle">Ubicación</h4>
                  <p class="text-center">
                    Mundo Cerámico, Boulevar los proceres, 1-A, San Salvador
                  </p>
                  <div class="text-center">
                    <a
                      href="https://ul.waze.com/ul?ll=13.68323591%2C-89.22569990&navigate=yes&zoom=17&utm_campaign=default&utm_source=waze_website&utm_medium=lm_share_location"
                      target="_blank"
                      class="btn-waze"
                      >WAZE
                      <img src="logos/icon-waze-download.png" alt="waze button"
                    /></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col mt-1">
            <div class="card-contact zoom" style="width: 18rem">
              <div class="card-contact-content">
                <div class="card-contact-icon">
                  <img
                    src="/logos/paper-plane-regular.svg"
                    style="
                      filter: invert(5%) sepia(31%) saturate(6815%)
                        hue-rotate(209deg) brightness(90%) contrast(104%);
                    "
                    class="icon-contact"
                    alt="icon-contact"
                  />
                </div>
                <div class="card-contact-info">
                  <h4 class="card-contact-subtitle">Contáctanos</h4>
                  <p class="text-center mb-0">mundoceramico@yahoo.com</p>
                  <p class="text-center mb-0">+503 2254 5999</p>
                  <p class="text-center mb-0">+503 7700 1782</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col mt-1">
            <div class="card-contact zoom" style="width: 18rem">
              <div class="card-contact-content">
                <div class="card-contact-icon">
                  <img
                    src="/logos/calendar-alt-regular.svg"
                    style="
                      filter: invert(5%) sepia(31%) saturate(6815%)
                        hue-rotate(209deg) brightness(90%) contrast(104%);
                    "
                    class="icon-contact"
                    alt="icon-contact"
                  />
                </div>

                <div class="card-contact-info">
                  <h4 class="card-contact-subtitle">Horarios</h4>
                  <p class="text-center mb-2">
                    8:00 am - 6:00 pm <br />
                    Lunes - Viernes
                  </p>
                  <p class="text-center mb-0">
                    8:00 am - 2:00 pm <br />
                    Sabado
                  </p>
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
                            lobotech@cefesp.com</span>
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
                        <a href="https://www.facebook.com/lobotechsv" class="social-item" target="_blank">
                          <v-icon class="m-0" icon="mdi-facebook"></v-icon>
                        </a>
                        <a href="https://www.instagram.com/lobotechsv/?igshid=MzRlODBiNWFlZA%3D%3D" class="social-item"
                          target="_blank">
                          <v-icon class="m-0" icon="mdi-instagram"></v-icon>
                        </a>
                        <a href="https://api.whatsapp.com/send?phone=50379886948" class="social-item" target="_blank">
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