<?php

use yii\bootstrap5\Html;

$facker = \Faker\Factory::create('en');
$text = $facker->text(rand(10000, 30000));

$this->title = translate("Post View");
params()['breadcrumbs'][] = ['label' => translate("Posts"), 'url' => ['post/index']];
params()['breadcrumbs'][] = $this->title;

/**
 * @var $model \app\modules\admin\modules\content\models\Post
 * @var $categories \app\modules\admin\modules\content\models\PostCategory
 */

?>
<div class="row">
    <div class="col-md-9">
        <div class="post-view card ribbon-box border shadow-none">
            <div class="card-header d-flex justify-content-between" style="padding-top: 35px">
                <h1><?= Html::encode($model->title) ?></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="tab-content text-muted">
                    <div class="tab-pane fade show active" id="project-overview" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-muted">
                                            <div class="card ribbon-box border shadow-none">
                                                <div class="card-body" style="padding-top: 35px">
                                                    <p><?= str_replace("<img src=", "<img width='100%' height='' src=", $model->description ?? ""); ?></p>
                                                </div>
                                            </div>

                                            <div class="pt-3 border-top border-top-dashed mt-4">
                                                <div class="row">

                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium"><?= translate('Create date') ?>
                                                                :</p>
                                                            <h5 class="fs-15 mb-0"><?= $model->created_at ?></h5>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium"><?= translate('Publish date') ?>
                                                                :</p>
                                                            <h5 class="fs-15 mb-0"><?= $model->publish_at ?></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php
    echo $this->render('/site/_right_sidebar', [
        'categories' => $categories,
        'favoritePosts' => $favoritePosts
    ]);
    ?>

</div>