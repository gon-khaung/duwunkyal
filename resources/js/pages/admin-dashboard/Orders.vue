<template>
  <div class="d-flex">
    <div class="col-lg-12 col-md-12 col-12 p-0">
      <!-- Card header -->
      <div class="card-header border-0 d-flex justify-content-between">
        <h3 class="mb-0 pl-3">Orders Management</h3>
      </div>
      <div class="table betslip-table pb-3 table-responsive">
        <DashboardTable
          :tableData="tableData"
          type="order"
          @data="getOrderData"
        />
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
    };
  },
  methods: {
    getOrderData(value) {
      Dialog.confirm({
        title: 'Are you sure?',
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Sure',
      })
        .then(() => {
          if (value.type === 'deliver') {
            var newData = value.data;
            newData.status = 'Delivered';
            this.orderUpdate(newData, value.id);
          } else {
            var newData = value.data;
            newData.status = 'Rejected';
            this.orderUpdate(newData, value.id);
          }
        })
        .catch(() => {});
    },
    async orderUpdate(data, id) {
      try {
        const res = await axios.put(`/orders/${data.id}`, data);
        this.tableData.datas[id].isEdit = !this.tableData.datas[id].isEdit;
        Toast.success('Success');
      } catch (error) {
        Toast.fail('Fail');
      }
    },
    async fetchOrders() {
      try {
        this.tableData.headings = [
          'Name',
          'Phone',
          'Address',
          'Status',
          'Total',
          'Note',
        ];
        this.tableData.contents = [
          'name',
          'phone',
          'address',
          'status',
          'total',
          'note',
        ];

        const res = await axios.get('/orders', {
          params: {
            page: this.currentPage,
            limit: 20,
          },
        });
        this.tableData.datas = res.data.data;
      } catch (error) {
        console.log(error);
      }
    },
  },
  watch: {
    currentPage() {
      this.fetchOrders();
    },
  },
  mounted() {
    this.fetchOrders();
  },
};
</script>
<style scoped>
.betslip-table {
  background: white;
}
</style>
