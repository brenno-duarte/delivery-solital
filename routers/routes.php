<?php

use Solital\Core\Course\Course;

/**
 * Site
 */
Course::get('/', 'StoreController@home')->name('home');
Course::get('/product/{id}/{name}', 'StoreController@detailProduct')->name('product.detail');

/**
 * Profile
 */
Course::get('/profile-login', 'ProfileController@profileLogin')->name('profile.login');
Course::post('/profile-login-post', 'ProfileController@profileLoginPost')->name('profile.login.post');
Course::get('/profile', 'ProfileController@profile')->name('profile');
Course::post('/profile-post', 'ProfileController@profilePost')->name('profile.post');
Course::get('/profile-pass', 'ProfileController@profilePass')->name('profile.pass');
Course::post('/profile-pass-post', 'ProfileController@profilePassPost')->name('profile.pass.post');
Course::post('/profile-create-post', 'ProfileController@profileCreatePost')->name('profile.create.post');
Course::get('/profile-orders', 'ProfileController@profileOrders')->name('profile.orders');
Course::get('/profile-logout', 'ProfileController@profileLogout')->name('profile.logout');

/**
 * CEP & Shipping
 */
Course::get('/cep-search', 'CepController@searchCep')->name('cep.search');
Course::get('/cep-shipping', 'CepController@calculateShipping')->name('cep.shipping');
Course::post('/cep-address-post', 'CepController@addressCepPost')->name('cep.address.post');

/**
 * Cart & Checkout
 */
Course::get('/cart', 'CartController@cart')->name('cart');
Course::post('/add-cart', 'CartController@addCart')->name('add.cart');
Course::get('/increase-cart-product/{idProduct}/{qtd}', 'CartController@increase')->name('increase');
Course::get('/decrease-cart-product/{idProduct}/{qtd}', 'CartController@decrease')->name('decrease');
Course::get('/remove-cart-product/{idProduct}', 'CartController@remove')->name('remove');
Course::post('/checkout', 'CartController@checkout')->name('checkout');
Course::get('/checkout-finished', 'CartController@finished')->name('checkout.finished');
Course::post('/checkout-finished-post', 'CartController@finishedPost')->name('checkout.finished.post');
