<template>
  <div class="d-flex card">
    <div class="col-lg-12 col-md-12 col-12 p-0">
      <!-- Card header -->
      <div class="card-header border-0 d-flex justify-content-between">
        <h3 class="mb-0 pl-3">
          {{
            $store.state.language === "en" ? "Withdraw List" : "ငွေထုတ်မှုများ"
          }}
        </h3>
        <div>
          <button
            type="button"
            class="btn btn-outline-primary"
            :class="type === 'all' ? 'active' : ''"
            @click="changeTypeAndFetch('all')"
          >
            {{ $store.state.language === "en" ? "All" : "အားလုံး" }}
          </button>
          <button
            type="button"
            class="btn btn-outline-info"
            :class="type === 'pending' ? 'active' : ''"
            @click="changeTypeAndFetch('pending')"
          >
            {{ $store.state.language === "en" ? "Pending" : "လုပ်ဆောင်နေဆဲ" }}
          </button>
          <button
            type="button"
            class="btn btn-outline-success"
            :class="type === 'confirm' ? 'active' : ''"
            @click="changeTypeAndFetch('confirm')"
          >
            {{ $store.state.language === "en" ? "Confirm" : "အတည်ပြုပြီး" }}
          </button>
          <button
            type="button"
            class="btn btn-outline-danger"
            :class="type === 'fail' ? 'active' : ''"
            @click="changeTypeAndFetch('fail')"
          >
            {{ $store.state.language === "en" ? "Cancel" : "ငြင်းပယ်" }}
          </button>
        </div>
      </div>
      <div class="table betslip-table pb-3 table-responsive">
        <DashboardTable
          :tableData="tableData"
          @userData="getUserIdAndAmount"
          transactionType="withdraw"
        />
        <!-- pagination  -->
        <b-pagination
          v-model="currentPage"
          pills
          :total-rows="rows"
          size="sm"
          align="center"
          per-page="10"
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
        headings:
          this.$store.state.language === 'en'
            ? ['Name', 'Account No', 'Type', 'Withdraw Amount', 'Status']
            : [
              'နာမည်',
              'အကောင့်နံပါတ်',
              'အကောင့်အမျိုးအစား',
              'ထုတ်မည့် ပမာဏ',
              'အခြေအနေ',
            ],
        datas: [],
      },
      rows: null,
      currentPage: 1,
      depositActive: false,
      withdrawActive: false,
      type: 'all',
    };
  },
  methods: {
    changeTypeAndFetch(type) {
      this.type = type;
      this.fetchWithdrawHistory();
    },
    getUserIdAndAmount(data) {
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
          this.userWithdrawUpdate(
            data.id,
            data.amount,
            data.transactionId,
            data.status,
          );
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async userWithdrawUpdate(id, amount, withdrawId, status) {
      console.log(id, amount, withdrawId, status);
      try {
        if (id && amount && withdrawId) {
          const res = await axios.post(`/admin/user/${id}`, {
            amount,
            type: 'deposit',
          });
          const withdrawUpdate = await axios
            .put(`/withdraws/${withdrawId}`, {
              status,
              type: 'status update',
            })
            .then(this.fetchWithdrawHistory());
          Toast.success(
            this.$store.state.language === 'en' ? 'Success' : 'အောင်မြင်သည်။',
          );
        } else {
          const withdrawUpdate = await axios
            .put(`/withdraws/${withdrawId}`, {
              status,
              type: 'status update',
            })
            .then(this.fetchWithdrawHistory());
          Toast.success(
            this.$store.state.language === 'en' ? 'Success' : 'အောင်မြင်သည်။',
          );
        }
      } catch (error) {
        Toast.fail(
          this.$store.state.language === 'en' ? 'Fail' : 'ကျရှုံးသည်။',
        );
      }
    },
    async fetchWithdrawHistory() {
      try {
        this.depositActive = false;
        this.withdrawActive = true;
        this.tableData.contents = [
          'user_name',
          'account_number',
          'type',
          'amount',
          'status',
        ];
        const res = await axios.post('/admin/withdraws', {
          page: this.currentPage,
          limit: 20,
          type: this.type,
        });
        this.tableData.datas = res.data.data;
        this.rows = Math.ceil(res.data.total / 2);
      } catch (error) {
        console.log(error);
      }
    },
  },
  watch: {
    currentPage() {
      this.fetchWithdrawHistory();
    },
  },
  mounted() {
    this.fetchWithdrawHistory();
  },
};
</script>
<style scoped>
.betslip-table {
  background: white;
}
</style>
