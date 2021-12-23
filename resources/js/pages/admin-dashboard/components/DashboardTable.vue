<template>
    <div class="table-responsive">
        <table class="table align-items-center" id="dashboard-select">
            <thead class="thead-light">
                <tr>
                    <th
                        v-for="(heading, index) in tableData.headings"
                        :key="index"
                        :class="index === 0 ? 'pl-5' : ''"
                    >
                        <div class="d-flex" v-if="index !== 0">
                            <div class="">{{ heading }}</div>
                        </div>
                        <div v-else>
                            {{ heading }}
                        </div>
                    </th>
                    <th>
                        <div class="d-flex">
                            <div class="mx-auto">
                                {{
                                    $store.state.language === "en"
                                        ? "Action"
                                        : "သက်ရောက်မှု"
                                }}
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody class="list">
                <tr v-for="(data, index) in tableData.datas" :key="index">
                    <th
                        scope="row"
                        v-for="(content, index) in tableData.contents"
                        :key="index"
                        :class="index === 0 ? 'pl-5' : ''"
                    >
                        <div class="media d-flex" v-if="content === 'status'">
                            <span class="mb-0 text-md">
                                <span
                                    class="badge badge-info"
                                    v-if="data[content] === 'pending'"
                                >
                                    {{
                                        $store.state.language === "en"
                                            ? `${data[content]}`
                                            : "လျောက်ထားဆဲ"
                                    }}
                                </span>
                                <span
                                    class="badge badge-success"
                                    v-if="data[content] === 'confirm'"
                                >
                                    {{
                                        $store.state.language === "en"
                                            ? `${data[content]}`
                                            : "အတည်ပြုပြီး"
                                    }}
                                </span>
                                <span
                                    class="badge badge-danger"
                                    v-if="data[content] === 'fail'"
                                >
                                    {{
                                        $store.state.language === "en"
                                            ? `${data[content]}`
                                            : "ငြင်းပယ်သည်"
                                    }}
                                </span>
                            </span>
                        </div>
                        <div
                            class="media d-flex"
                            v-else-if="content === 'isOpen'"
                        >
                            <span class="mb-0 text-md">
                                <span
                                    class="badge badge-danger"
                                    v-if="!data[content]"
                                >
                                    {{
                                        $store.state.language === "en"
                                            ? "Closed"
                                            : "ပိတ်ထားသည်"
                                    }}
                                </span>
                                <span
                                    class="badge badge-success"
                                    v-if="data[content]"
                                >
                                    {{
                                        $store.state.language === "en"
                                            ? "Running"
                                            : "ဖွင့်ထားသည်"
                                    }}
                                </span>
                            </span>
                        </div>
                        <div class="media align-items-center" v-else>
                            <span
                                class="name mb-0 text-md"
                                v-if="!data['isEdit']"
                                >{{ data[content] ? data[content] : "-" }}</span
                            >
                            <span v-else
                                ><input
                                    id="input-email"
                                    class="form-control"
                                    v-model="data[content]"
                                    v-if="content !== 'roles'"
                                />
                                <v-select
                                    v-model="data[content]"
                                    :options="rolesSelection"
                                    v-else
                                ></v-select>
                            </span>
                        </div>
                    </th>
                    <th scope="row" class="action-row">
                        <div
                            class="d-flex justify-content-end p-0"
                            v-if="type === 'users'"
                        >
                            <button
                                type="button"
                                class="btn btn-info"
                                @click="toEdit(index)"
                                v-if="!data['isEdit']"
                            >
                                {{
                                    $store.state.language === "en"
                                        ? "Edit"
                                        : "ပြင်မည်"
                                }}
                            </button>
                            <button
                                type="button"
                                class="btn btn-success"
                                @click="typedData(data, index, 'update')"
                                v-else
                            >
                                {{
                                    $store.state.language === "en"
                                        ? "Confirm"
                                        : "အတည်ပြုမည်"
                                }}
                            </button>
                            <button
                                type="button"
                                class="btn btn-danger"
                                @click="typedData(data, index, 'delete')"
                            >
                                {{
                                    $store.state.language === "en"
                                        ? "Delete"
                                        : "ဖျက်မည်"
                                }}
                            </button>
                            <button
                                type="button"
                                class="btn btn-primary"
                                @click="$router.push(`user/detail/${data.id}`)"
                            >
                                {{
                                    $store.state.language === "en"
                                        ? "Detail"
                                        : "အသေးစိတ်"
                                }}
                            </button>
                        </div>

                        <div
                            class="d-flex justify-content-end p-0"
                            v-else-if="type === 'twodNumbers'"
                        >
                            <button
                                type="button"
                                class="btn btn-info"
                                @click="toEdit(index)"
                                v-if="!data['isEdit']"
                            >
                                {{
                                    $store.state.language === "en"
                                        ? "Edit"
                                        : "ပြင်မည်"
                                }}
                            </button>
                            <button
                                type="button"
                                class="btn btn-success"
                                @click="typedData(data, index, 'update')"
                                v-else
                            >
                                {{
                                    $store.state.language === "en"
                                        ? "Confirm"
                                        : "အတည်ပြုမည်"
                                }}
                            </button>
                            <button
                                type="button"
                                class="btn btn-danger"
                                @click="typedData(data, index, 'close')"
                                v-if="data.isOpen"
                            >
                                {{
                                    $store.state.language === "en"
                                        ? "Close"
                                        : "ပိတ်မည်"
                                }}
                            </button>
                            <button
                                type="button"
                                class="btn btn-success"
                                @click="typedData(data, index, 'close')"
                                v-else
                            >
                                {{
                                    $store.state.language === "en"
                                        ? "Open"
                                        : "ဖွင့်မည်"
                                }}
                            </button>
                        </div>

                        <div
                            class="d-flex justify-content-end p-0"
                            v-else-if="type === 'payment'"
                        >
                            <button
                                type="button"
                                class="btn btn-info"
                                @click="toEdit(index)"
                                v-if="!data['isEdit']"
                            >
                                {{
                                    $store.state.language === "en"
                                        ? "Edit"
                                        : "ပြင်မည်"
                                }}
                            </button>
                            <button
                                type="button"
                                class="btn btn-success"
                                @click="typedData(data, index, 'update')"
                                v-else
                            >
                                {{
                                    $store.state.language === "en"
                                        ? "Confirm"
                                        : "အတည်ပြုမည်"
                                }}
                            </button>
                            <button
                                type="button"
                                class="btn btn-danger"
                                @click="typedData(data, index, 'delete')"
                            >
                                {{
                                    $store.state.language === "en"
                                        ? "Delete"
                                        : "ဖျက်မည်"
                                }}
                            </button>
                            <button
                                type="button"
                                class="btn btn-primary"
                                @click="openModal(`depositView-${data['id']}`)"
                            >
                                {{
                                    $store.state.language === "en"
                                        ? "View"
                                        : "ကြည့်မည်"
                                }}
                            </button>
                            <DashboardModal
                                :id_type="`depositView-${data['id']}`"
                                :image="data['qr_image']"
                                :accountData="data"
                                :isPayment="true"
                            />
                        </div>
                        <div class="d-flex justify-content-end p-0" v-else>
                            <button
                                type="button"
                                class="btn btn-success"
                                v-if="data['status'] !== 'confirm'"
                                @click="
                                    transactionType === 'deposit'
                                        ? sendUserdata(
                                              data['user_id'],
                                              data['amount'],
                                              data['id'],
                                              'confirm'
                                          )
                                        : sendUserdata(
                                              null,
                                              null,
                                              data['id'],
                                              'confirm'
                                          )
                                "
                            >
                                {{
                                    $store.state.language === "en"
                                        ? "Confirm"
                                        : "အတည်ပြုမည်"
                                }}
                            </button>
                            <button
                                type="button"
                                class="btn btn-danger"
                                v-if="
                                    data['status'] !== 'confirm' &&
                                    data['status'] !== 'fail'
                                "
                                @click="
                                    transactionType === 'deposit'
                                        ? sendUserdata(
                                              null,
                                              null,
                                              data['id'],
                                              'fail'
                                          )
                                        : sendUserdata(
                                              data['user_id'],
                                              data['amount'],
                                              data['id'],
                                              'fail'
                                          )
                                "
                            >
                                {{
                                    $store.state.language === "en"
                                        ? "Cancel"
                                        : "မလုပ်တော့ပါ"
                                }}
                            </button>
                            <button
                                type="button"
                                class="btn btn-info"
                                @click="openModal(`depositView-${data['id']}`)"
                            >
                                {{
                                    $store.state.language === "en"
                                        ? "View"
                                        : "ကြည့်မည်"
                                }}
                            </button>
                            <DashboardModal
                                :id_type="`depositView-${data['id']}`"
                                :image="
                                    data['transaction_image']
                                        ? data['transaction_image']
                                        : data['qr_image']
                                "
                                :remark="data['remark']"
                                :date="data['date']"
                            />
                        </div>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import DashboardModal from './DashboardModal.vue';

export default {
  data() {
    return {
      rolesSelection: ['admin', 'comissioner', 'normal'],
    };
  },
  props: ['tableData', 'type', 'transactionType'],
  components: { DashboardModal },
  methods: {
    openModal(modalName) {
      $(`#${modalName}`).modal('show');
    },
    toEdit(id) {
      this.tableData.datas[id].isEdit = !this.tableData.datas[id].isEdit;
    },
    typedData(data, id, type) {
      this.$emit('data', { data, id, type });
    },
    sendUserdata(id, amount, transactionId, status) {
      this.$emit('userData', {
        id,
        amount,
        transactionId,
        status,
      });
    },
  },
};
</script>
<style scoped>
.action-row {
    width: 200px;
}
.btn {
    padding: 0.4rem 0.8rem;
}
</style>
