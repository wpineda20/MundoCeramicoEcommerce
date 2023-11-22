<template>
    <div>
        <a href="#" @click="clickInputFile()" class="button-center">
            <span class="mdi mdi-folder fs-2 icon-center"></span> Seleccionar imagen</a>
        <div class="">
            <img :src="imagePreview" alt="" style="width: 150px !important; height: auto !important;" />
        </div>
        <input type="file" ref="inputImage" class="d-none p-3" @change="updateImage" accept="image/*" />
        <base-error :rules="rules" />
    </div>
</template>

<script>
import BaseError from "./BaseError.vue";

export default {
    components: { BaseError },
    data() {
        return {
            imagePreview: "",
            fileName: "",
            sizeFile: "",
        };
    },

    updated() {
        // this.image = this.validation.$model;
        // console.log(this.image);
    },

    props: {
        rules: {
            type: Object,
            default: {},
        },
        // validation: {
        //     type: Object,
        //     default: "",
        // },
        validationsInput: {
            type: Object,
            default: () => {
                return {
                    required: true,
                };
            },
        },
        image: {
            type: String,
            default: "",
        },
    },

    watch: {
        image(val) {
            //   console.log(val);
            this.imagePreview = this.image;
        },
    },

    update() {
        this.imagePreview = this.image;
    },

    mounted() {
        this.imagePreview = this.image;
    },

    methods: {
        async updateImage(e) {
            // console.log(e);
            //   Validate size 5mb
            const size = e.target.files[0].size / 1024 / 1024;
            if (size > 5) {
                // console.log(size);
                this.$emit("update-alert", {
                    show: true,
                    message: "El tamaño de la imagen debe ser inferior a 5Mb.",
                    type: "fail",
                });
                return;
            }

            const image = await this.toBase64(e.target.files[0]);
            this.$emit("update-image", image);
            this.imagePreview = image;
        },

        async toBase64(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = () => resolve(reader.result);
                reader.onerror = (error) => reject(error);
            });
        },

        clickInputFile() {
            this.$refs.inputImage.click();
        },
    },
};
</script>

<style scoped>
.icon-center {
    vertical-align: center;
}

/* .button-center {
  display: flex;
  align-items: center;
  justify-content: center;
} */
</style>
