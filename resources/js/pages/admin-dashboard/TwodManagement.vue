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
                                ? "Twod Management"
                                : "နှစ်လုံး ထိန်းချုပ်မှု"
                        }}
                    </h2>

                    <button
                        type="button"
                        class="btn btn-danger"
                        data-toggle="modal"
                        data-target="#twodResult"
                    >
                        {{
                            $store.state.language === "en"
                                ? "Twod Result"
                                : "လျော်မည်။"
                        }}
                    </button>
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
                    <button
                        type="button"
                        class="btn btn-danger"
                        data-toggle="modal"
                        data-target="#closeSerieNumbers"
                    >
                        {{
                            $store.state.language === "en"
                                ? "Close By Serie"
                                : "ထိပ်စီးဖြင့် ပိတ်မည်။"
                        }}
                    </button>
                    <div class="d-flex p-0 justify-content-between">
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
                                            ><i class="fas fa-align-right"></i>
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
                                        ? "Twod Open"
                                        : "နှစ်လုံး ဖွင့် / ပိတ်"
                                }}
                            </h3>
                            <van-switch
                                :value="data.isOpen"
                                active-color="#ee0a24"
                                inactive-color="#dcdee0"
                                @click="changeTwod('main')"
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
                                @click="changeTwod('live')"
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
                                    <div class="bet-heading mr-5">
                                        <h3>
                                            {{
                                                $store.state.language === "en"
                                                    ? "Morning Date"
                                                    : "မနက် ထိုးချိန်"
                                            }}
                                        </h3>
                                    </div>
                                    <div class="bet-heading pl-1">
                                        <h3>
                                            {{
                                                $store.state.language === "en"
                                                    ? "Evening Date"
                                                    : "ညနေ ထိုးချိန်"
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
                                        {{ data.latest_bet_m }}
                                    </div>
                                    <input
                                        id="input-email"
                                        class="form-control mx-5"
                                        v-if="isEdit"
                                        v-model="data.latest_bet_m"
                                    />
                                    <div
                                        class="py-2 mx-2 bet-times text-center"
                                        v-if="!isEdit"
                                    >
                                        {{ data.latest_bet_e }}
                                    </div>
                                    <input
                                        id="input-email"
                                        class="form-control"
                                        v-if="isEdit"
                                        v-model="data.latest_bet_e"
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
                                        @click="changeTwod()"
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

                <!-- ==== modal for 2d result ==== -->
                <div
                    class="modal fade"
                    id="twodResult"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="modal-form"
                    aria-hidden="true"
                >
                    <div
                        class="
                            modal-dialog modal- modal-dialog-centered modal-sm
                        "
                        role="document"
                    >
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="card border-0 mb-0">
                                    <div class="card-body px-lg-5 py-lg-5">
                                        <form role="form">
                                            <div class="form-group mb-3">
                                                {{
                                                    $store.state.language ===
                                                    "en"
                                                        ? "Select Morning Or Evening"
                                                        : "မနက်လား ညနေလား"
                                                }}
                                                <v-select
                                                    :reduce="
                                                        (draw) => draw.data
                                                    "
                                                    label="label"
                                                    :options="drawOptions"
                                                    v-model="resultTime"
                                                ></v-select>
                                                <span class="text-danger">{{
                                                    errors.draw
                                                }}</span>
                                            </div>
                                            <div class="form-group">
                                                {{
                                                    $store.state.language ===
                                                    "en"
                                                        ? "Enter Result"
                                                        : "ပေါက်ဂဏန်း ထည့်သွင်းပေးပါ"
                                                }}
                                                <div
                                                    class="
                                                        mt-2
                                                        input-group
                                                        input-group-merge
                                                        input-group-alternative
                                                    "
                                                >
                                                    <div
                                                        class="
                                                            input-group-prepend
                                                        "
                                                    >
                                                        <span
                                                            class="
                                                                input-group-text
                                                            "
                                                            ><i
                                                                class="
                                                                    ni
                                                                    ni-money-coins
                                                                "
                                                            ></i
                                                        ></span>
                                                    </div>
                                                    <input
                                                        class="form-control"
                                                        v-model="result"
                                                    />
                                                </div>
                                                <span class="text-danger">{{
                                                    errors.result
                                                }}</span>
                                            </div>
                                            <div class="text-center">
                                                <button
                                                    type="button"
                                                    class="btn btn-primary"
                                                    @click="sendTwodResult()"
                                                >
                                                    {{
                                                        $store.state
                                                            .language === "en"
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
                        class="
                            modal-dialog modal- modal-dialog-centered modal-sm
                        "
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
                                                    v-model="
                                                        limit_amount_for_all
                                                    "
                                                    @keyup.enter="
                                                        updateAllLimitAmount()
                                                    "
                                                />
                                            </div>
                                            <span class="text-danger">{{
                                                errors.result
                                            }}</span>
                                        </div>
                                        <div class="text-center">
                                            <button
                                                type="button"
                                                class="btn btn-primary"
                                                @click="updateAllLimitAmount()"
                                            >
                                                <div v-if="!isConfirm">
                                                    {{
                                                        $store.state
                                                            .language === "en"
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

                <!-- ==== modal for close number by serie ==== -->
                <div
                    class="modal fade"
                    id="closeSerieNumbers"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="modal-form"
                    aria-hidden="true"
                >
                    <div
                        class="
                            modal-dialog modal- modal-dialog-centered modal-sm
                        "
                        role="document"
                    >
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="card border-0 mb-0">
                                    <div class="card-body px-lg-5 py-lg-5">
                                        <div class="form-group">
                                            {{
                                                $store.state.language === "en"
                                                    ? "Enter One Number"
                                                    : "ထိပ်စီးဂဏန်း ထည့်ပါ။"
                                            }}
                                            <div class="mt-2 input-group">
                                                <input
                                                    type="number"
                                                    class="form-control"
                                                    v-model="close_serie_number"
                                                    @keyup.enter="
                                                        closeSerieNumbers()
                                                    "
                                                />
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button
                                                type="button"
                                                class="btn btn-primary"
                                                @click="closeSerieNumbers()"
                                            >
                                                <div v-if="!isConfirm">
                                                    {{
                                                        $store.state
                                                            .language === "en"
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
        </div>
    </div>
</template>
<script>
import { Toast, Dialog, Loading } from 'vant';
import DashboardTable from './components/DashboardTable.vue';

export default {
  components: { DashboardTable, Loading },
  data() {
    return {
      close_serie_number: null,
      isConfirm: false,
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
        headings:
                    this.$store.state.language === 'en'
                      ? ['Number', 'Limit Amount', 'Current Amount', 'Status']
                      : ['ဂဏန်း', 'ကန့်သတ် ပမာဏ', 'လက်ရှိ ပမာဏ', 'အခြေအနေ'],
        contents: [
          'number',
          'limit_amount',
          'current_amount',
          'isOpen',
        ],
      },

      data: {},
      drawOptions: [
        {
          label: '12:00 (Morning)',
          data: 'morning',
        },
        {
          label: '4:30 (Evening)',
          data: 'evening',
        },
      ],
      isEdit: false,
      result: null,
      resultTime: null,
      errors: {},
      limit_amount_for_all: null,
      isSendTwodResult: false,
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
    closeSerieNumbers() {
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
          this.backendCloseSerieNumbers();
        })
        .catch(() => {
          console.log(error);
        });
    },
    async backendCloseSerieNumbers() {
      this.isConfirm = true;
      try {
        const res = await axios.post(
          '/twod_numbers/close_serie_numbers',
          {
            serieNumber: this.close_serie_number,
          },
        );
        Toast.success(
          this.$store.state.language === 'en'
            ? 'Success'
            : 'အောင်မြင်သည်။',
        );
        this.fetchTwodNumbers();
        this.close_serie_number = null;
        $('#closeSerieNumbers').modal('hide');
      } catch (error) {
        Toast.fail(
          this.$store.state.language === 'en' ? 'Fail' : 'ကျရှုံးသည်။',
        );
        this.isConfirm = false;
      }
      this.isConfirm = false;
    },
    async editLimitAmountForAll() {
      this.isConfirm = true;
      try {
        const res = await axios.post(
          '/twod_numbers/edit_limit_amount_for_all',
          {
            new_limit_amount: this.limit_amount_for_all,
          },
        );
        Toast.success(
          this.$store.state.language === 'en'
            ? 'Success'
            : 'အောင်မြင်သည်။',
        );
        this.fetchTwodNumbers();
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
    sendTwodResult() {
      if (this.isSendTwodResult) {
        return false;
      }
      this.isSendTwodResult = true;
      this.errors = {};

      if (!this.resultTime) {
        this.errors.draw = this.$store.state.language === 'en'
          ? 'Please select Draw!'
          : 'ပေါက်မည့် draw ထည့်သွင်းပေးပါ။';
        return false;
      }
      if (!this.result) {
        this.errors.result = this.$store.state.language === 'en'
          ? 'Please insert Two-D result!'
          : 'ပေါက်ဂဏန်း ထည့်သွင်းပေးပါ။';
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
          this.addNewTwodResult();
        })
        .catch(() => {
          console.log(error);
        });
      this.isSendTwodResult = false;
      return true;
    },
    async addNewTwodResult() {
      try {
        const res = await axios.post('/2d/data/result', {
          result: this.result,
          type: this.resultTime,
        });
        $('#twodResult').modal('hide');
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

    onSelect(action) {
      switch (action.text) {
        case this.$store.state.language === 'en' ? 'Default' : 'မူလ':
          this.fetchTwodNumbers();
          this.currentPage = 1;
          break;
        case this.$store.state.language === 'en'
          ? 'Numbers'
          : 'ဂဏန်း(ကြီးစဥ်ငယ်)':
          this.orderType = 'number';
          this.isDesc = true;
          this.currentPage = 1;
          this.fetchTwodNumbersWithOrder('number', true);
          break;
        case this.$store.state.language === 'en'
          ? 'Current Amount (Desc)'
          : 'လက်ရှိ ပမာဏ(ကြီးစဥ်ငယ်)':
          this.orderType = 'current_amount';
          this.isDesc = true;
          this.currentPage = 1;
          this.fetchTwodNumbersWithOrder('current_amount', true);
          break;
        case this.$store.state.language === 'en'
          ? 'Current Amount (Asc)'
          : 'လက်ရှိ ပမာဏ(ငယ်စဥ်ကြီး)':
          this.orderType = 'current_amount';
          this.isDesc = false;
          this.currentPage = 1;
          this.fetchTwodNumbersWithOrder('current_amount', false);
          break;
        case this.$store.state.language === 'en'
          ? 'Limit Amount(Desc)'
          : 'ကန့်သတ် ပမာဏ(ကြီးစဥ်ငယ်)':
          this.orderType = 'limit_amount';
          this.isDesc = true;
          this.currentPage = 1;
          this.fetchTwodNumbersWithOrder('limit_amount', true);
          break;
        case this.$store.state.language === 'en'
          ? 'Limit Amount(Asc)'
          : 'ကန့်သတ် ပမာဏ(ငယ်စဥ်ကြီး)':
          this.orderType = 'limit_amount';
          this.isDesc = false;
          this.currentPage = 1;
          this.fetchTwodNumbersWithOrder('limit_amount', false);
          break;
        case this.$store.state.language === 'en'
          ? 'Close Open'
          : 'ပိတ်ထားသော နံပါတ်များဖြင့်':
          this.orderType = 'openclose';
          this.isDesc = null;
          this.currentPage = 1;
          this.fetchTwodNumbersWithOrder('openclose', null);
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
            this.twodNumberUpdate(value.data, value.id);
            this.tableData.datas[value.id].isEdit = !this.tableData.datas[value.id].isEdit;
          } else {
            value.data.isOpen = !value.data.isOpen;
            this.twodNumberUpdate(value.data, value.id);
          }
        })
        .catch(() => {
          console.log(error);
        });
    },
    changeTwod(type) {
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
          } else if (type === 'live') {
            this.data.isLive = !this.data.isLive;
          }
          this.updateTwod().then((this.isEdit = false));
          Toast.success(
            this.$store.state.language === 'en'
              ? 'Success'
              : 'အောင်မြင်သည်။',
          );
        })
        .catch(() => {
          Toast.fail(
            this.$store.state.language === 'en'
              ? 'Fail'
              : 'ကျရှုံးသည်။',
          );
        });
    },
    async twodNumberUpdate(data, id) {
      try {
        const res = await axios.put(`/twod_numbers/${data.id}`, data);

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
    async updateTwod() {
      try {
        const res = await axios.put('/2d/data/1', this.data);
      } catch (error) {
        console.log(error);
      }
    },
    async fetchTwod() {
      try {
        const res = await axios.get('/2d/data/');
        this.data = res.data.data[0];
      } catch (error) {
        console.log(error);
      }
    },
    async fetchTwodNumbersWithOrder(orderBy, isDesc) {
      try {
        const res = await axios.post('/twod_numbers', {
          orderBy,
          isDesc,
        });
        this.tableData.datas = res.data.data;
        this.rows = res.data.total;
      } catch (error) {
        console.log(error);
      }
    },
    async searchNumber() {
      try {
        const res = await axios.post('/twod_numbers', {
          search: this.searchKeyword,
        });
        this.tableData.datas = res.data.data;
        this.rows = res.data.total;
      } catch (error) {
        console.log(error);
      }
    },
    async fetchTwodNumbers() {
      try {
        const res = await axios.post('/twod_numbers', {
          orderBy: 'current_amount',
          isDesc: true,
        });
        this.tableData.datas = res.data.data;
        this.rows = res.data.total;
      } catch (error) {
        console.log(error);
      }
    },
  },
  watch: {
    searchKeyword() {
      if (this.searchKeyword === '') this.fetchTwodNumbers();
    },
  },
  mounted() {
    this.fetchTwod();
    this.fetchTwodNumbers();
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
