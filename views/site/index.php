<?php

use yii\helpers\Url;

/**
 * @var $this \yii\web\View
 * @var $post \app\modules\admin\modules\content\models\Post
 * @var $postCategory \app\modules\admin\modules\content\models\PostCategory
 */

$this->title = "Main Page";

$facker = \Faker\Factory::create('en');

$mainPost = null;
if (isset($posts[0])) {
    $mainPost = $posts[0];
    unset($posts[0]);
}
?>
<div class="row">
    <div class="col-md-9">
        <div class="row">

            <?php if ($mainPost): ?>
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <!--                            <span class="ribbon-three ribbon-three-success"><span>Featured</span></span>-->

                                <img class="rounded-start img-fluid h-100 object-fit-cover"
                                     src="<?= $mainPost->image ?>" alt="Card image">
                            </div>
                            <div class="col-md-8">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <?= $mainPost->title ?>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text mb-2">
                                        <?= $mainPost->sub_text ?>
                                    </p>
                                    <p class="card-text">
                                        <a href="<?= Url::to(['post/view', 'id' => $mainPost->id]) ?>"
                                           class="link-success float-end">
                                            <?= translate("Read More") ?>
                                            <i class="ri-arrow-right-s-line align-middle ms-1 lh-1"></i>
                                        </a>
                                        <small class="text-muted">
                                            Last updated 3 mins ago
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card -->
                </div>
            <?php endif; ?>
            <?php foreach ($posts as $i => $post):
                ?>
                <div class="col-sm-6 col-xl-4 pb-3">
                    <div class="card h-100">
                        <!--                        <span class="ribbon-three ribbon-three-info"><span>Featured</span></span>-->
                        <img class="card-img-top img-fluid" src="<?= $post->image ?>" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title mb-2">
                                <?= $post->title ?>
                            </h4>
                            <p class="card-text mb-0">
                                <?= $post->sub_text ?>
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="<?= Url::to(['post/view', 'id' => $post->id]) ?>" class="link-success float-end">
                                <?= translate("Read More") ?>
                                <i class="ri-arrow-right-s-line align-middle ms-1 lh-1"></i>
                            </a>
                            <p class="text-muted mb-0">1 days Ago</p>
                        </div>
                    </div><!-- end card -->
                </div>
            <?php endforeach; ?>

        </div>
    </div>
    <?php
    echo $this->render('/site/_right_sidebar', [
        'categories' => $categories,
        'favoritePosts' => $favoritePosts
    ]);
    ?>
</div>