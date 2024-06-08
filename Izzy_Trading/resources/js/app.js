import './bootstrap';
import 'bootstrap';
import '@popperjs/core';

import {createApp} from 'vue';
import cars_and_parts from "@/components/cars_and_parts.vue";

const app = createApp({

});



app.component('cars_and_parts', cars_and_parts);

app.mount('#app');


