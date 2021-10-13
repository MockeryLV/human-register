<?php

require_once 'vendor/autoload.php';
require_once 'app/core/Loader.php';
require_once 'app/Models/Human.php';

$loader = new Loader('db.csv');


$humans = $loader->getHumans();


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HUMAN</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>

    <form action="/" method="get">
        <label > ID</label>
        <input type="text" name="id">
        <input type="submit">
    </form>
    <table>
        <th>
            Name
        </th>
        <th>
            Surname
        </th>
        <th>
            Id
        </th>
        <th>
            Info
        </th>

        <?php foreach ($humans as $key => $human):?>
        <tr>
            <td>
                <?= $human->getName()?>
            </td>
            <td>
                <?= $human->getSurname()?>
            </td>
            <td>
                <?= $human->getId()?>
            </td>
            <td>
                <?= $human->getInfo()?>
            </td>
        </tr>


        <?php endforeach;?>

    </table>

    <div align="center">
        <form action="/" method="POST">
            <label>name</label>
            <input name="name" type="text">
            <br>
            <label>surname</label>
            <input name="surname" type="text">
            <br>
            <label>id</label>
            <input name="id" type="text">
            <br>
            <label>info</label>
            <input name="info" type="text">
            <br>
            <input type="submit">
        </form>
    </div>


</body>
</html>

<?php


if($_GET['id']){
    $human = $loader->searchById($_GET['id']);

    $key = array_search($human, $humans);

    if(is_string($human)){
        echo 'Not found';
    }else{
        echo 'Name: ' . $human->getName() . '<br>';
        echo 'Surname: ' . $human->getSurname() . '<br>';
        echo 'Id: ' . $human->getId() . '<br>';
        echo 'Info: ' . $human->getInfo() . '<br>';
        echo '
                        <form action="/" method="POST">

                    <input hidden value="'. $key .'" name="key">
                    <input type="submit" value="Delete">
                </form>
        ';
    }


}


if($_POST['name'] && $_POST['surname'] && $_POST['id'] && $_POST['info']){
    $loader->addHuman($_POST['name'],$_POST['surname'], $_POST['id'], $_POST['info'] );
    $_POST['name'] = false;
    $_POST['surname'] = false;
    $_POST['id'] = false;
     $_POST['info'] = false;
    echo "<meta http-equiv='refresh' content='0'>";
}

if(isset($_POST['key'])){

    $loader->Delete($_POST['key']);

    $_POST['key'] = false;
    echo "<meta http-equiv='refresh' content='0'>";
}




