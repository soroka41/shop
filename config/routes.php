<?php

return array(

    //оформление заказа
    'cart/checkout' => 'cart/checkout',
    //удаление товара из корзины
    'cart/delete/([0-9]+)' => 'cart/delete/$1',
    //добавление с помощью ajax
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1',
    //Добавление товара в корзину
    'cart/add/([0-9]+)' => 'cart/add/$1',

    'cart' => 'cart/index',

    //Регистрация
    'user/register' => 'user/register', //actionRegister в UserController

    //Вход
    'user/login' => 'user/login',

    //Выход
    'user/logout' => 'user/logout',

    //Личный кабинет
    'cabinet/orders' => 'cabinet/ordersList',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',

    //Товар
    'product/([0-9]+)' => 'product/view/$1', //actionView в ProductController

    //Категория товара
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', // actionCategory в CatalogController
    'category/([0-9]+)' => 'catalog/category/$1', //actionCategory в CatalogController

    //Каталог
    'catalog/page-([0-9]+)' => 'catalog/index/$1',
    'catalog' => 'catalog/index',

    //Админпанель
    'admin/orders/edit/([0-9]+)' => 'adminOrder/edit/$1',
    'admin/orders/view/([0-9]+)' => 'adminOrder/view/$1',
    'admin/orders/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'admin/orders' => 'adminOrder/index',

    'admin/category/edit/([0-9]+)' => 'adminCategory/edit/$1',
    'admin/category/add' => 'adminCategory/add',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',

    'admin/product/edit/([0-9]+)' => 'adminProduct/edit/$1',
    'admin/product/add' => 'adminProduct/add',
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'admin/product' => 'adminProduct/index',

    'admin' => 'admin/index',

    //Главаня страница
    'index.php' => 'index/index', //вызываем actionIndex в IndexController
    '' => 'index/index'  //вызываем actionIndex в IndexController
);