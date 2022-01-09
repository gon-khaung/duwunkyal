<template>
    <div class="d-flex">
        <div class="col-lg-12 col-md-12 col-12 p-0">
            <!-- Card header -->
            <div class="card-header border-0 d-flex justify-content-between">
                <h3 class="mb-0 pl-3">Dynamic Names</h3>
                <div>
                    <button
                        type="button"
                        class="btn btn-outline-primary"
                        data-toggle="modal"
                        data-target="#new-account"
                    >
                        Add New Name
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
                                    <div class="form-group">
                                        <label class="form-control-label"
                                            >Name</label
                                        >
                                        <input
                                            class="form-control"
                                            v-model="dynamic.name"
                                        />
                                        <span class="text-danger">{{
                                            errors.name
                                        }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label"
                                            >Type</label
                                        >
                                        <input
                                            class="form-control"
                                            v-model="dynamic.type"
                                        />
                                        <span class="text-danger">{{
                                            errors.type
                                        }}</span>
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
      tableData: {
        datas: [],
      },
      dynamic: {},
    };
  },
  methods: {
    async sendNewAccount() {
      try {
        this.errors = {};
        if (!this.dynamic.name) {
          this.errors.name = 'Please enter category';
          return false;
        }
        const res = await axios.post('/dynamicnames', this.dynamic);

        this.dynamic = {};
        this.fetchUsers();
        $('#new-account').modal('hide');
        Toast.success('Success');
      } catch (error) {
        Toast.fail('Fail');
      }
      return true;
    },
    getUserData(value) {
      Dialog.confirm({
        title: 'Are you sure?',
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Sure',
      })
        .then(() => {
          if (value.type === 'update') this.userUpdate(value.data, value.id);
          else this.userDelete(value.data, value.id);
        })
        .catch(() => {});
    },
    async userUpdate(data, id) {
      try {
        const res = await axios.put(`/dynamicnames/${data.id}`, data);
        this.tableData.datas[id].isEdit = !this.tableData.datas[id].isEdit;
        Toast.success('Success');
      } catch (error) {
        Toast.fail('Fail');
      }
    },
    async userDelete(data, id) {
      try {
        const res = await axios.delete(`/dynamicnames/${data.id}`);
        this.tableData.datas.splice(id, 1);
        Toast.success('Success');
      } catch (error) {
        Toast.fail('Fail');
      }
    },
    async fetchUsers() {
      try {
        this.tableData.headings = ['Id', 'Name', 'Type'];
        this.tableData.contents = ['id', 'name', 'type'];

        const res = await axios.get('/dynamicnames');
        this.tableData.datas = res.data.data;
      } catch (error) {
        console.log(error);
      }
    },
  },
  watch: {
    currentPage() {
      this.fetchUsers();
    },
  },
  mounted() {
    this.fetchUsers();
  },
};
</script>
<style scoped>
.betslip-table {
    background: white;
}
</style>
