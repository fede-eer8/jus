/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('select-categoria-materia', require('./components/CategoriaMateria.vue'));
Vue.component('add-human-actor', require('./components/humanActors/addHumanActor.vue'));
Vue.component('edit-human-actor', require('./components/humanActors/editHumanActor.vue'));
Vue.component('add-ah-button', require('./components/humanActors/modal-button-add-HA.vue'));
Vue.component('edit-ah-button', require('./components/humanActors/modal-button-edit-HA.vue'));
Vue.component('list-human-actor', require('./components/humanActors/listHumanActor.vue'));
Vue.component('view-human-actor', require('./components/humanActors/viewHumanActor.vue'));
Vue.component('list2-human-actor', require('./components/humanActors/listHumanActor2.vue'));

const app = new Vue({
    el: '#app'
});