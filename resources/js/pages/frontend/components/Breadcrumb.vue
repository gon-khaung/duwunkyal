<template>
  <!-- Breadcrumb Section Begin -->
  <section
    class="breadcrumb-section set-bg"
    style="
      background-image: url('https://thetkhine.com/wp-content/uploads/2021/07/Sunset1-768x512.jpeg');
    "
  >
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="breadcrumb__text">
            <h2>{{ text }}</h2>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Breadcrumb Section End -->
</template>
<script>
export default {
  props: ['text'],
};
</script>
