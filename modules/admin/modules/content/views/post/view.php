<?php
/*
 *   Jamshidbek Akhlidinov
 *   25 - 12 2023 11:40:02
 *   https://github.com/JamshidbekAkhlidinov
*/

use app\modules\admin\enums\StatusEnum;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\admin\modules\content\models\Post $model */

$this->title = translate("Post View");
params()['breadcrumbs'][] = ['label' => translate("Posts"), 'url' => ['/admin/content/post']];
params()['breadcrumbs'][] = $this->title;


$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => translate('Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container-fluid">
    <div class="post-view card ribbon-box border shadow-none">
        <div class="card-header d-flex justify-content-between" style="padding-top: 35px">
            <div class="ribbon ribbon-primary round-shape"><?= translate('Title') ?></div>
            <h1><?= Html::encode($this->title) ?></h1>
            <p>
                <?= Html::a(translate('Update'),
                    ['update', 'id' => $model->id],
                    ['class' => 'btn btn-primary m-1']
                ) ?>
                <?= Html::a(
                    translate('Delete'),
                    ['delete', 'id' => $model->id],
                    [
                        'class' => 'btn btn-danger m-1
                        ',
                        'data' => [
                            'confirm' => translate('Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]
                ) ?>
            </p>
        </div>
        <!--    <div class="card-header">-->
        <!--        --><?php //= DetailView::widget([
        //            'model' => $model,
        //            'attributes' => [
        //                'id',
        //                'title',
        //                [
        //                    'format' => 'raw',
        //                    'attribute' => 'image',
        //                    'value' => static function ($model) {
        //                        return Html::img($model->image, ['width' => '100px']);
        //                    },
        //                ],
        //                'sub_text',
        //                [
        //                    'format' => 'raw',
        //                    'attribute' => 'description',
        //                    'value' => function ($data) {
        //                        return str_replace("<img src=","<img width='600px' height='' src=",$data->description);
        //                    },
        //                ],
        //                [
        //                    'attribute' => 'status',
        //                    'format' => 'raw',
        //                    'value' => static function ($model) {
        //                        return Html::tag(
        //                            'span',
        //                            StatusEnum::ALL[$model->status] ?? "",
        //                            [
        //                                'class' => 'badge ' . StatusEnum::COLORS[$model->status] ?? ""
        //                            ]
        //                        );
        //                    }
        //                ],
        //                'view_count',
        //                'created_at',
        //                'updated_at',
        //                [
        //                    'format' => 'raw',
        //                    'attribute' => 'created_by',
        //                    'value' => static function ($model) {
        //                        if ($user = $model->createdBy) {
        //                            return $user->publicIdentity;
        //                        }
        //                    },
        //                ],
        //                [
        //                    'format' => 'raw',
        //                    'attribute' => 'updated_by',
        //                    'value' => static function ($model) {
        //                        if ($user = $model->updatedBy) {
        //                            return $user->publicIdentity;
        //                        }
        //                    },
        //                ],
        //            ],
        //        ]) ?>
        <!--    </div>-->
    </div>
</div>

<section>
    <!-- Start right Content here -->
    <!-- ============================================================== -->

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content text-muted">
                        <div class="tab-pane fade show active" id="project-overview" role="tabpanel">
                            <div class="row">
                                <div class="col-xl-9 col-lg-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-muted">
                                                <div class="card ribbon-box border shadow-none">
                                                    <div class="card-body" style="padding-top: 35px">
                                                        <div class="ribbon ribbon-primary round-shape"><?= translate('Sub title') ?></div>
                                                        <p><?= $model->sub_text ?></p>
                                                    </div>
                                                </div>
                                                <div class="card ribbon-box border shadow-none">
                                                    <div class="card-body" style="padding-top: 35px">
                                                        <div class="ribbon ribbon-primary round-shape"><?= translate('Description') ?></div>
                                                        <p><?= str_replace("<img src=", "<img width='100%' height='' src=", $model->description); ?></p>
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
                                                                <p class="mb-2 text-uppercase fw-medium"><?= translate('Update date') ?>
                                                                    :</p>
                                                                <h5 class="fs-15 mb-0"><?= $model->updated_at ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-sm-6">
                                                            <div>
                                                                <p class="mb-2 text-uppercase fw-medium"><?= translate('Status') ?></p>
                                                                <div><?= Html::tag(
                                                                        'span',
                                                                        StatusEnum::ALL[$model->status] ?? "",
                                                                        [
                                                                            'class' => 'badge  fs-12 ' . StatusEnum::COLORS[$model->status] ?? ""
                                                                        ]
                                                                    ); ?></div>
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
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->

                                    <!-- end card -->
                                </div>
                                <!-- ene col -->
                                <div class="col-xl-3 col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4"><?= translate('Categories') ?></h5>
                                            <ul style="display: flex;flex-wrap: wrap; padding-left: 0" class="fs-16">
                                                <?php $items = [] ?>
                                                <?php foreach ($model->postCategoryLinkers as $linker) { ?>
                                                    <li class="badge fw-medium bg-secondary-subtle text-secondary m-1"><?= $items[] = $linker->postCategory->name ?></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4"><?= translate('Taglar') ?></h5>
                                            <ul style="display: flex;flex-wrap: wrap; padding-left: 0" class="fs-16">
                                                <?php $items = [] ?>
                                                <?php foreach ($model->postTagLinkers as $linker) { ?>
                                                    <li class="badge fw-medium bg-secondary-subtle text-secondary m-1"><?= $items[] = $linker->tag->name ?></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end tab pane -->
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script>
                    © Velzon.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design & Develop by Themesbrand
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end main content-->
</section>
