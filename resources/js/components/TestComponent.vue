<template>
    <div>
        <h2>Vue работает!</h2>

        <button @click="count++">
            Нажато {{ count }} раз
        </button>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const count = ref(0);
</script>