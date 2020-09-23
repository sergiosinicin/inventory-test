
let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forget.vue').default;
let logout = require('./components/auth/logout.vue').default;

let home = require('./components/home.vue').default;

// Employee Component
let store_employee = require('./components/employee/create.vue').default;
let employee = require('./components/employee/index.vue').default;
let edit_employee = require('./components/employee/edit.vue').default;

// Supplier Component
let store_supplier = require('./components/supplier/create.vue').default;
let supplier = require('./components/supplier/index.vue').default;
let edit_supplier = require('./components/supplier/edit.vue').default;

// Category Component
let store_category = require('./components/category/create.vue').default;
let category = require('./components/category/index.vue').default;
let edit_category = require('./components/category/edit.vue').default;


export const routes = [
    { path: '/', component: login, name:'/'},
    { path: '/register', component: register, name:'register'},
    { path: '/forget', component: forget, name:'forget'},
    { path: '/logout', component: logout, name:'logout'},
    { path: '/home', component: home, name:'home'},

    // Employee Routes
    { path: '/store-employee', component: store_employee, name:'store-employee'},
    { path: '/employee', component: employee, name:'employee'},
    { path: '/edit-employee/:id', component: edit_employee, name:'edit-employee'},

    // Supplier Routes
    { path: '/store-supplier', component: store_supplier, name:'store-supplier'},
    { path: '/supplier', component: supplier, name:'supplier'},
    { path: '/edit-supplier/:id', component: edit_supplier, name:'edit-supplier'},

    // Supplier Routes
    { path: '/store-category', component: store_category, name:'store-category'},
    { path: '/category', component: category, name:'category'},
    { path: '/edit-category/:id', component: edit_category, name:'edit-category'},
];
