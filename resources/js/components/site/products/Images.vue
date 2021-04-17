<template>
    <div v-if="selected_image" class="flex flex-wrap">
        <figure class="px-6 mb-5">
            <img class="border-4" :src="selected_image.image" :alt="variant.product.name">
        </figure>
        <div class="grid grid-cols-3 gap-2 px-6">
            <img v-for="(image, index) in images" :key="index" @click="select_image(image)" class="border-2 hover:border-primary-500 cursor-pointer" :class="{'border-primary-400' : (selected_image.id === image.id)}" :src="image.image" :alt="variant.product.name">
        </div>
    </div>
</template>
<script>
export default {
  props: ['variant'],
  data() {
    return {
        selected_image: null,
        images: [],
    }
  },
  mounted() {
      this.images = this.variant.images;
      this.selected_image = this.images[0];
  },
  watch: {
      variant() {
          this.images = this.variant.images;
          this.selected_image = this.images[0];
      }
  },
  methods: {
    select_image(image) {
        this.selected_image = image;
    }
  }
}
</script>