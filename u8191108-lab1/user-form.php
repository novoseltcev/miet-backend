<?php
require '../vendor/autoload.php';
require 'user.php';

use Symfony\Component\Validator\ValidatorBuilder;

function getUserValidator() {
    $builder = new ValidatorBuilder();
    $builder->addMethodMapping('loadValidatorMetadata');
    return $builder->getValidator();
}

if ($_POST != null) {
    $user = new User(intval($_POST['id']), $_POST['name'] . '', $_POST['email'] . '', $_POST['password'] . '');
    $_POST = null;
    echo 'Handling ' . $user;
    $validator = getUserValidator();
    $errors = $validator->validate($user);

    if (count($errors) == 0) {
        echo '<p style="color: #00ff00;">User valid</p>';
    } else {
        echo '<p style="color: #ff0000;">User invalid</p>';
        echo '<ul style="color:#ff0000;">';
        foreach ($errors as $error) {
            echo '<li>' . $error->getPropertyPath() . ' - ' . $error->getMessage() . '</li>';
        }
        echo '</ul>';
    }
}
?>

<html lang="en">
<head>
    <title>PHP OOP</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<div class="new-user" style="margin: 100px auto auto auto;">
    <h2>Create a new user</h2>
    <form action="" method="POST" style="display: block;">
        <p>Id</p>
        <input type="text" name="id">
        <p>Name</p>
        <input type="text" name="name">
        <p>Email</p>
        <input type="text" name="email">
        <p>Password</p>
        <input type="password" name="password">
        <input type="submit" value="submit" name="submit">
    </form>
</div>

</body>
</html>



<?php

?>