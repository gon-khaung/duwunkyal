<template>
  <!-- Footer Section Begin -->
  <footer class="footer spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 col-md-8 col-sm-6">
          <div class="footer__about">
            <div class="footer__about__logo">
              <a href="./index.html"><img src="img/logo.png" alt="" /></a>
            </div>
            <ul>
              <li>Address: {{ $store.state.contact.address }}</li>
              <li>Phone: {{ $store.state.contact.phone }}</li>
              <li>Email: {{ $store.state.contact.email }}</li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 offset-lg-1">
          <div class="footer__widget">
            <h6>Useful Links</h6>
            <ul>
              <li><a href="#">About Us</a></li>
              <li><a href="#">About Our Shop</a></li>
              <li><a href="#">Our Sitemap</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="footer__copyright">
            <div class="footer__copyright__text">
              <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy; All rights reserved | This website is developed
                <a href="https://colorlib.com" target="_blank">Nebwin</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              </p>
            </div>
            <div class="footer__copyright__payment">
              <img src="img/payment-item.png" alt="" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer Section End -->
</template>
<style scoped>
.footer {
  background: #e8f0fe;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
}
</style>
