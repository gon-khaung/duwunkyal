<template>
    <div>
        <div class="col-lg-12 col-12 mx-auto p-0 d-flex main-image-wrapper">
            <b-carousel
                id="carousel-1"
                :interval="3000"
                controls
                fade
                style="text-shadow: 1px 1px 2px #333; width: 100%; height: 100%"
                v-if="!threedData.embedded_link && !threedData.isLive"
            >
                <!-- Text slides with image -->
                <b-carousel-slide
                    img-src="/build/assets/img/theme/main1.png"
                ></b-carousel-slide>

                <b-carousel-slide
                    img-src="/build/assets/img/theme/main2.png"
                ></b-carousel-slide>
                <b-carousel-slide
                    img-src="/build/assets/img/theme/main3.png"
                ></b-carousel-slide>
            </b-carousel>
            <div
                class="m-auto col-12 pt-4 video-container"
                v-if="threedData.embedded_link && threedData.isLive"
                v-html="threedData.embedded_link"
            ></div>
        </div>
        <NoticeBar
            class="col-lg-12 col-12 mx-auto notice-bar"
            scrollable
            text="Star website တွင် နှစ်လုံးကို မနက် ၁၁နာရီ ၄၀ နှင့် ညနေ ၃နာရီ ၅၀ အထိ ကစားနိုင်ပါသည်။ သုံးလုံးကို ထွက်မည့်နေ့ ၁ နာရီ အထိ ကစားနိုင်ပါသည်။"
            v-if="!threedData.embedded_link && !threedData.isLive"
        />

        <div class="justify-content-center mt-4 pt-2 cards-container">
            <div class="col-xl-4 home-cards" @click="redirectRoute('2d')">
                <div class="card twod-threed-cards">
                    <img
                        src="/build/assets/img/theme/twod.png"
                        alt=""
                        style="width: 100%; height: 100%; border-radius: 5px"
                    />
                </div>
            </div>
            <div class="col-xl-4 home-cards live-card">
                <div class="card twod-threed-cards">
                    <div class="card-header" v-if="isLive">
                        <div v-if="$store.state.language === 'en'">
                            2D live Result
                        </div>
                        <div v-else><h3>နှစ်လုံး တိုက်ရိုက်ရလဒ်</h3></div>
                        <div>
                            <b-spinner variant="secondary"></b-spinner>
                        </div>
                    </div>
                    <div class="card-body d-flex" v-if="isLive">
                        <div class="my-auto col-12">
                            <div
                                class="live-set-val-container d-flex col-12 p-0"
                            >
                                <div class="col-6 p-0">
                                    <span>
                                        Set &nbsp;- &nbsp;
                                        <span class="live-number">{{
                                            twoDdata.SET
                                        }}</span></span
                                    >
                                </div>
                                <div class="col-6 p-0">
                                    <span
                                        >Value &nbsp;- &nbsp;
                                        <span class="live-number">{{
                                            twoDdata.VAL
                                        }}</span></span
                                    >
                                </div>
                            </div>
                            <div class="text-center card">
                                <span class="live-result">{{
                                    twoDdata.NUM
                                }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex" v-if="!isLive">
                        <div
                            class="my-auto mx-auto not-live-text"
                            v-if="$store.state.language === 'en'"
                        >
                            Live Result will be shown here!
                        </div>
                        <div class="my-auto mx-auto not-live-text" v-else>
                            တိုက်ရိုက်နှစ်လုံးရလဒ်ကို ဒီနေရာတွင်ဖော်ပြမည်
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 home-cards" @click="redirectRoute('3d')">
                <div class="card twod-threed-cards">
                    <img
                        src="/build/assets/img/theme/threed.png"
                        alt=""
                        style="width: 100%; height: 100%; border-radius: 5px"
                    />
                </div>
            </div>
        </div>
        <div class="justify-content-center cards-container-mobile">
            <div
                class="col-xl-6 col-6 home-cards pr-2"
                @click="redirectRoute('2d')"
            >
                <div class="card">
                    <img
                        src="/build/assets/img/theme/twod.png"
                        alt=""
                        style="width: 100%; height: 100%; border-radius: 5px"
                    />
                </div>
            </div>

            <div
                class="col-xl-6 col-6 home-cards pl-2"
                @click="redirectRoute('3d')"
            >
                <div class="card">
                    <img
                        src="/build/assets/img/theme/threed.png"
                        alt=""
                        style="width: 100%; height: 100%; border-radius: 5px"
                    />
                </div>
            </div>
            <div class="col-xl-4 home-cards live-card">
                <div class="card twod-threed-cards">
                    <div class="card-header" v-if="isLive">
                        <div v-if="$store.state.language === 'en'">
                            2D live Result
                        </div>
                        <div v-else><h3>နှစ်လုံး တိုက်ရိုက်ရလဒ်</h3></div>
                        <div>
                            <b-spinner variant="secondary"></b-spinner>
                        </div>
                    </div>
                    <div class="card-body d-flex" v-if="isLive">
                        <div class="my-auto col-12">
                            <div
                                class="
                                    live-set-val-container
                                    d-flex
                                    col-12
                                    p-0
                                    mb-3
                                "
                            >
                                <div class="col-6 p-0">
                                    <span>
                                        Set &nbsp;- &nbsp;
                                        <span class="live-number">{{
                                            twoDdata.SET
                                        }}</span></span
                                    >
                                </div>
                                <div class="col-6 p-0">
                                    <span
                                        >Value &nbsp;- &nbsp;
                                        <span class="live-number">{{
                                            twoDdata.VAL
                                        }}</span></span
                                    >
                                </div>
                            </div>
                            <div class="text-center card">
                                <span class="live-result">{{
                                    twoDdata.NUM
                                }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex" v-if="!isLive">
                        <div
                            class="my-auto mx-auto not-live-text"
                            v-if="$store.state.language === 'en'"
                        >
                            Live Result will be shown here!
                        </div>
                        <div class="my-auto mx-auto not-live-text" v-else>
                            တိုက်ရိုက်နှစ်လုံးရလဒ်ကို ဒီနေရာတွင်ဖော်ပြမည်
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-wrap">
            <div class="col-xl-7 home-cards">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3
                                    class="mb-0"
                                    v-if="$store.state.language === 'en'"
                                >
                                    Recent 2d history
                                </h3>
                                <h3 class="mb-0" v-else>
                                    နှစ်လုံးထွက်ပြီး ဂဏန်းများ
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr v-if="$store.state.language === 'en'">
                                    <th
                                        scope="col"
                                        class="text-center table-header"
                                    >
                                        Date
                                    </th>
                                    <th
                                        scope="col"
                                        class="text-center table-header"
                                    >
                                        Morning
                                    </th>
                                    <th
                                        scope="col"
                                        class="text-center table-header"
                                    >
                                        Evening
                                    </th>
                                </tr>
                                <tr v-else>
                                    <th
                                        scope="col"
                                        class="text-center table-header"
                                    >
                                        နေ့စွဲ
                                    </th>
                                    <th
                                        scope="col"
                                        class="text-center table-header"
                                    >
                                        မနက်
                                    </th>
                                    <th
                                        scope="col"
                                        class="text-center table-header"
                                    >
                                        ညနေ
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(
                                        twodHistory, index
                                    ) in twoDHistories"
                                    :key="index"
                                >
                                    <td class="text-center" scope="row">
                                        <h3>{{ twodHistory.draw_date }}</h3>
                                    </td>
                                    <td class="text-center">
                                        <h3>
                                            {{ twodHistory.morning_result }}
                                        </h3>
                                    </td>
                                    <td class="text-center">
                                        <h3>
                                            {{ twodHistory.evening_result }}
                                        </h3>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 home-cards">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3
                                    class="mb-0"
                                    v-if="$store.state.language === 'en'"
                                >
                                    Recent 3d history
                                </h3>
                                <h3 class="mb-0" v-else>
                                    သုံးလုံးထွက်ပြီး ဂဏန်းများ
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr v-if="$store.state.language === 'en'">
                                    <th
                                        scope="col"
                                        class="text-center table-header"
                                    >
                                        Date
                                    </th>
                                    <th
                                        scope="col"
                                        class="text-center table-header"
                                    >
                                        Result
                                    </th>
                                </tr>
                                <tr v-else>
                                    <th
                                        scope="col"
                                        class="text-center table-header"
                                    >
                                        နေ့စွဲ
                                    </th>
                                    <th
                                        scope="col"
                                        class="text-center table-header"
                                    >
                                        ရလဒ်
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(
                                        threeDhistory, index
                                    ) in threeDHistories"
                                    :key="index"
                                >
                                    <td scope="row" class="text-center">
                                        <h3>
                                            {{
                                                threedDrawDateFormat(
                                                    threeDhistory.draw_date
                                                )
                                            }}
                                        </h3>
                                    </td>
                                    <td class="text-center">
                                        <h3>{{ threeDhistory.result }}</h3>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { NoticeBar } from 'vant';

export default {
  components: { NoticeBar },
  data() {
    return {
      twoDdata: {},
      isLive: false,
      twoDHistories: {},
      threeDHistories: {},
      interval: null,
      threedData: {},
    };
  },
  methods: {
    redirectRoute(path) {
      if (this.$auth.check('normal')) {
        if (path === '2d') {
          this.$router.push('/user/2d');
        } else {
          this.$router.push('/user/3d');
        }
        return true;
      }
      if (path === '2d') {
        this.$router.push('/comissioner/2d');
      } else {
        this.$router.push('/comissioner/3d');
      }
      return true;
    },
    threedDrawDateFormat(date) {
      return moment(date).format('ll');
    },
    async fetchTwoDliveresult() {
      try {
        const res = await axios.get('/2d/data/live');
        this.twoDdata = res.data.data;
      } catch (error) {
        console.log(error);
      }
    },
    fetchLive() {
      this.interval = setInterval(() => this.fetchTwoDliveresult(), 4000);
    },
    async fetchTwoDdata() {
      try {
        const res = await axios.get('/2d/data');
        this.isLive = res.data.data[0].isLive;
        if (this.isLive) {
          this.fetchTwoDliveresult();
          this.fetchLive();
        }
      } catch (error) {
        console.log(error);
      }
    },
    async fetchThreedDdata() {
      try {
        const res = await axios.get('/3d/data');
        this.threedData = res.data.data[0];
      } catch (error) {
        console.log(error);
      }
    },
    async fetchTwoThreeDHistories() {
      try {
        const twoDres = await axios.get('/twod_history');
        const threeDres = await axios.get('/threed_history');
        this.twoDHistories = twoDres.data.data;
        this.threeDHistories = threeDres.data.data;
      } catch (error) {
        console.log(error);
      }
    },
  },
  destroyed() {
    clearInterval(this.interval);
  },
  unmount() {
    clearInterval(this.interval);
  },
  mounted() {
    this.fetchTwoDdata();
    this.fetchThreedDdata();
    this.fetchTwoThreeDHistories();
  },
};
</script>
<style scoped>
.main-image-wrapper img {
    width: 100%;
}
.video-container {
    height: 500px;
    width: 100%;
}
.notice-bar {
    margin-top: -40px;
    z-index: 1;
    /* color: white; */
    font-size: 20px;
    /* background: rgba(0, 0, 0, 0.5); */
    color: #172b4c;
    background: rgba(255, 242, 0, 0.7);
}
.twod-threed-cards {
    height: 200px;
}
.live-number {
    font-weight: bold;
    font-size: 25px;
}
.live-result {
    font-weight: bolder;
    font-size: 60px;
    animation-name: live-number-animation;
    animation-duration: 2s;
    animation-iteration-count: infinite;
}
.not-live-text {
    font-weight: bold;
    font-size: 24px;
}
.cards-container {
    display: flex;
    flex-wrap: wrap;
}
.card-body {
    padding: 0px !important;
}
.cards-container-mobile {
    display: none;
}
@keyframes live-number-animation {
    from {
        color: white;
    }
    to {
        color: red;
    }
}

@media (max-width: 768px) {
    .video-container {
        height: 300px;
        width: 100%;
    }
    .main-wrapper {
        padding: 7px !important;
    }
    .notice-bar {
        margin-top: 0px;
        height: 30px;
        z-index: 1;
        font-size: 13px;
        color: #172b4c;
        background: rgba(255, 242, 0, 0.7);
    }
    .live-number {
        font-weight: bold;
        font-size: 20px;
    }
    .live-result {
        font-weight: bolder;
        font-size: 37px;
    }

    .cards-container {
        display: none;
    }
    .cards-container-mobile {
        padding: 0px !important;
        margin-top: 15px !important;
        display: flex;
        flex-wrap: wrap;
    }
    .home-cards {
        padding-left: 10px;
        padding-right: 10px;
    }
    .card-body {
        padding: 0px !important;
    }
    .not-live-text {
        font-size: 18px;
        padding-left: 10px;
        padding-right: 10px;
    }
}
</style>
