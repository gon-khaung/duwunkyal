<template>
  <div class="d-flex card">
    <div class="col-lg-12 col-md-12 col-12 p-0">
      <!-- Card header -->
      <div class="card-header border-0 d-flex justify-content-between">
        <h3 class="mb-0 pl-3">Categories Management</h3>
        <div>
          <button
            type="button"
            class="btn btn-outline-primary"
            data-toggle="modal"
            data-target="#new-account"
          >
            Add New Category
          </button>
        </div>
      </div>
      <div class="table betslip-table pb-3 table-responsive">
        <DashboardTable
          :tableData="tableData"
          @data="getUserData"
          @show="showModal"
          type="category"
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
                        <label class="form-control-label">Image</label>

                        <div class="custom-file d-flex">
                          <van-uploader
                            class="mx-auto"
                            :max-count="1"
                            v-model="imageUploader"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="pl-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Category Name</label>
                    <input class="form-control" v-model="account.name" />
                    <span class="text-danger">{{ errors.name }}</span>
                  </div>
                  <div class="form-group">
                    <button
                      type="button"
                      class="btn btn-primary"
                      @click="sendNewAccount"
                    >
                      Confirm
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
      isUpdate: false,
      tableData: {
        headings: ['ID', 'Name'],
        datas: [],
      },
    };
  },
  methods: {
    async sendNewAccount() {
      try {
        this.errors = {};
        if (!this.account.name) {
          this.errors.name = 'Please enter category';
          return false;
        }
        if (this.imageUploader[0].content) {
          this.account.image = this.imageUploader[0].content;
        }
        if (this.isUpdate) {
          const res = await axios.put(
            `/categories/${this.account.id}`,
            this.account,
          );
          this.isUpdate = false;
        } else {
          const res = await axios.post('/categories', this.account);
        }

        this.account = {};
        this.imageUploader = [];
        this.fetchAccounts();
        $('#new-account').modal('hide');
        Toast.success('Success');
      } catch (error) {
        Toast.fail('Fail');
      }
      return true;
    },
    showModal(value) {
      this.isUpdate = true;
      this.account = value;
      const uploader = { url: '' };
      uploader.url = value.image;
      this.imageUploader[0] = uploader;
      $('#new-account').modal('show');
    },
    getUserData(value) {
      Dialog.confirm({
        title:
          this.$store.state.language === 'en'
            ? 'Are you sure?'
            : 'သေချာပါသလား?',
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Sure',
      })
        .then(() => {
          if (value.type === 'update') this.accountUpdate(value.data, value.id);
          else this.accountDelete(value.data, value.id);
        })
        .catch(() => {});
    },
    async accountDelete(data, id) {
      try {
        const res = await axios.delete(`/categories/${data.id}`);
        this.tableData.datas.splice(id, 1);
        Toast.success('Success');
      } catch (error) {
        Toast.fail('Fail');
      }
    },
    async accountUpdate(data, id) {
      try {
        const res = await axios.put(`/categories/${data.id}`, data);
        this.tableData.datas[id].isEdit = !this.tableData.datas[id].isEdit;
        Toast.success('Success');
      } catch (error) {
        Toast.fail('Fail');
      }
    },
    async fetchAccounts() {
      try {
        this.tableData.contents = ['id', 'name'];
        const res = await axios.get('/categories');
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
