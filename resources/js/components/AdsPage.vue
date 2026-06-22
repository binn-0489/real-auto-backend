<template>
    <div class="ads-layout">

        <!-- LEFT FILTERS -->
        <aside class="filters">
            <h3>Фильтры</h3>

            <input v-model="filters.brand" placeholder="Марка" class="form-control mb-2" />
            <input v-model="filters.model" placeholder="Модель" class="form-control mb-2" />

            <input v-model="filters.year_from" placeholder="Год от" class="form-control mb-2" />
            <input v-model="filters.year_to" placeholder="Год до" class="form-control mb-2" />

            <input v-model="filters.price_from" placeholder="Цена от" class="form-control mb-2" />
            <input v-model="filters.price_to" placeholder="Цена до" class="form-control mb-2" />

            <input v-model="filters.mileage_to" placeholder="Пробег до" class="form-control mb-2" />

            <button @click="loadAds" class="btn btn-primary w-100">
                Применить
            </button>
        </aside>

        <!-- CENTER ADS -->
        <main class="ads">

            <div v-if="loading">Загрузка...</div>
            <p>Количество объявлений: {{ ads.length }}</p>
            <div v-for="ad in ads" :key="ad.id" class="ad-card">

                <!-- IMAGES -->
                <div class="ad-images">

                    <!-- main image -->
                    <img
                        v-if="ad.images?.length"
                        class="main-img"
                        :src="'/storage/' + ad.images[0].path"
                    />

                    <!-- small images -->
                    <div class="thumbs">
                        <img
                            v-for="img in ad.images?.slice(1, 6)"
                            :key="img.id"
                            :src="'/storage/' + img.path"
                        />
                    </div>

                </div>

                <!-- INFO -->
                <div class="ad-info">

                    <h2>
                        {{ ad.brand.title }} {{ ad.model }} {{ ad.year }}
                    </h2>

                    <p class="small">
                        {{ ad.mileage }} км • {{ ad.engine_volume }} л • {{ ad.transmission }}
                    </p>

                    <h3 class="price">
                        {{ ad.price }} €
                    </h3>

                </div>

            </div>

        </main>

    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const ads = ref([])
const loading = ref(true)

const filters = ref({
    brand: '',
    model: '',
    year_from: '',
    year_to: '',
    price_from: '',
    price_to: '',
    mileage_to: ''
})

async function loadAds() {
    loading.value = true

    const query = new URLSearchParams(filters.value).toString()

    const res = await fetch('/api/ads?' + query)
    ads.value = await res.json()

    loading.value = false
}

onMounted(loadAds)
</script>

<style scoped>
.ads-layout {
    display: flex;
    gap: 20px;
}

/* FILTERS */
.filters {
    width: 250px;
}

/* ADS LIST */
.ads {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* CARD */
.ad-card {
    display: flex;
    gap: 20px;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 10px;
}

/* IMAGES */
.ad-images {
    width: 320px;
}

.main-img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 8px;
}

.thumbs {
    display: flex;
    gap: 5px;
    margin-top: 5px;
}

.thumbs img {
    width: 60px;
    height: 45px;
    object-fit: cover;
    border-radius: 5px;
}

/* INFO */
.ad-info {
    flex: 1;
}

.price {
    font-size: 24px;
    color: green;
}
</style>