<?php

/**
 * Контроллер для управления категориями
 */
class AdminCategoryController extends AdminBase{

    /**
     * Главная страница управления категориями
     *
     * @return bool
     */
    public function actionIndex (){

        //проверка доступа
        self::checkAdmin();

        $categories = Category::getCategoryListAdmin();

        require_once(ROOT . '/views/admin_category/index.php');

        return true;
    }

    /**
     * Удаление категории
     *
     * @param $id категории
     * @return bool
     */
    public function actionDelete ($id) {

        //проверка доступа
        self::checkAdmin();

        //Проверяем форму
        if (isset($_POST['submit'])) {
            //Если отправлена, то удаляем нужный товар
            Category::deleteCategoryById($id);
            //и перенаправляем на страницу товаров
            header('Location: /admin/category');
        }

        require_once(ROOT . '/views/admin_category/delete.php');

        return true;
    }

    /**
     * Добавление категории
     *
     * @return bool
     */
    public function actionAdd () {

        //проверка доступа
        self::checkAdmin();

        //Принимаем данные из формы
        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['sort_order'] = trim(strip_tags($_POST['sort_order']));
            $options['status'] = trim(strip_tags($_POST['status']));

            Category::addCategory($options);

            header('Location: /admin/category');
        }


        require_once(ROOT . '/views/admin_category/add.php');

        return true;
    }

    /**
     * Редактирование категории
     *
     * @param $id категории
     * @return bool
     */
    public function actionEdit ($id) {

        //проверка доступа
        self::checkAdmin();

        // Получаем список категорий для выпадающего списка
        $category = Category::getCategoryById($id);

        //Принимаем данные из формы
        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['sort_order'] = trim(strip_tags($_POST['sort_order']));
            $options['status'] = trim(strip_tags($_POST['status']));

            Category::editCategory($id, $options);

            header('Location: /admin/category');
        }

        require_once(ROOT . '/views/admin_category/edit.php');

        return true;
    }
}