<?php
/*
 *   Jamshidbek Akhlidinov
 *   5 - 3 2025 15:18:38
 *   https://ustadev.uz
 *   https://github.com/JamshidbekAkhlidinov
 */

/**
 * @var $categories
 * @var $favoritePosts
 */

use yii\helpers\Url;

?>

<div class="col-md-3">

    <div class="live-preview">
        <div class="list-group list-group-fill-success">
                <span class="list-group-item list-group-item-action active">
                    <i class="ri-download-2-fill align-middle me-2"></i>
                    <?= translate("Categories") ?>
                </span>
            <?php foreach ($categories as $postCategory): ?>
                <a href="<?= Url::to(['post/index', 'category_id' => $postCategory->id]) ?>"
                   class="list-group-item list-group-item-action <?= ($postCategory->id == get('category_id')) ? "active2" : "" ?>">
                    <i class="ri-shield-check-line align-middle me-2"></i>
                    <?= $postCategory->name ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">
                <?= translate("Most popular posts") ?>
            </h4>
            <div>
                <a href="<?= Url::to(['post/index']) ?>" type="button" class="btn btn-soft-primary btn-sm">
                    <?= translate("View all") ?>
                </a>
            </div>
        </div><!-- end card-header -->

        <div class="card-body">
            <?php foreach ($favoritePosts as $i => $post):
                ?>
                <div class="d-flex <?= ($i != 1) ? " mt-4" : "" ?>">
                    <div class="flex-shrink-0">
                        <img src="<?=$post->image?>" class="rounded img-fluid" style="height: 60px; width: 100px" alt="">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1 lh-base">
                            <a href="<?= Url::to(['post/view', 'id' => $post->id]) ?>" class="text-reset">
                                <?= $post->title ?>
                            </a>
                        </h6>
                        <p class="text-muted fs-12 mb-0">
                            Dec 03, 2021
                            <i class="mdi mdi-circle-medium align-middle mx-1"></i>
                            12:09 PM
                        </p>
                    </div>
                </div><!-- end -->
            <?php endforeach; ?>
        </div><!-- end card body -->
    </div>

<!--    <div class="card card-body">-->
<!--        <div>-->
<!--            --><?php //for ($i = 1; $i <= 4; $i++):
//                $text = "test";
//                ?>
<!--                <a href="--><?php //= Url::to(['post/view', 'id' => $i]) ?><!--" class="badge bg-success">-->
<!--                    --><?php //= $text ?>
<!--                </a>-->
<!--            --><?php //endfor; ?>
<!--        </div>-->
<!--    </div>-->

</div>
