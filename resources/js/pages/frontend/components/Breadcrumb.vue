<template>
  <!-- Breadcrumb Section Begin -->
  <section
    class="breadcrumb-section"
    style="
      background: url('/build/assets/img/breadcum.jpeg');
      background-repeat: no-repeat;
      background-size: cover;
      height: 100%;
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
