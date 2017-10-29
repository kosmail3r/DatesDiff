<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 10/28/17
 * Time: 1:27 AM
 */
spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});

if (isset($_POST)) {
    $post = $_POST;
    if (!empty($post['startDate']) && !empty($post['endDate'])) {
        $validator = new DateValidator($post['startDate'], $post['endDate']);
        $validateResult = $validator->validate();
        if (isset($validateResult['success']) && $validateResult['success']) {
            $base = new DateChecker($validateResult);
            $result = $base->getDiff();
            var_dump($result);
        } else {
            $msg = implode('<br/>', $validateResult['errors']);
        }
    } else {
        new Error('Все поля должны \'быть заполнены!', 691);
    }
}
if (!empty($msg)) echo $msg;
?>
<form action="index.php" method="post">
    <input type="text" name="startDate" placeholder="Start date YYYY-MM-DD">
    <input type="text" name="endDate" placeholder="End date YYYY-MM-DD">
    <input type="submit" value="submit">
</form>
