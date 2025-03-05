<?php
/*
 *   Jamshidbek Akhlidinov
 *   5 - 3 2025 15:50:20
 *   https://ustadev.uz
 *   https://github.com/JamshidbekAkhlidinov
 */

use yii\helpers\Url;

/**
 * @var $model \app\modules\admin\modules\content\models\Post
 */
?>

<div class="col-sm-6 col-xl-4 pb-3">
    <div class="card h-100">
        <!--                        <span class="ribbon-three ribbon-three-info"><span>Featured</span></span>-->
        <img class="card-img-top img-fluid" src="<?= $model->image ?>" alt="Card image cap">
        <div class="card-body">
            <h4 class="card-title mb-2">
                <?= $model->title ?>
            </h4>
            <p class="card-text mb-0">
                <?= $model->sub_text ?>
            </p>
        </div>
        <div class="card-footer">
            <a href="<?= Url::to(['post/view', 'id' => $model->id]) ?>" class="link-success float-end">
                <?= translate("Read More") ?>
                <i class="ri-arrow-right-s-line align-middle ms-1 lh-1"></i>
            </a>
            <p class="text-muted mb-0">1 days Ago</p>
        </div>
    </div><!-- end card -->
</div>
