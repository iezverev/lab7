<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <?php
            if ($a == null) {
                echo 'В базе нету тестов!';
            }else{
                foreach ($a as $arr)
                {
                echo "<a href=". Url::to(['site/test', 'test' => $arr['id'], 'Question' => '0'])."> ".$arr['id'].". ". $arr['Name']. " - " . $arr['Description']. "</a> <br>";
                }}
            ?>
        </div>

    </div>
</div>
