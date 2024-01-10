<template>
  <footer class="footer style7">
    <v-container>
      <div class="container-wapper">
        <v-row>
          <!-- Mundo Ceramico -->
          <v-col xs="12" cols="12" md="4" sm="6" lg="4" class="box-footer">
            <div class="widget-box">
              <div class="single-img">
                <a href="#">
                  <h2 class="widgettitle">Mundo Cerámico</h2>
                </a>
              </div>
              <ul class="menu">
                <li class="menu-item">
                  <a href=""><v-icon class="mx-2" icon="mdi-map-marker"></v-icon>Boulevar los proceres, 1-A, San
                    Salvador</a>
                </li>
                <li class="menu-item">
                  <a href="https://api.whatsapp.com/send?phone=50379886948"><v-icon class="mx-2"
                      icon="mdi-phone"></v-icon>(+503) 2254
                    5999</a>
                </li>
                <li class="menu-item">
                  <a href=""><v-icon class="mx-2" icon="mdi-email"></v-icon>servicioalcliente@mundo-ceramico.com</a>
                </li>
                <li class="menu-item">
                  <a href="#"><v-icon class="mx-2" icon="mdi-clock"></v-icon>Lun - Vie
                    8:00am - 6:00pm <br />
                    Sab 8:00am - 2:00pm
                  </a>
                </li>
              </ul>
            </div>
          </v-col>
          <!-- Mundo ceramico -->
          <!-- Navigation -->
          <v-col xs="12" cols="12" md="2" sm="6" lg="2" class="box-footer">
            <div class="zentimo-custommenu default">
              <h2 class="widgettitle">Navegación</h2>
              <ul class="menu">
                <li class="menu-item">
                  <RouterLink to="/"> Tienda </RouterLink>
                </li>
                <li class="menu-item">
                  <RouterLink to="/about"> Nosotros </RouterLink>
                </li>
                <li class="menu-item">
                  <RouterLink to="/services"> Servicios </RouterLink>
                </li>
                <li class="menu-item">
                  <RouterLink to="/contact"> Contacto </RouterLink>
                </li>
                <li class="menu-item">
                  <RouterLink to="/tips"> Tips </RouterLink>
                </li>
              </ul>
            </div>
          </v-col>
          <!-- Navigation -->
          <!-- Services -->
          <v-col xs="12" cols="12" md="2" sm="6" lg="2" class="box-footer">
            <div class="zentimo-custommenu default">
              <h2 class="widgettitle">Sucursales</h2>
              <ul class="menu">
                <li class="menu-item">
                  <RouterLink to="/services">
                    <a href="#">San Salvador</a>
                  </RouterLink>
                </li>
                <li class="menu-item">
                  <RouterLink to="/services">
                    <a href="#">Sonsonate</a>
                  </RouterLink>
                </li>
                <li class="menu-item">
                  <RouterLink to="/services">
                    <a href="#">Metapán</a>
                  </RouterLink>
                </li>
                <li class="menu-item">
                  <RouterLink to="/services">
                    <a href="#">Santa Ana</a>
                  </RouterLink>
                </li>
              </ul>
            </div>
          </v-col>
          <!-- Services -->
          <!-- Social Media -->
          <v-col xs="12" cols="12" md="4" sm="6" lg="4" class="box-footer">
            <div class="zentimo-newsletter style1">
              <div class="newsletter-head">
                <h3 class="title" style="color: white">Redes Sociales</h3>
              </div>
              <div class="newsletter-form-wrap">
                <div class="list" style="color: white">
                  ¡Síguenos! en todas nuestras redes sociales.
                </div>
              </div>
            </div>
            <div class="zentimo-socials">
              <ul class="socials">
                <li>
                  <a href="https://www.facebook.com/MundoCeramicoESA?locale=es_LA" class="social-item mx-2"
                    target="_blank">
                    <v-icon class="m-0" icon="mdi-facebook"></v-icon>
                  </a>
                </li>
                <li>
                  <a href="https://www.instagram.com/mundoceramicosv/?hl=es" class="social-item mx-2" target="_blank">
                    <v-icon class="m-0" icon="mdi-instagram"></v-icon>
                  </a>
                </li>
                <li>
                  <a href="https://api.whatsapp.com/send?phone=50377001782" class="social-item mx-2" target="_blank">
                    <v-icon class="m-0" icon="mdi-whatsapp"></v-icon>
                  </a>
                </li>
                <li>
                  <a href="https://www.pinterest.com/mundo_ceramico/mundo-ceramico-el-salvador/" class="social-item mx-2"
                    target="_blank">
                    <v-icon class="m-0" icon="mdi-pinterest"></v-icon>
                  </a>
                </li>
                <li>
                  <a href="https://www.tiktok.com/@mundoceramicosv?_t=8iDDJ7y6QNS&_r=1" class="social-item mx-2"
                    target="_blank">
                    <!-- <v-icon class="m-0" icon="mdi-tiktok"></v-icon> -->
                    <i class="fa-brands fa-tiktok"></i>
                    <!-- <v-img src="/logos/tiktok.svg" width="15" ></v-img> -->
                  </a>
                </li>
              </ul>
            </div>
          </v-col>
          <!-- Social Media -->
        </v-row>
        <v-row>
          <v-col sm="12" class="col-sm-12 border-custom">
            <span></span>
          </v-col>
        </v-row>
        <!-- Copyright -->
        <div class="footer-end">
          <v-row>
            <v-col cols="12" md="6" lg="6" sm="12" xs="12">
              <div class="coppyright" style="color: white">
                Copyright © {{ new Date().getFullYear() }}
                <a href="#">Mundo Cerámico</a>. Todos los derechos reservados
              </div>
            </v-col>
            <v-col cols="12" md="6" lg="6" sm="12" xs="12"> </v-col>
          </v-row>
        </div>
        <!-- Copyright -->
      </div>
    </v-container>
  </footer>
</template>
