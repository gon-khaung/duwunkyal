<template>
  <!-- ==== main slider ==== -->
  <div class="container mb-5 mt-5">
    <div class="d-flex justify-content-between">
      <h3 class="pb-4">Categories</h3>
      <div class="d-flex">
        <div class="d-flex mobile-view-left-arrow" @click="scrollBar('left')">
          <i class="fas fa-chevron-left mx-auto my-auto"></i>
        </div>
        <div
          class="d-flex ml-2 mobile-view-right-arrow"
          @click="scrollBar('right')"
        >
          <i class="fas fa-chevron-right my-auto mx-auto"></i>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-center">
      <div class="my-auto left-click">
        <i
          class="fas fa-chevron-left left-arrow"
          @click="scrollBar('left')"
        ></i>
      </div>
      <div
        id="artists"
        class="d-flex col-11"
        @wheel.prevent="handleWheel($event, '#artists')"
      >
        <div
          v-for="category in categories"
          :key="category.id"
          class="slider-divs mr-3 ml-3"
        >
          <img :src="category.image" />
          <div
            class="overlay"
            @click="
              $router
                .push({ path: `/shop/category/${category.id}` })
                .catch(() => {}),
                sendArtistIdFetch(category.id, category.id),
                $router.go()
            "
          ></div>
          <h3 class="pt-3 font-weight-bold text-center">
            {{ category.name }}
          </h3>
        </div>
      </div>
      <div class="my-auto right-click d-flex justify-content-end">
        <i
          class="fas fa-chevron-right right-arrow"
          @click="scrollBar('right')"
        ></i>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ['categories'],
  data() {
    return {
      artists: [],
      favouriteSongs: [],
    };
  },
  methods: {
    sendArtistIdFetch(id) {
      this.$emit('id', id);
    },
    handleWheel(event, element) {
      const scrollBarContainer = document.querySelector(element);
      const scrollLeft = scrollBarContainer.scrollLeft;
      if (event.deltaY < 0) {
        scrollBarContainer.scrollLeft -= 210;
        const result = scrollBarContainer.scrollLeft;
      } else if (event.deltaY > 0) {
        scrollBarContainer.scrollLeft += 210;
        const result = scrollBarContainer.scrollLeft;
      }
    },
    scrollBar(type) {
      const scrollBarContainer = document.querySelector('#artists');
      const scrollLeft = scrollBarContainer.scrollLeft;
      const result = type === 'right'
        ? (scrollBarContainer.scrollLeft += 210)
        : (scrollBarContainer.scrollLeft -= 210);
    },
    setFavouriteSongs() {
      if (localStorage.getItem('favouriteSongs')) {
        this.favouriteSongs = JSON.parse(
          localStorage.getItem('favouriteSongs'),
        );
      }
      for (let i = 0; i < this.artists.length; i += 1) {
        for (let n = 0; n < this.artists[i].songs.length; n += 1) {
          this.favouriteSongs.map((songIndex) => {
            if (songIndex === this.artists[i].songs[n].id) {
              this.artists[i].songs[n].isFavourite = true;
            }
            return true;
          });
        }
      }
    },
    /**
     *GET api/artists
     * fetch artists
     */
    async fetchData() {
      try {
        const artistsRespond = await axios.get('/artists/');
        this.artists = artistsRespond.data.data;
        this.setFavouriteSongs();
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    if (!this.categories) {
      this.fetchData();
    }
  },
};
</script>

<style scoped>
.mobile-view-right-arrow,
.mobile-view-left-arrow,
.mobile-view-left-arrow i,
.mobile-view-right-arrow i {
  display: none;
}
#artists {
  overflow-x: scroll;
  height: auto;
  -ms-overflow-style: none; /* Internet Explorer 10+ */
  scrollbar-width: none; /* Firefox */
}
#artists::-webkit-scrollbar {
  display: none; /* Safari and Chrome */
}
.slider-divs {
  flex-shrink: 0;
  width: 170px;
  height: auto;
  cursor: pointer;
  position: relative;
}
.slider-divs img {
  width: 170px;
  height: 170px;
  border-radius: 10px;
  object-fit: cover;
}
.overlay {
  width: 170px;
  height: 170px;
  border-radius: 10px;
  background: rgba(0, 0, 0, 0.5);
  position: absolute;
  top: 0;
}

.overlay:hover {
  background: transparent;
}
.slider-divs h6:hover {
  color: var(--pretty-color);
}
.left-click,
.right-click {
  width: 50px;
  height: 50px;
}
.left-arrow,
.right-arrow {
  cursor: pointer;
  font-size: 25px;
}
.left-arrow:hover,
.right-arrow:hover {
  color: red;
}
/* Small devices (landscape phones, less than 768px) */
@media (max-width: 767.98px) {
  .slider-divs {
    flex-shrink: 0;
    width: 110px;
    height: auto;
  }
  .slider-divs img,
  .overlay {
    width: 110px;
    height: 110px;
  }
  .left-click,
  .right-click,
  .right-arrow,
  .left-arrow {
    display: none;
  }
  .mobile-view-right-arrow,
  .mobile-view-left-arrow {
    border-radius: 5px;
    background: #7fad39;
    color: white;
    width: 28px;
    height: 28px;
    display: block;
    cursor: pointer;
  }
  .mobile-view-right-arrow:active,
  .mobile-view-left-arrow:active {
    background: transparent;
    border: 1px solid white;
    background: black;
  }
  .mobile-view-left-arrow i,
  .mobile-view-right-arrow i {
    display: block;
  }
}
</style>
