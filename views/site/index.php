<?php

use yii\helpers\Url;

$facker = \Faker\Factory::create('en');
?>
<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <span class="ribbon-three ribbon-three-success"><span>Featured</span></span>

                            <img class="rounded-start img-fluid h-100 object-fit-cover"
                                 src="/images/small/img-12.jpg" alt="Card image">
                        </div>
                        <div class="col-md-8">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Give your text a good structure</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text mb-2">For that very reason, I went on a quest and spoke to many
                                    different professional graphic designers and asked them what graphic design tips
                                    they live.</p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        Last updated 3 mins ago
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div><!-- end card -->
            </div>

            <?php for ($i = 1; $i <= 6; $i++):
                $text = $facker->text(rand(10, 300));
                ?>
                <div class="col-sm-6 col-xl-4 pb-3">
                    <div class="card h-100">
                        <span class="ribbon-three ribbon-three-info"><span>Featured</span></span>
                        <img class="card-img-top img-fluid" src="/images/small/img-2.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title mb-2">
                                How apps is changing the IT world
                            </h4>
                            <p class="card-text mb-0">
                                <?= $text ?>
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="<?= Url::to(['post/view', 'id' => $i]) ?>" class="link-success float-end">
                                Read More
                                <i class="ri-arrow-right-s-line align-middle ms-1 lh-1"></i>
                            </a>
                            <p class="text-muted mb-0">1 days Ago</p>
                        </div>
                    </div><!-- end card -->
                </div>
            <?php endfor; ?>

        </div>
    </div>
    <div class="col-md-3">

        <div class="live-preview">
            <div class="list-group list-group-fill-success">
                <span class="list-group-item list-group-item-action active">
                    <i class="ri-download-2-fill align-middle me-2"></i>
                    Kategoriyalar
                </span>
                <?php for ($i = 1; $i <= 4; $i++): ?>
                    <a href="<?= Url::to(['post/view', 'category' => $i]) ?>" class="list-group-item list-group-item-action <?= ($i == 3) ? "active2" : "" ?>">
                        <i class="ri-shield-check-line align-middle me-2"></i>
                        Security Access
                    </a>
                <?php endfor; ?>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">
                    Eng mashhur postlar
                </h4>
                <div>
                    <button type="button" class="btn btn-soft-primary btn-sm">
                        View all
                    </button>
                </div>
            </div><!-- end card-header -->

            <div class="card-body">
                <?php for ($i = 1; $i <= 4; $i++):
                    $text = $facker->text(rand(10, 50));
                    ?>
                    <div class="d-flex <?= ($i != 1) ? " mt-4" : "" ?>">
                        <div class="flex-shrink-0">
                            <img src="/images/small/img-2.jpg" class="rounded img-fluid" style="height: 60px;" alt="">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1 lh-base">
                                <a href="<?= Url::to(['post/view', 'id' => $i]) ?>" class="text-reset">
                                    <?= $text ?>
                                </a>
                            </h6>
                            <p class="text-muted fs-12 mb-0">
                                Dec 03, 2021
                                <i class="mdi mdi-circle-medium align-middle mx-1"></i>
                                12:09 PM
                            </p>
                        </div>
                    </div><!-- end -->
                <?php endfor; ?>
            </div><!-- end card body -->
        </div>

        <div class="card card-body">
            <div>
                <?php for ($i = 1; $i <= 4; $i++):
                    $text = $facker->text(rand(10, 15));
                    ?>
                    <a href="<?= Url::to(['post/view', 'id' => $i]) ?>" class="badge bg-success">
                        <?= $text ?>
                    </a>
                <?php endfor; ?>
            </div>
        </div>

    </div>

</div>