<template>
  <div>
    <v-textarea v-bind="$attrs" class="mt-4" variant="outlined" v-model="rules.$model" @keyup="validateText()" />

    <base-error :rules="rules" />
  </div>
</template>

<script>
import BaseError from "./BaseError.vue";

export default {
  components: { BaseError },
  props: {
    rules: {
      type: Object,
      default: {},
    },
    validationTextType: {
      type: String,
      default: "none",
    },
  },
  methods: {
    validateText() {
      switch (this.validationTextType) {
        case "duplicate":
          this.rules.$model = this.rules.$model.replace(
            /[^A-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚñ\' ']/gi,
            ""
          );
          this.rules.$model = this.rules.$model.replace(
            /^([a-zA-Z0-9])\1{4}/gi,
            ""
          );
          break;
        case "only-letters":
          this.rules.$model = this.rules.$model.replace(
            /[^A-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚñ\' ']/gi,
            ""
          );
          break;
        case "only-numbers":
          this.rules.$model = this.rules.$model.replace(/[^0-9\-]/g, "");
          break;
        case "none":
          break;
        case "only-repeats":
          this.rules.$model = this.rules.$model.replace(
            /^([a-zA-Z0-9])\1{4}/g,
            ""
          );
          break;
        default:
          break;
      }
    },
  },
};
</script>