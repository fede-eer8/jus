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
Vue.component('add-ha-button', require('./components/humanActors/modal-button-add-HA.vue'));
Vue.component('edit-ah-button', require('./components/humanActors/modal-button-edit-HA.vue'));
Vue.component('list-human-actor', require('./components/humanActors/listHumanActor.vue'));
Vue.component('view-human-actor', require('./components/humanActors/viewHumanActor.vue'));
Vue.component('list2-human-actor', require('./components/humanActors/listHumanActor2.vue'));
Vue.component('add-ideal-actor', require('./components/idealActors/addIdealActor.vue'));
Vue.component('list-ideal-actor', require('./components/idealActors/listIdealActor.vue'));
Vue.component('add-human-defendant', require('./components/humanDefendants/addHumanDefendant.vue'));
Vue.component('list-human-defendant', require('./components/humanDefendants/listHumanDefendant.vue'));
Vue.component('add-ideal-defendant', require('./components/idealDefendants/addIdealDefendant.vue'));
Vue.component('list-ideal-defendant', require('./components/idealDefendants/listIdealDefendant.vue'));
Vue.component('add-document', require('./components/documents/addDocument.vue'));
Vue.component('list-document', require('./components/documents/listDocument.vue'));
Vue.component('view-document', require('./components/documents/viewDocument.vue'));
Vue.component('add-document-type', require('./components/configurations/documentTypes/addDocumentType.vue'));
Vue.component('list-document-type', require('./components/configurations/documentTypes/listDocumentType.vue'));

import JwPagination from 'jw-vue-pagination';
Vue.component('jw-pagination', JwPagination);

const app = new Vue({
    el: '#app'
});