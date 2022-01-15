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
          <th v-if="type !== 'contacts'">
            <div class="d-flex">
              <div class="mx-auto">Action</div>
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
                  v-if="data[content] === 'Pending'"
                >
                  {{ data[content] }}
                </span>
                <span
                  class="badge badge-success"
                  v-if="data[content] === 'Delivered'"
                >
                  {{ data[content] }}
                </span>
                <span
                  class="badge badge-danger"
                  v-if="data[content] === 'Rejected'"
                >
                  {{ data[content] }}
                </span>
              </span>
            </div>
            <div class="media d-flex" v-else-if="content === 'isOpen'">
              <span class="mb-0 text-md">
                <span class="badge badge-danger" v-if="!data[content]"
                  >Closed
                </span>
                <span class="badge badge-success" v-if="data[content]"
                  >Running
                </span>
              </span>
            </div>
            <div class="media d-flex" v-else-if="content === 'is_featured'">
              <input
                type="checkbox"
                name=""
                v-model="data[content]"
                @click.prevent="changeFeatured(data)"
              />
            </div>
            <div class="media d-flex" v-else-if="content === 'is_instock'">
              <input
                type="checkbox"
                name=""
                v-model="data[content]"
                @click.prevent="changeInstock(data)"
              />
            </div>
            <div class="media align-items-center" v-else>
              <span class="name mb-0 text-md" v-if="!data['isEdit']">{{
                data[content] ? data[content] : "-"
              }}</span>
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
          <th scope="row" class="action-row" v-if="type !== 'contacts'">
            <div class="d-flex justify-content-end p-0" v-if="type === 'order'">
              <button
                type="button"
                class="btn btn-success"
                @click="typedData(data, index, 'deliver')"
                v-if="data['status'] !== 'Delivered'"
              >
                Deliver
              </button>
              <button
                type="button"
                class="btn btn-danger"
                @click="typedData(data, index, 'reject')"
                v-if="data['status'] !== 'Delivered'"
              >
                Reject
              </button>
            </div>

            <div
              class="d-flex justify-content-end p-0"
              v-if="type === 'categories'"
            >
              <button
                type="button"
                class="btn btn-info"
                @click="showModal(data)"
              >
                Edit
              </button>
              <button
                type="button"
                class="btn btn-danger"
                @click="typedData(data, index, 'delete')"
              >
                Delete
              </button>
            </div>

            <div
              class="d-flex justify-content-end p-0"
              v-if="type === 'products'"
            >
              <button
                type="button"
                class="btn btn-info"
                @click="showModal(data)"
              >
                Edit
              </button>
              <button
                type="button"
                class="btn btn-danger"
                @click="typedData(data, index, 'delete')"
              >
                Delete
              </button>
            </div>

            <div
              class="d-flex justify-content-end p-0"
              v-if="
                type !== 'order' && type !== 'categories' && type !== 'products'
              "
            >
              <button
                type="button"
                class="btn btn-info"
                @click="toEdit(index)"
                v-if="!data['isEdit']"
              >
                Edit
              </button>
              <button
                type="button"
                class="btn btn-success"
                @click="typedData(data, index, 'update')"
                v-else
              >
                Confirm
              </button>
              <button
                type="button"
                class="btn btn-danger"
                @click="typedData(data, index, 'delete')"
              >
                Delete
              </button>
            </div>
          </th>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import { Toast, Dialog } from 'vant';

export default {
  data() {
    return {
      rolesSelection: ['admin', 'user'],
    };
  },
  props: ['tableData', 'type', 'transactionType'],
  methods: {
    changeFeatured(data) {
      Dialog.confirm({
        title:
          data.is_featured === false
            ? 'Make this Featured Category?'
            : 'Removed this Featured Category?',
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Sure',
      })
        .then(() => {
          this.addOrRemoveNewData(data, 'is_featured');
        })
        .catch(() => {});
    },
    changeInstock(data) {
      Dialog.confirm({
        title:
          data.is_featured === false
            ? 'Make this in stock?'
            : 'Removed this out of stock?',
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Sure',
      })
        .then(() => {
          this.addOrRemoveNewData(data, 'is_instock');
        })
        .catch(() => {});
    },
    async addOrRemoveNewData(data, type) {
      try {
        const newData = data;
        newData[type] = !newData[type];
        const res = await axios.put(`/${this.type}/${newData.id}`, newData);
        if (type === 'is_instock') {
          Toast.success(newData[type] === true ? 'Added!' : 'Removed!');
        } else {
          Toast.success(newData[type] === true ? 'Success' : 'Fail!');
        }
      } catch (error) {
        Toast.fail('Something wrong!');
      }
    },
    openModal(modalName) {
      $(`#${modalName}`).modal('show');
    },
    showModal(data) {
      this.$emit('show', data);
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
