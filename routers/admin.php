<?php

use Solital\Core\Course\Course;

Course::partialGroup('/admin', function() {

    /** 
     * Login Routers 
     */
    Course::get('/login', 'Auth\LoginController@login')->name('login');
    Course::post('/verify-login', 'Auth\LoginController@verify')->name('verifyLogin');
    Course::get('/logoff', 'Auth\LoginController@exit')->name('exit');
    Course::get('/dashboard', 'Auth\LoginController@dashboard')->name('dashboard');

    /** 
     * Forgot Routers 
     */
    Course::get('/forgot', 'Auth\ForgotController@forgot')->name('forgot');
    Course::post('/forgotPost', 'Auth\ForgotController@forgotPost')->name('forgotPost');
    Course::get('/change/{hash}', 'Auth\ForgotController@change')->name('change');
    Course::post('/changePost/{hash}', 'Auth\ForgotController@changePost')->name('changePost');

    /**
     * Category
     */
    Course::get('/category', 'CategoryController@category')->name('category');
    Course::get('/new-category', 'CategoryController@newCategory')->name('newCategory');
    Course::post('/new-category-post', 'CategoryController@newCategoryPost')->name('newCategoryPost');
    Course::get('/edit-category/{id}', 'CategoryController@editCategory')->name('editCategory');
    Course::post('/edit-category-post/{id}', 'CategoryController@editCategoryPost')->name('editCategoryPost');
    Course::get('/delete-category/{id}', 'CategoryController@deleteCategory')->name('deleteCategory');

    /**
     * Product
     */
    Course::get('/product', 'ProductController@product')->name('product');
    Course::get('/new-product', 'ProductController@newProduct')->name('new.product');
    Course::post('/new-product-post', 'ProductController@newProductPost')->name('new.product.post');
    Course::get('/edit-product/{id}', 'ProductController@editProduct')->name('edit.product');
    Course::post('/edit-product-post/{id}', 'ProductController@editProductPost')->name('edit.product.post');
    Course::get('/delete-product/{id}', 'ProductController@deleteProduct')->name('delete.product');
    Course::get('/delete-photo/{id}/{idProduct}', 'ProductController@deletePhoto')->name('delete.photo');

    /**
     * Order
     */
    Course::get('/order', 'OrderController@order')->name('order');
    Course::get('/order-details/{id}', 'OrderController@orderDetails')->name('order.details');
    Course::get('/edit-status/{id}', 'OrderController@editStatus')->name('edit.status');
    Course::post('/edit-status-post/{id}', 'OrderController@editStatusPost')->name('edit.status.post');
    Course::get('/send-order', 'OrderController@sendOrder')->name('send.order');
    Course::get('/delete-order/{id}', 'OrderController@deleteOrder')->name('delete.order');
    Course::get('/delivered-order/{id}', 'OrderController@deliveredOrder')->name('delivered.order');

    /**
     * Report
     */
    Course::get('/report', 'ReportController@report')->name('report');
    Course::get('/report-custom', 'ReportController@reportCustom')->name('report.custom');

    /**
     * Setting
     */
    Course::get('/informations', 'SettingController@informations')->name('informations');
    Course::post('/informations-post/{id}', 'SettingController@informationsPost')->name('informations.post');
    Course::get('/delete-logo/{id}', 'SettingController@deleteLogo')->name('delete.logo');
    Course::get('/payments', 'SettingController@payments')->name('payments');
    Course::post('/payments-post/{id}', 'SettingController@paymentsPost')->name('payments.post');
});