<template>
  <div class="d-flex">
    <div class="col-lg-12 col-md-12 col-12 p-0">
      <!-- Card header -->
      <div class="card-header border-0 d-flex justify-content-between">
        <h3 class="mb-0 pl-3">Users Management</h3>
        <div class="d-flex">
          <input
            id="input-email"
            class="form-control search"
            placeholder="Search by name or email"
            v-model="searchKeyword"
            @keyup.enter="fetchUsers"
          />
          <button
            type="button"
            class="btn btn-success ml-2 mr-3"
            @click="fetchUsers"
            style="flex-shrink: 0"
          >
            Search
          </button>
        </div>
      </div>
      <div class="table betslip-table pb-3 table-responsive">
        <DashboardTable :tableData="tableData" @data="getUserData" />
        <!-- pagination  -->
        <b-pagination
          v-model="currentPage"
          pills
          :total-rows="rows"
          size="sm"
          align="center"
        ></b-pagination>
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
      tableData: {
        datas: [],
      },
      rows: null,
      currentPage: 1,
      searchKeyword: null,
    };
  },
  methods: {
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
        const res = await axios.put(`/users/${data.id}`, data);
        this.tableData.datas[id].isEdit = !this.tableData.datas[id].isEdit;
        Toast.success('Success');
      } catch (error) {
        Toast.fail('Fail');
      }
    },
    async userDelete(data, id) {
      try {
        const res = await axios.delete(`/users/${data.id}`);
        this.tableData.datas.splice(id, 1);
        Toast.success('Success');
      } catch (error) {
        Toast.fail('Fail');
      }
    },
    async fetchUsers() {
      try {
        this.tableData.headings = ['Name', 'Email', 'Roles'];
        this.tableData.contents = ['name', 'email', 'roles'];

        const res = await axios.post('/users', {
          page: this.currentPage,
          limit: 20,
          search: this.searchKeyword,
        });
        this.tableData.datas = res.data.data;
        this.rows = res.data.total;
      } catch (error) {
        console.log(error);
      }
    },
  },
  watch: {
    currentPage() {
      this.fetchUsers();
    },
    searchKeyword() {
      if (this.searchKeyword === '') this.fetchUsers();
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
