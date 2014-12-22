<?php

use backend\themes\admin\widgets\Box;

$this->title = Yii::t('backend', 'Мет. и ср. защиты комп. информации');
$this->params['subtitle'] = Yii::t('backend', 'Контрольная работа');
$this->params['breadcrumbs'] = [
    $this->title
];
?>

<div class="row">
    <div class="col-xs-12">
        <?php Box::begin(
            [
                'title' => $this->params['subtitle'],
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
                'grid' => 'articles-grid'
            ]
        ); ?>


        <?php //print_r($cipherText) ?>

        <?php //print_r($cipherText1) ?>
        <?php

            $messagePart = "Большинство моих профессиональных Java проектов за последнее десятилетие были основаны на Sring или JEE. Обе платформы развиваются достаточно уверенно, однако все ещё страдают от различных проблем.";
            echo '<pre>"';print_r($messagePart); echo '"</pre>';

            $key = '111111111111111111111111';
            echo '<pre>"';print_r($key); echo '"</pre>';

            $ctx = new \backend\helpers\AES\Context\ECB($key);
            $ctr = new \backend\helpers\AES\Mode\ECB();

            $countxx = strlen(utf8_decode($messagePart));
            echo '<pre>"'; print($countxx); echo '"</pre>';

            $i = $countxx % 8;
            echo '<pre>"'; print($i); echo '"</pre>';

            if($i > 0)
                $i = 8 - $i;

            echo '<pre>"'; print($i); echo '"</pre>';

            $a = $i + $countxx;
            $messagePart = str_pad($messagePart, strlen($messagePart)+$i);
            echo '<pre>"'; print($messagePart); echo '"</pre>';
            //////////////////////



            ////////////////////////

            $cipherText = $ctr->encrypt($ctx, $messagePart);
            echo '<pre>';
            print_r('<<'.$cipherText.'>>>');
            echo '</pre>';

            $cipherText1 = $ctr->decrypt($ctx, $cipherText);
            echo '<pre>"'; print($cipherText1); echo '"</pre>';

        ?>


        <?php Box::end(); ?>
    </div>
</div>