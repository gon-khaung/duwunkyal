<template>
    <div class="d-flex card">
        <div class="col-lg-12 col-md-12 col-12 p-0">
            <!-- Card header -->
            <div class="card-header border-0 d-flex justify-content-between">
                <h3 class="mb-0 pl-3">
                    {{
                        $store.state.language === "en"
                            ? "Payment Accounts"
                            : "ငွေပေးချေမှု အကောင့်များ"
                    }}
                </h3>
                <div>
                    <button
                        type="button"
                        class="btn btn-outline-primary"
                        data-toggle="modal"
                        data-target="#new-account"
                    >
                        {{
                            $store.state.language === "en"
                                ? "Add New Account"
                                : "အကောင့်အသစ် ဖွင့်မည်"
                        }}
                    </button>
                </div>
            </div>
            <div class="table betslip-table pb-3 table-responsive">
                <DashboardTable
                    :tableData="tableData"
                    @data="getUserData"
                    type="payment"
                />
            </div>
        </div>
        <div
            class="modal fade"
            id="new-account"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modal-form"
            aria-hidden="true"
        >
            <div
                class="modal-dialog modal- modal-dialog-centered modal-md"
                role="document"
            >
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="card bg-secondary border-0 mb-0">
                            <div class="card-body px-lg-5 py-lg-5 p-0">
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label
                                                    class="form-control-label"
                                                    >{{
                                                        $store.state
                                                            .language === "en"
                                                            ? "QR Image"
                                                            : "QR ဓာက်ပုံ"
                                                    }}</label
                                                >

                                                <div class="custom-file d-flex">
                                                    <van-uploader
                                                        class="mx-auto"
                                                        :max-count="1"
                                                        v-model="imageUploader"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label
                                                    class="form-control-label"
                                                    for="input-email"
                                                    >{{
                                                        $store.state
                                                            .language === "en"
                                                            ? "Account Type"
                                                            : "အကောင့်အမျိုးအစား"
                                                    }}</label
                                                >
                                                <input
                                                    id="input-email"
                                                    class="form-control"
                                                    v-model="account.name"
                                                />
                                                <span class="text-danger">{{
                                                    errors.type
                                                }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">{{
                                            $store.state.language === "en"
                                                ? "Account number"
                                                : "အကောင့်နံပါတ်"
                                        }}</label>
                                        <input
                                            class="form-control"
                                            v-model="account.number"
                                        />
                                        <span class="text-danger">{{
                                            errors.number
                                        }}</span>
                                    </div>
                                    <div class="form-group">
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                            @click="sendNewAccount"
                                        >
                                            {{
                                                $store.state.language === "en"
                                                    ? "Confirm"
                                                    : "အတည်ပြုမည်"
                                            }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { Toast, Dialog } from 'vant';
import DashboardTable from './components/DashboardTable.vue';

export default {
  components: { DashboardTable },
  data() {
    return {
      errors: {},
      imageUploader: [],
      account: {},
      tableData: {
        headings:
                    this.$store.state.language === 'en'
                      ? ['Type', 'Account Number']
                      : ['အမျိုးအစား', 'အကောင့် နံပါတ်'],
        datas: [],
      },
    };
  },
  methods: {
    async sendNewAccount() {
      try {
        this.errors = {};
        if (!this.account.name) {
          this.errors.type = this.$store.state.language === 'en'
            ? 'Please enter account type'
            : 'အကောင့်အမျိုးအစား ထည့်ပေးပါ။';
          return false;
        }
        if (!this.account.number) {
          this.errors.number = this.$store.state.language === 'en'
            ? 'Please enter account number'
            : 'အကောင့်နံပါတ် ထည့်ပေးပါ။';
          return false;
        }

        if (this.imageUploader[0]) {
          this.account.qr_image = this.imageUploader[0].content;
        }
        const res = await axios.post('/accounts', this.account);
        this.imageUploader = [];
        this.account = {};
        this.fetchAccounts();
        $('#new-account').modal('hide');
        Toast.success('Success');
      } catch (error) {
        Toast.fail('Fail');
      }
      return true;
    },
    getUserData(value) {
      Dialog.confirm({
        title:
                    this.$store.state.language === 'en'
                      ? 'Are you sure?'
                      : 'သေချာပါသလား?',
        cancelButtonText:
                    this.$store.state.language === 'en'
                      ? 'Cancel'
                      : 'မလုပ်တော့ပါ။',
        confirmButtonText:
                    this.$store.state.language === 'en' ? 'Sure' : 'သေချာပြီ။',
      })
        .then(() => {
          if (value.type === 'update') this.accountUpdate(value.data, value.id);
          else this.accountDelete(value.data, value.id);
        })
        .catch(() => {});
    },
    async accountDelete(data, id) {
      try {
        const res = await axios.delete(`/accounts/${data.id}`);
        this.tableData.datas.splice(id, 1);
        Toast.success(
          this.$store.state.language === 'en'
            ? 'Success'
            : 'အောင်မြင်သည်။',
        );
      } catch (error) {
        Toast.fail(
          this.$store.state.language === 'en' ? 'Fail' : 'ကျရှုံးသည်။',
        );
      }
    },
    async accountUpdate(data, id) {
      try {
        const res = await axios.put(`/accounts/${data.id}`, data);
        this.tableData.datas[id].isEdit = !this.tableData.datas[id].isEdit;
        Toast.success(
          this.$store.state.language === 'en'
            ? 'Success'
            : 'အောင်မြင်သည်။',
        );
      } catch (error) {
        Toast.fail(
          this.$store.state.language === 'en' ? 'Fail' : 'ကျရှုံးသည်။',
        );
      }
    },
    async fetchAccounts() {
      try {
        this.tableData.contents = ['name', 'number'];
        const res = await axios.get('/accounts');
        this.tableData.datas = res.data.data;
        this.rows = res.data.total;
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    this.fetchAccounts();
  },
};
</script>
<style scoped>
.betslip-table {
    background: white;
}
.custom-file {
    height: auto;
}
</style>
