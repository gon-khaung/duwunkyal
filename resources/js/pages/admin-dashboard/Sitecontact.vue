<template>
  <div class="d-flex card">
    <div class="col-lg-12 col-md-12 col-12 p-0">
      <!-- Card header -->
      <div class="card-header border-0 d-flex justify-content-between">
        <h3 class="mb-0 pl-3">Site Contacts</h3>
      </div>
      <div class="table betslip-table pb-3 table-responsive">
        <DashboardTable
          :tableData="tableData"
          @data="getUserData"
          type="payment"
        />
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
        headings: ['Phone', 'Address', 'Email', 'Open Time'],
        datas: [],
      },
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
          if (value.type === 'update') this.accountUpdate(value.data, value.id);
          else this.accountDelete(value.data, value.id);
        })
        .catch(() => {});
    },
    async accountUpdate(data, id) {
      try {
        const res = await axios.put(`/sitecontacts/${data.id}`, data);
        this.tableData.datas[id].isEdit = !this.tableData.datas[id].isEdit;
        Toast.success('Success');
      } catch (error) {
        Toast.fail('Fail');
      }
    },
    async fetchAccounts() {
      try {
        this.tableData.contents = ['phone', 'address', 'email', 'open_time'];
        const res = await axios.get('/sitecontacts');
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
