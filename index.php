<?php ?>
<?php require_once "form.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form action="/" method="post" class="flex-block">
    <span>Имя</span>
    <input type="text" name="firstName">
    <span>Фамилия</span>
    <input type="text" name="lastName">
    <span>логин</span>
    <input type="text" name="login">
    <span>Пароль</span>
    <input type="text" name="password">

    <button type="submit">Отправить</button>
</form>
<?php $validate = valid($_POST); ?>
<?php  $errorMessage = 'Вы допустили ошибку'; ?>
<?php $positiveMessage = 'Вы успешно прошли валидацию!Поздравляем!';?>

<?php if (!empty($validate['error']) && $validate['error']):?>
    <p class="text"><?= $errorMessage ?></p>
    <?php foreach ($validate['messages'] as $message):?>
        <p class="item-err"><?= $message ?></p>
<?php endforeach;?>
<?php endif;?>



<?php if (!empty($validate['success']) && $validate['success']):?>
    <p class="text"><?= $positiveMessage ?></p>
    <?php foreach ($validate['messages'] as $message):?>
        <p class="item"><?= $message ?></p>
    <?php endforeach;?>
<?php endif;?>

</body>
</html>
