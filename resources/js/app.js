import './bootstrap';
Vue.component('custom-card', require('./components/CustomCard.vue').default);
Nova.booting((Vue, router, store) => {
  // ...
        
  Vue.component('design-images', require('./components/DesignImages.vue').default);
});

