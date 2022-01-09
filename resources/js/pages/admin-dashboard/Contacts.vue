<template>
    <div class="d-flex">
        <div class="col-lg-12 col-md-12 col-12 p-0">
            <!-- Card header -->
            <div class="card-header border-0 d-flex justify-content-between">
                <h3 class="mb-0 pl-3">Contacts</h3>
            </div>
            <div class="table betslip-table pb-3 table-responsive">
                <DashboardTable
                    :tableData="tableData"
                    type="contacts"
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
    async fetchOrders() {
      try {
        this.tableData.headings = ['From', 'Message'];
        this.tableData.contents = ['name', 'message'];

        const res = await axios.get('/contacts', {
          params: {
            page: this.currentPage,
            limit: 20,
          },
        });
        this.tableData.datas = res.data.data;
        this.rows = Math.ceil(res.data.total / 20);
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
