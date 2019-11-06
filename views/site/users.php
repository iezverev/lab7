<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Users';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <?php
            if ($a == null) {
                echo 'В базе нету пользователей!';
            }else{
                foreach ($a as $arr)
                {
                    echo "<a href=". Url::to(['site/changeuser', 'test' => $_GET['test'], 'Question' => $_GET['Question'], 'User' => $arr['id']])."> ".$arr['id'].". ". $arr['Name']. "</a> <br>";
                }}
            ?>
        </div>

    </div>
</div>
