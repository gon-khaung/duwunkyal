<template>
    <div>
        <!-- Footer -->
        <footer class="footer mt-3">
            <div class="align-items-center justify-content-lg-between">
                <div class="col-lg-12">
                    <div class="copyright text-center text-muted">
                        Copyright &copy; 2020-2021 Star. All Rights Reserved.
                    </div>
                </div>
                <div class="col-lg-12 text-center mt-1">
                    <small><b>We accept</b></small>
                    <ul class="nav nav-footer justify-content-center">
                        <li class="nav-item">
                            <div
                                class="banking-icons"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="CB pay"
                            >
                                <img
                                    src="/build/assets/img/theme/cb_pay.png"
                                    alt=""
                                />
                            </div>
                        </li>
                        <li class="nav-item">
                            <div
                                class="banking-icons"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="KBZ banking"
                            >
                                <img
                                    src="/build/assets/img/theme/kbz.png"
                                    alt=""
                                />
                            </div>
                        </li>
                        <li class="nav-item">
                            <div
                                class="banking-icons"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="AYA banking"
                            >
                                <img
                                    src="/build/assets/img/theme/aya.png"
                                    alt=""
                                />
                            </div>
                        </li>
                        <li class="nav-item">
                            <div
                                class="banking-icons"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="KBZ pay"
                            >
                                <img
                                    src="/build/assets/img/theme/kbz_pay.png"
                                    alt=""
                                />
                            </div>
                        </li>
                        <li class="nav-item">
                            <div
                                class="banking-icons"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Wavemoney"
                            >
                                <img
                                    src="/build/assets/img/theme/wavemoney_logo.png"
                                    alt=""
                                />
                            </div>
                        </li>
                        <li class="nav-item">
                            <div
                                class="banking-icons"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="OK dollar"
                            >
                                <img
                                    src="/build/assets/img/theme/ok_logo.png"
                                    alt=""
                                />
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</template>
<style scoped>
.banking-icons {
    width: 40px;
    height: 40px;
    padding: 5px;
    border-radius: 5px;
}
.banking-icons img {
    width: 100%;
    height: 100%;
    border-radius: 5px;
}
.nav-item {
    margin-left: 10px;
    margin-right: 10px;
}
@media (max-width: 767.98px) {
    .banking-icons {
        width: 25px;
        height: 25px;
        padding: 3px;
        border-radius: 3px;
    }
    .banking-icons img {
        width: 100%;
        height: 100%;
        border-radius: 3px;
    }
}
</style>
