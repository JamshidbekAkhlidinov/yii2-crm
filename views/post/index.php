<?php
/*
 *   Jamshidbek Akhlidinov
 *   5 - 3 2025 15:14:7
 *   https://ustadev.uz
 *   https://github.com/JamshidbekAkhlidinov
 */


$this->title = "Main Page";

$facker = \Faker\Factory::create('en');

/**
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $categories
 */

?>
<div class="row">
    <div class="col-md-9">

        <?php
        echo \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_item',
            'layout' => "<div class='pb-2'>{summary}</div>\n{items}\n{pager}",
            'options' => [
                'tag' => 'div',
                'class' => 'row',
            ],
            'itemOptions' => [
                'tag' => null,
                'class' => null,
            ]
        ]);
        ?>

    </div>
    <?php
    echo $this->render('/site/_right_sidebar', [
        'categories' => $categories,
        'favoritePosts' => $favoritePosts
    ]);
    ?>

</div>