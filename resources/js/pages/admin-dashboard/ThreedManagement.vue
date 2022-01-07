<template>
    <div>
        <div class="d-flex">
            <div class="col-lg-12 col-md-12 col-12 p-0 card">
                <!-- Card header -->
                <div
                    class="card-header border-0 d-flex justify-content-between"
                >
                    <h2 class="mb-0 pl-3">
                        {{
                            $store.state.language === "en"
                                ? "Three-D Management"
                                : "သုံးလုံး ထိန်းချုပ်မှု"
                        }}
                    </h2>
                    <div class="d-flex">
                        <input
                            id="input-email"
                            class="form-control mr-2"
                            v-model="threedNumber"
                            v-if="isResult"
                        />
                        <button
                            type="button"
                            class="btn"
                            :class="!isResult ? 'btn-danger' : 'btn-success'"
                            @click="sendThreedResult"
                        >
                            {{
                                $store.state.language === "en"
                                    ? "Threed Result"
                                    : "လျော်မည်။"
                            }}
                        </button>
                    </div>
                    <button
                        type="button"
                        class="btn btn-danger"
                        data-toggle="modal"
                        data-target="#editLimitAmount"
                    >
                        {{
                            $store.state.language === "en"
                                ? "Change Limit Amount"
                                : "ကန့်သတ် ပမာဏပြင်မည်။"
                        }}
                    </button>

                    <div class="d-flex p-0 justify-content-between">
                        <div class="d-flex">
                            <input
                                id="input-email"
                                class="form-control search"
                                placeholder="Search number"
                                v-model="searchKeyword"
                                @keyup.enter="searchNumber"
                            />
                            <button
                                type="button"
                                class="btn btn-success ml-2 mr-3"
                                @click="searchNumber"
                            >
                                {{
                                    $store.state.language === "en"
                                        ? "Search"
                                        : "ရှာမည်"
                                }}
                            </button>
                        </div>
                        <div>
                            <van-popover
                                v-model="showPopover"
                                trigger="click"
                                :actions="actions"
                                @select="onSelect"
                            >
                                <template #reference>
                                    <div
                                        class="
                                            py-2
                                            px-3
                                            text-center
                                            sort-button
                                        "
                                    >
                                        <span
                                            ><i
                                                class="fas fa-align-right mr-2"
                                            ></i>
                                            {{
                                                $store.state.language === "en"
                                                    ? "Sort by"
                                                    : "စီမည်"
                                            }}</span
                                        >
                                    </div>
                                </template>
                            </van-popover>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col-3">
                            <h3 class="card-title">
                                {{
                                    $store.state.language === "en"
                                        ? "Three-D Open"
                                        : "သုံးလုံး ဖွင့် / ပိတ်"
                                }}
                            </h3>
                            <van-switch
                                :value="data.isOpen"
                                active-color="#ee0a24"
                                inactive-color="#dcdee0"
                                @click="changeThreed('main')"
                            />
                        </div>
                        <div class="col-2">
                            <h3 class="card-title">
                                {{
                                    $store.state.language === "en"
                                        ? "Live"
                                        : "တိုက်ရိုက်"
                                }}
                            </h3>
                            <van-switch
                                :value="data.isLive"
                                active-color="#ee0a24"
                                inactive-color="#dcdee0"
                                @click="changeThreed('live')"
                            />
                        </div>
                        <div class="col-7 d-flex justify-content-end px-0">
                            <div>
                                <div class="d-flex">
                                    <div class="bet-heading mr-5">
                                        <h3>
                                            {{
                                                $store.state.language === "en"
                                                    ? "Odds"
                                                    : "ဆများ"
                                            }}
                                        </h3>
                                    </div>
                                    <div class="bet-heading pl-1">
                                        <h3>
                                            {{
                                                $store.state.language === "en"
                                                    ? "Latest Bet"
                                                    : "နောက်ဆုံး ထိုးချိန်"
                                            }}
                                        </h3>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-start py-2">
                                    <div
                                        class="py-2 mr-5 bet-times text-center"
                                        v-if="!isEdit"
                                    >
                                        {{ data.odds }}
                                    </div>
                                    <input
                                        id="input-email"
                                        class="form-control"
                                        v-if="isEdit"
                                        v-model="data.odds"
                                    />
                                    <div
                                        class="py-2 mr-5 bet-times text-center"
                                        v-if="!isEdit"
                                    >
                                        {{ data.latest_bet }}
                                    </div>
                                    <input
                                        id="input-email"
                                        class="form-control mx-5"
                                        v-if="isEdit"
                                        v-model="data.latest_bet"
                                    />
                                    <button
                                        type="button"
                                        class="btn btn-danger ml-3"
                                        @click="isEdit = true"
                                        v-if="!isEdit"
                                    >
                                        {{
                                            $store.state.language === "en"
                                                ? "Edit"
                                                : "ပြင်မည်"
                                        }}
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-success ml-3"
                                        v-if="isEdit"
                                        @click="changeThreed('main')"
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
                <div class="table betslip-table pb-3 table-responsive">
                    <DashboardTable
                        :tableData="tableData"
                        type="twodNumbers"
                        @data="getUserData"
                    />
                </div>
            </div>
        </div>
        <DashboardModal
            type="live"
            id_type="live_modal"
            @makeLive="makeLive"
            :data="data"
            field="embedded_link"
        />
        <!-- ==== modal for limit amount edit ==== -->
        <div
            class="modal fade"
            id="editLimitAmount"
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
                    <div class="modal-body">
                        <div class="card border-0 mb-0">
                            <div class="card-body px-lg-5 py-lg-5">
                                <div class="form-group">
                                    {{
                                        $store.state.language === "en"
                                            ? "Enter Limit Amount For All numbers"
                                            : "ဂဏန်းအားလုံးအတွတ် ကန့်သတ်ပမာဏထည့်ပေးပါ။"
                                    }}
                                    <div class="mt-2 input-group">
                                        <input
                                            type="number"
                                            class="form-control"
                                            v-model="limit_amount_for_all"
                                            @keyup.enter="
                                                updateAllLimitAmount()
                                            "
                                        />
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        @click="updateAllLimitAmount()"
                                    >
                                        <div v-if="!isConfirm">
                                            {{
                                                $store.state.language === "en"
                                                    ? "Confirm"
                                                    : "အတည်ပြုမည်"
                                            }}
                                        </div>

                                        <Loading
                                            color="#ffffff"
                                            v-if="isConfirm"
                                            size="24"
                                            class="px-4 py-0"
                                        />
                                    </button>
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
import { Toast, Dialog, Loading } from 'vant';
import DashboardTable from './components/DashboardTable.vue';
import DashboardModal from './components/DashboardModal.vue';

export default {
  components: { DashboardTable, DashboardModal, Loading },
  data() {
    return {
      isConfirm: false,
      limit_amount_for_all: null,
      showPopover: false,
      actions:
                this.$store.state.language === 'en'
                  ? [
                    { text: 'Default' },
                    { text: 'Numbers' },
                    { text: 'Current Amount (Desc)' },
                    { text: 'Current Amount (Asc)' },
                    { text: 'Limit Amount(Desc)' },
                    { text: 'Limit Amount(Asc)' },
                    { text: 'Close Open' },
                  ]
                  : [
                    { text: 'မူလ' },
                    { text: 'ဂဏန်း(ကြီးစဥ်ငယ်)' },
                    { text: 'လက်ရှိ ပမာဏ(ကြီးစဥ်ငယ်)' },
                    { text: 'လက်ရှိ ပမာဏ(ငယ်စဥ်ကြီး)' },
                    { text: 'ကန့်သတ် ပမာဏ(ကြီးစဥ်ငယ်)' },
                    { text: 'ကန့်သတ် ပမာဏ(ငယ်စဥ်ကြီး)' },
                    { text: 'ပိတ်ထားသော နံပါတ်များဖြင့်' },
                  ],
      searchKeyword: '',
      tableData: {
        datas: [],
        headings: [
          'Number',
          'Limit Amount',
          'Current Amount',
          'Status',
        ],
        contents: [
          'number',
          'limit_amount',
          'current_amount',
          'isOpen',
        ],
      },
      data: {},
      isEdit: false,
      isResult: false,
      orderType: null,
      isDesc: null,
      threedNumber: null,
      isThreedResult: false,
    };
  },
  methods: {
    updateAllLimitAmount() {
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
          this.editLimitAmountForAll();
        })
        .catch(() => {
          console.log(error);
        });
    },
    async editLimitAmountForAll() {
      this.isConfirm = true;
      try {
        const res = await axios.post(
          '/threed_numbers/edit_limit_amount_for_all',
          {
            new_limit_amount: this.limit_amount_for_all,
          },
        );
        Toast.success(
          this.$store.state.language === 'en'
            ? 'Success'
            : 'အောင်မြင်သည်။',
        );
        this.fetchThreedNumbers();
        this.limit_amount_for_all = null;
        $('#editLimitAmount').modal('hide');
      } catch (error) {
        Toast.fail(
          this.$store.state.language === 'en' ? 'Fail' : 'ကျရှုံးသည်။',
        );
        this.isConfirm = false;
      }
      this.isConfirm = false;
    },
    onSelect(action) {
      switch (action.text) {
        case this.$store.state.language === 'en' ? 'Default' : 'မူလ':
          this.fetchThreedNumbers();
          this.currentPage = 1;
          break;
        case this.$store.state.language === 'en'
          ? 'Numbers'
          : 'ဂဏန်း(ကြီးစဥ်ငယ်)':
          this.orderType = 'number';
          this.isDesc = true;
          this.currentPage = 1;
          this.fetchThreedNumbersWithOrder('number', true);
          break;
        case this.$store.state.language === 'en'
          ? 'Current Amount (Desc)'
          : 'လက်ရှိ ပမာဏ(ကြီးစဥ်ငယ်)':
          this.orderType = 'current_amount';
          this.isDesc = true;
          this.currentPage = 1;
          this.fetchThreedNumbersWithOrder('current_amount', true);
          break;
        case this.$store.state.language === 'en'
          ? 'Current Amount (Asc)'
          : 'လက်ရှိ ပမာဏ(ငယ်စဥ်ကြီး)':
          this.orderType = 'current_amount';
          this.isDesc = false;
          this.currentPage = 1;
          this.fetchThreedNumbersWithOrder('current_amount', false);
          break;
        case this.$store.state.language === 'en'
          ? 'Limit Amount(Desc)'
          : 'ကန့်သတ် ပမာဏ(ကြီးစဥ်ငယ်)':
          this.orderType = 'limit_amount';
          this.isDesc = true;
          this.currentPage = 1;
          this.fetchThreedNumbersWithOrder('limit_amount', true);
          break;
        case this.$store.state.language === 'en'
          ? 'Limit Amount(Asc)'
          : 'ကန့်သတ် ပမာဏ(ငယ်စဥ်ကြီး)':
          this.orderType = 'limit_amount';
          this.isDesc = false;
          this.currentPage = 1;
          this.fetchThreedNumbersWithOrder('limit_amount', false);
          break;

        case this.$store.state.language === 'en'
          ? 'Close Open'
          : 'ပိတ်ထားသော နံပါတ်များဖြင့်':
          this.orderType = 'openclose';
          this.isDesc = null;
          this.currentPage = 1;
          this.fetchThreedNumbersWithOrder('openclose', null);
          break;

        default:
          break;
      }
    },
    getUserData(data) {
      const value = data;
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
          if (value.type === 'update') {
            this.threedNumberUpdate(value.data, value.id);
            this.tableData.datas[value.id].isEdit = !this.tableData.datas[value.id].isEdit;
          } else {
            value.data.isOpen = !value.data.isOpen;
            this.threedNumberUpdate(value.data, value.id);
          }
        })
        .catch(() => {});
    },
    makeLive(value) {
      this.data.isLive = !this.data.isLive;
      this.updateThreed().then((this.isEdit = false));
      Toast.success('Success');
      $('#live_modal').modal('hide');
    },
    changeThreed(type) {
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
          if (type === 'main') {
            this.data.isOpen = !this.data.isOpen;
            this.updateThreed().then((this.isEdit = false));
            Toast.success(
              this.$store.state.language === 'en'
                ? 'Success'
                : 'အောင်မြင်သည်။',
            );
          } else if (type === 'live') {
            if (this.data.isLive) {
              this.data.isLive = !this.data.isLive;
              this.data.embedded_link = null;
              this.updateThreed().then((this.isEdit = false));
              Toast.success(
                this.$store.state.language === 'en'
                  ? 'Success'
                  : 'အောင်မြင်သည်။',
              );
            } else {
              $('#live_modal').modal('show');
            }
          }
        })
        .catch(() => {
          Toast.fail(
            this.$store.state.language === 'en'
              ? 'Fail'
              : 'ကျရှုံးသည်။',
          );
        });
    },
    async threedNumberUpdate(data, id) {
      try {
        const res = await axios.put(`/threed_numbers/${data.id}`, data);

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
    async updateThreed() {
      try {
        const res = await axios.put('/3d/data/1', this.data);
      } catch (error) {
        console.log(error);
      }
    },
    async fetchThreed() {
      try {
        const res = await axios.get('/3d/data/');
        this.data = res.data.data[0];
      } catch (error) {
        console.log(error);
      }
    },
    async fetchThreedNumbersWithOrder(orderBy, isDesc) {
      try {
        const res = await axios.post('/threed_numbers', {
          orderBy,
          isDesc,
        });
        this.tableData.datas = res.data.data;
        this.rows = res.data.total / 5;
      } catch (error) {
        console.log(error);
      }
    },
    async searchNumber() {
      try {
        const res = await axios.post('/threed_numbers', {
          search: this.searchKeyword,
        });
        this.tableData.datas = res.data.data;
        this.rows = res.data.total;
      } catch (error) {
        console.log(error);
      }
    },
    async fetchThreedNumbers() {
      try {
        const res = await axios.post('/threed_numbers', {
          orderBy: 'current_amount',
          isDesc: true,
        });
        this.tableData.datas = res.data.data;
        this.rows = res.data.total / 5;
      } catch (error) {
        console.log(error);
      }
    },
    sendThreedResult() {
      this.isThreedResult = true;
      if (!this.isResult) {
        this.isResult = true;
        return false;
      }
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
          this.addNewThreedResult();
          this.isResult = false;
        })
        .catch(() => {});
      this.isThreedResult = false;
      return true;
    },
    drawDateAsTimestamp() {
      const currentDate = new Date();
      const currentDay = currentDate.getDate();
      if (currentDay <= 16 && currentDay !== 1) {
        currentDate.setDate(16);
        return moment(currentDate).format();
      }
      currentDate.setDate(1);
      return moment(currentDate).format();
    },
    async addNewThreedResult() {
      try {
        const res = await axios.post('/3d/data/result', {
          result: this.threedNumber,
          draw_date: this.drawDateAsTimestamp(),
        });

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
  },
  watch: {
    currentPage() {
      if (this.orderType || this.isDesc) {
        this.fetchThreedNumbersWithOrder(this.orderType, this.isDesc);
      } else {
        this.fetchThreedNumbers();
      }
    },
    searchKeyword() {
      if (this.searchKeyword === '') this.fetchThreedNumbers();
    },
  },
  mounted() {
    this.fetchThreed();
    this.fetchThreedNumbers();
  },
};
</script>
<style scoped>
.sort-button {
    border: 1px solid grey;
    border-radius: 5px;
    cursor: pointer;
}
.sort-button:active {
    background: rgb(180, 176, 176);
}
.bet-times {
    border: 1px solid grey;
    border-radius: 5px;
    flex-shrink: 0;
    width: 110px;
}
.bet-heading {
    width: 110px;
}
.form-control {
    width: 110px;
    height: auto;
}
.form-control.search {
    width: 200px;
    height: auto;
}
</style>
