import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';

import { createApp } from 'vue';

import TestComponent from './components/TestComponent.vue';
import AdsPage from './components/AdsPage.vue'


console.log('Vue app loaded');

const app = createApp({});

app.component('test-component', TestComponent);
app.component('ads-page', AdsPage);

app.mount('#app');