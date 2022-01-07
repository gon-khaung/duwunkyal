<template>
  <!-- === for live === -->
  <div class="col-md-4" v-if="type === 'live'">
    <div
      class="modal fade"
      :id="id_type"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modal-form"
      aria-hidden="true"
    >
      <div
        class="modal-dialog modal- modal-dialog-centered modal-sm"
        role="document"
      >
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="border-0 mb-0">
              <div class="card-body px-lg-5 py-lg-5">
                <form role="form">
                  <div class="form-group mb-3">
                    {{
                      $store.state.language === "en"
                        ? "Enter Embedded Link"
                        : "Youtube မှရသည့် link ထည့်ပေးပါ"
                    }}
                    <div
                      class="
                        mt-2
                        input-group input-group-merge input-group-alternative
                      "
                    >
                      <textarea class="form-control" v-model="data[field]" />
                    </div>
                    <!-- <span class="text-danger">{{
                                            errors.amount
                                        }}</span> -->
                  </div>
                  <div class="text-center">
                    <button
                      type="button"
                      class="btn btn-primary"
                      @click="makeLive"
                    >
                      {{
                        $store.state.language === "en"
                          ? "Continue"
                          : "ဆက်သွားမည်"
                      }}
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div
    class="modal fade"
    :id="id_type"
    tabindex="-1"
    role="dialog"
    aria-labelledby="modal-form"
    aria-hidden="true"
    v-else
  >
    <div
      class="modal-dialog modal- modal-dialog-centered modal-md"
      role="document"
    >
      <div class="modal-content">
        <div class="modal-body">
          <div class="card border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5 p-0">
              <div v-if="date">
                Date: <b>{{ date }}</b>
              </div>
              <div class="image_container col-12 my-3" v-if="image">
                <img :src="image" alt="Image" srcset="" v-if="!isEdit" />
                <div class="custom-file d-flex" v-if="isEdit">
                  <van-uploader
                    class="mx-auto"
                    v-model="imageUploader"
                    :max-count="1"
                  />
                </div>
              </div>
              <div v-if="remark && remark.length > 0">
                {{ $store.state.language === "en" ? "Remark" : "မှတ်ချက်" }}
                : <b>{{ remark }}</b>
              </div>
              <button
                class="btn btn-info"
                v-if="!isEdit && isPayment"
                @click="changeIsEdit()"
              >
                Edit
              </button>
              <button
                class="btn btn-success"
                v-if="isEdit && isPayment"
                @click="changeImageOfPaymentAccount(accountData['id'])"
              >
                Confirm
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { Toast, Dialog } from 'vant';

export default {
  props: [
    'id_type',
    'image',
    'remark',
    'date',
    'type',
    'data',
    'field',
    'isPayment',
    'accountData',
  ],
  data() {
    return {
      isEdit: false,
      imageUploader: [
        { url: this.accountData ? this.accountData.qr_image : '' },
      ],
    };
  },
  methods: {
    changeIsEdit() {
      this.isEdit = true;
    },
    changeImageOfPaymentAccount(id) {
      Dialog.confirm({
        title:
          this.$store.state.language === 'en'
            ? 'Are you sure?'
            : 'သေချာပါသလား?',
        cancelButtonText:
          this.$store.state.language === 'en' ? 'Cancel' : 'မလုပ်တော့ပါ။',
        confirmButtonText:
          this.$store.state.language === 'en' ? 'Sure' : 'သေချာပြီ။',
      })
        .then(() => {
          this.updateImage(id);
        })
        .catch(() => {});
    },
    async updateImage(id) {
      const params = this.accountData;
      if (this.imageUploader[0].content) {
        params.qr_image = this.imageUploader[0].content;
      }
      try {
        const res = await axios.put(`accounts/${id}`, params);
        this.isEdit = false;
        Toast.success(
          this.$store.state.language === 'en' ? 'Success' : 'အောင်မြင်သည်။',
        );
      } catch (error) {
        Toast.fail(
          this.$store.state.language === 'en' ? 'Fail' : 'ကျရှုံးသည်။',
        );
      }
    },
    makeLive() {
      this.$emit('makeLive', '');
    },
  },
};
</script>
<style scoped>
.image_container {
  height: auto;
  min-height: 200px;
}
.image_container img {
  width: 100%;
  height: 100%;
  border-radius: 5px;
}
</style>
