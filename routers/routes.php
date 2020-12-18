<?php

use Solital\Core\Course\Course;

/**
 * Site
 */
Course::get('/', 'StoreController@home')->name('home');
Course::get('/product/{id}/{name}', 'StoreController@detailProduct')->name('product.detail');

/**
 * Cart & Checkout
 */
Course::get('/cart', 'CartController@cart')->name('cart');
Course::post('/add-cart', 'CartController@addCart')->name('add.cart');
Course::get('/increase-cart-product/{id}/{qtd}', 'CartController@increase')->name('increase');
Course::get('/decrease-cart-product/{id}/{qtd}', 'CartController@decrease')->name('decrease');
Course::get('/remove-cart-product/{id}', 'CartController@remove')->name('remove');
Course::post('/checkout', 'CartController@checkout')->name('checkout');
Course::get('/checkout-finished', 'CartController@finished')->name('checkout.finished');
Course::post('/checkout-finished-post', 'CartController@finishedPost')->name('checkout.finished.post');