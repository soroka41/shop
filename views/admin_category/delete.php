<?php
include (ROOT . '/views/parts/header_admin.php');
?>

    <div class="container_admin_del">
        <h4>Удалить категорию #<?php echo $id; ?></h4>


        <p>Вы действительно хотите удалить эту категорию?</p>

        <form method="post">
            <input type="submit" name="submit" value="Удалить" />
        </form>
    </div>
    <div class="appendix"></div>

<?php
include (ROOT . '/views/parts/footer_admin.php');
?>