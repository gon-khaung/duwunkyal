<template>
  <div class="d-flex card">
    <div class="col-lg-12 col-md-12 col-12 p-0">
      <!-- Card header -->
      <div class="card-header border-0 d-flex justify-content-between">
        <h3 class="mb-0 pl-3">Products Management</h3>
        <div>
          <button
            type="button"
            class="btn btn-outline-primary"
            data-toggle="modal"
            data-target="#new-account"
            @click="makeNewProduct()"
          >
            Add New Product
          </button>
        </div>
      </div>
      <div class="table betslip-table pb-3 table-responsive">
        <DashboardTable
          :tableData="tableData"
          @data="getUserData"
          @show="showModal"
          type="products"
        />
      </div>
    </div>
    <!-- pagination  -->
    <b-pagination
      v-model="currentPage"
      pills
      :total-rows="rows"
      size="sm"
      align="center"
    ></b-pagination>
    <div
      class="modal fade"
      id="new-account"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modal-form"
      aria-hidden="true"
    >
      <div
        class="modal-dialog modal- modal-dialog-centered modal-lg"
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
                    <label class="form-control-label">Name</label>
                    <input class="form-control" v-model="account.name" />
                    <span class="text-danger">{{ errors.name }}</span>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Description</label>
                    <input class="form-control" v-model="account.description" />
                    <span class="text-danger">{{ errors.description }}</span>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Price</label>
                    <input
                      class="form-control"
                      v-model="account.price"
                      type="number"
                    />
                    <span class="text-danger">{{ errors.price }}</span>
                  </div>
                  <div class="form-group d-flex p-0" style="z-index: 1000">
                    <div class="col-6 p-0 pr-1">
                      <label class="form-control-label">Color</label>
                      <v-select
                        multiple
                        v-model="account.colors"
                        :options="dynamicnames.colors"
                        :reduce="(data) => data.id"
                        label="name"
                      />
                      <span class="text-danger">{{ errors.colors }}</span>
                    </div>
                    <div class="col-6 p-0 pl-1">
                      <label class="form-control-label">Size</label>
                      <v-select
                        multiple
                        v-model="account.sizes"
                        :options="dynamicnames.sizes"
                        :reduce="(data) => data.id"
                        label="name"
                      />

                      <span class="text-danger">{{ errors.price }}</span>
                    </div>
                  </div>
                  <div class="form-group d-flex p-0" style="z-index: 950">
                    <div class="col-12 p-0">
                      <label class="form-control-label">Category</label>
                      <v-select
                        v-model="account.category_id"
                        :options="categories"
                        :reduce="(data) => data.id"
                        label="name"
                      />
                      <span class="text-danger">{{ errors.category }}</span>
                    </div>
                  </div>
                  <div class="form-group d-flex" style="z-index: 900">
                    <div class="col-6">
                      <label class="form-control-label">Featured?</label>
                      <input
                        type="checkbox"
                        name=""
                        v-model="account.is_featured"
                      />
                      <span class="text-danger">{{ errors.is_featured }}</span>
                    </div>
                    <div class="col-6">
                      <label class="form-control-label">Instock?</label>
                      <input
                        type="checkbox"
                        name=""
                        v-model="account.is_instock"
                      />
                      <span class="text-danger">{{ errors.is_instock }}</span>
                    </div>
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
      test: null,
      errors: {},
      rows: null,
      currentPage: 1,
      categories: [],
      imageUploader: [],
      account: {
        is_featured: false,
        is_instock: false,
      },
      dynamicnames: {
        colors: [],
        sizes: [],
      },
      isUpdate: false,
      tableData: {
        headings: [
          'Name',
          'Featured',
          'Description',
          'Price',
          'Instock',
          'Colors',
          'Sizes',
          'Category',
        ],
        datas: [],
      },
    };
  },
  watch: {
    currentPage() {
      this.account = {
        is_featured: false,
        is_instock: false,
      };
      this.fetchAccounts();
    },
  },
  methods: {
    makeNewProduct() {
      this.imageUploader = [];
    },
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
            `/products/${this.account.id}`,
            this.account,
          );
          this.isUpdate = false;
        } else {
          const res = await axios.post('/products', this.account);
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
        title: 'Are you sure?',
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
        const res = await axios.delete(`/products/${data.id}`);
        this.tableData.datas.splice(id, 1);
        Toast.success('Success');
      } catch (error) {
        Toast.fail('Fail');
      }
    },
    async accountUpdate(data, id) {
      try {
        const res = await axios.put(`/products/${data.id}`, data);
        this.tableData.datas[id].isEdit = !this.tableData.datas[id].isEdit;
        Toast.success('Success');
      } catch (error) {
        Toast.fail('Fail');
      }
    },
    async fetchAccounts() {
      try {
        this.tableData.contents = [
          'name',
          'is_featured',
          'description',
          'price',
          'is_instock',
          'color_names',
          'size_names',
          'category',
        ];
        const res = await axios.get('/products', {
          params: {
            limit: 20,
            page: this.currentPage,
          },
        });
        this.tableData.datas = res.data.data;
        this.rows = Math.ceil(res.data.total / 20);
      } catch (error) {
        console.log(error);
      }
    },
    async fetchDynamicNames() {
      try {
        const res = await axios.get('/dynamicnames');
        this.dynamicnames.colors = res.data.data.filter(
          (data) => data.type === 'color',
        );
        this.dynamicnames.sizes = res.data.data.filter(
          (data) => data.type === 'size',
        );
      } catch (error) {
        console.log(error);
      }
    },
    async fetchCategories() {
      try {
        const res = await axios.get('/categories');
        this.categories = res.data.data;
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    this.fetchAccounts();
    this.fetchDynamicNames();
    this.fetchCategories();
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
