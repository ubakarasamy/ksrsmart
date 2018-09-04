
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
Vue.component('student-index', require('./components/Student/Student.vue'));
Vue.component('student-create', require('./components/Student/StudentCreate.vue'));

Vue.component('schedule-index', require('./components/Schedule/Schedule.vue'));
Vue.component('schedule-assign', require('./components/Schedule/ScheduleAssign.vue'));
Vue.component('schedule-view', require('./components/Schedule/ScheduleView.vue'));


Vue.component('student-attendance-create', require('./components/StudentAttendance/StudentAttendanceCreate.vue'));
Vue.component('student-attendance-viewbyday', require('./components/StudentAttendance/StudentAttendanceViewByDay.vue'));
Vue.component('student-attendance-viewbymonth', require('./components/StudentAttendance/StudentAttendanceViewByMonth.vue'));
Vue.component('student-attendance-viewbyoverall', require('./components/StudentAttendance/StudentAttendanceViewByOverall.vue'));

const app = new Vue({
    el: '#app'
});
