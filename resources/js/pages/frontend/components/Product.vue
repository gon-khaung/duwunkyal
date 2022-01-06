<template>
    <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
        <div class="featured__item">
            <div
                class="featured__item__pic set-bg"
                :style="`background-image: url(https://thetkhine.com/wp-content/uploads/2021/07/Sunset1-768x512.jpeg)`"
            >
                <ul class="featured__item__pic__hover">
                    <li>
                        <a
                            href="#"
                            @click="
                                $router.push(`/product/${data.id}`),
                                    sendRequest(data.id)
                            "
                            ><i class="fas fa-eye"></i
                        ></a>
                    </li>
                </ul>
            </div>
            <div class="featured__item__text">
                <h6>
                    <a href="#">{{ data.name }}</a>
                </h6>
                <h5>${{ data.price }}</h5>
            </div>
        </div>
    </div>
</template>
<script>
export default {
  props: ['data'],
  methods: {
    sendRequest(id) {
      this.$emit('test', id);
    },
  },
};
</script>
