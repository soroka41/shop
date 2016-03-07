<?php

/**
 * Контроллер для управления заказами
 */
class AdminOrderController extends AdminBase {

    /**
     * Главная, отображает все заказы пользователей
     *
     * @return bool
     */
    public function actionIndex (){

        //проверка доступа
        self::checkAdmin();

        $orders = Order::getOrdersList();

        require_once(ROOT . '/views/admin_order/index.php');

        return true;
    }

    /**
     * Просмотр конкретного заказа
     *
     * @param $id заказа
     * @return bool
     */
    public function actionView ($id){

        //проверка доступа
        self::checkAdmin();

        //Получаем заказ по id
        $orders = Order::getOrderById($id);

        //Преобразуем JSON  строку продуктов и их кол-ва в массив
        $productQuantity = json_decode($orders['products'], true);

        //Выбираем ключи заказанных товаров
        $productIds = array_keys($productQuantity);

        //Получаем список товаров по выбранным id
        $products = Product::getProductsByIds($productIds);

        require_once(ROOT . '/views/admin_order/view.php');

        return true;
    }

    /**
     * Изменение заказа
     *
     * @param $id
     * @return bool
     */
    public function actionEdit ($id){

        //проверка доступа
        self::checkAdmin();

        //Получаем заказ по id
        $order = Order::getOrderById($id);

        //Если форма отправлена, принимаем данные и обрабатываем
        if(isset($_POST) and !empty($_POST)){
            $userName = trim(strip_tags($_POST['name']));
            $userPhone = trim(strip_tags($_POST['phone']));
            $userComment = trim(strip_tags($_POST['comment']));
            $status = trim(strip_tags($_POST['status']));

            //Записываем изменения
            Order::updateOrder($id, $userName, $userPhone, $userComment, $status);

            //Перенаправляем на страницу просмотра данного заказа
            header("Location: /admin/orders/view/$id");
        }

        require_once(ROOT . '/views/admin_order/edit.php');

        return true;
    }

    /**
     * Удаление заказа
     *
     * @param $id
     * @return bool
     */
    public function actionDelete ($id) {

        //проверка доступа
        self::checkAdmin();

        //Проверяем форму
        if (isset($_POST['submit'])) {
            //Если отправлена, то удаляем нужный товар
            Order::deleteOrderById($id);
            //и перенаправляем на страницу заказов
            header('Location: /admin/orders');
        }

        require_once(ROOT . '/views/admin_order/delete.php');

        return true;
    }
}