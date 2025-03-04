<?php

/** @var yii\web\View $this */


use app\modules\admin\components\view\LandingElementSelector;
use app\modules\admin\enums\LandingElementEnum;
use app\modules\admin\modules\content\models\Post;
use yii\db\Expression;
use yii\helpers\Html;

$selector = new LandingElementSelector();
$headerTitle = $selector->getElement(LandingElementEnum::HEADER_TITLE);
$serviceTitle = $selector->getElement(LandingElementEnum::SERVICE_TITLE);
$createTitle = $selector->getElement(LandingElementEnum::CREATE_TITLE);
$questionTitle = $selector->getElement(LandingElementEnum::QUESTION_TITLE);
$productTitle = $selector->getElement(LandingElementEnum::PRODUCT_TITLE);
$projectDesign = $selector->getElement(LandingElementEnum::DESIGN);
$teamTitle = $selector->getElement(LandingElementEnum::TEAM_TITLE);
$projectDesignDescription = explode("\n", $projectDesign->description);
$projectStructure = $selector->getElement(LandingElementEnum::STRUCTURE);
$projectStructureDescription = explode("\n", $projectStructure->description);
$contactTitle = $selector->getElement(LandingElementEnum::CONTACT);
$contactDescription = explode("\n", $contactTitle->description);
$contactValue = explode("\n", $contactTitle->value);
$widgetStatics = $selector->getElement(LandingElementEnum::WIDGETS);
$widgetItem = explode("\n", $widgetStatics->description);

$currentDateTime = new \DateTime('now', new DateTimeZone('Asia/Tashkent'));
$currentDateTimeString = $currentDateTime->format('Y-m-d H:i:s');

$posts = Post::find()
    ->where(['<', 'publish_at', $currentDateTimeString])
    ->orderBy(['publish_at' => SORT_DESC])
    ->limit(3)
    ->all();


$this->title = 'My Yii Application';
?>
<!-- start hero section -->
<section class="section pb-0" id="hero">
    <div class="bg-overlay bg-overlay-pattern"
         style="height: 100vh;background-image: url('<?= $headerTitle->files ?>') !important"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-sm-10">
                <div class="text-center mt-lg-5 pt-5">
                    <h1 class="display-6 fw-semibold mb-3 lh-base"><?= $headerTitle->title ?></h1>
                    <p class="lead text-muted lh-base"><?= $headerTitle->description ?></p>

                    <div class="d-flex gap-2 justify-content-center mt-4">
                        <a href="auth-signup-basic.html" class="btn btn-primary"><?= translate("Get Started") ?> <i
                                    class="ri-arrow-right-line align-middle ms-1"></i></a>
                        <a href="pages-pricing.html" class="btn btn-danger"><?= translate("View Plans") ?> <i
                                    class="ri-eye-line align-middle ms-1"></i></a>
                    </div>
                </div>

                <div class="mt-4 mt-sm-5 pt-sm-5 mb-sm-n5">
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
    <div class="position-absolute start-0 end-0 bottom-0 hero-shape-svg">
        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
             viewBox="0 0 1440 120">
            <g mask="url(&quot;#SvgjsMask1003&quot;)" fill="none">
                <path d="M 0,118 C 288,98.6 1152,40.4 1440,21L1440 140L0 140z">
                </path>
            </g>
        </svg>
    </div>
    <!-- end shape -->
</section>
<!-- end hero section -->

<!-- start client section -->
<div class="pt-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="text-center mt-5">
                    <h5 class="fs-20">Trusted <span class="text-primary text-decoration-underline">by</span> the world's
                        best</h5>

                    <!-- Swiper -->
                    <div class="swiper trusted-client-slider mt-sm-5 mt-4 mb-sm-5 mb-4" dir="ltr">
                        <div class="swiper-wrapper">
                            <?php foreach ($partnerLogo = $selector->getElements(LandingElementEnum::PARTNER) as $partnerItem) : ?>
                                <div class="swiper-slide">
                                    <div class="client-images">
                                        <img src="<?= $partnerItem->files ?>" alt="client-img"
                                             class="mx-auto img-fluid d-block">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end client section -->

<!-- start services -->
<section class="section" id="services">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h1 class="mb-3 ff-secondary fw-semibold lh-base"><?= $serviceTitle->title ?></h1>
                    <p class="text-muted"><?= $serviceTitle->description ?></p>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row g-3">
            <?php foreach ($serviceItems = $selector->getElements(LandingElementEnum::SERVICE) as $Item) : ?>
                <div class="col-lg-4">
                    <div class="d-flex p-3">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar-sm icon-effect">
                                <div class="avatar-title bg-transparent text-success rounded-circle">
                                    <img style="width: 50px" src="<?= $Item->files ?>">
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="fs-18"><?= $Item->title ?></h5>
                            <p class="text-muted my-3 ff-secondary"><?= $Item->description ?></p>
                            <div>
                                <a href="<?= $Item->url ?>" class="fs-13 fw-medium">Learn More <i
                                            class="ri-arrow-right-s-line align-bottom"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- end services -->

<!--Post section-->
<section>
    <div class="container">
        <div class="d-flex justify-content-between mt-3 mb-lg-3">
            <h3><?= translate("Posts") ?></h3>
            <p><a href="#"><?= translate("All") ?></a></p>
        </div>
        <div class="row mb-lg-3">
            <?php foreach ($posts as $post) : ?>
                <div class=" col-lg-4">
                    <div class="card card-overlay">
                        <img class="card-img" src="<?= $post->image ?>" alt="Card image"
style="max-width: 100%; height: 300px; object-fit: cover">
                        <div class="card-img-overlay p-0 d-flex flex-column">
                            <div class="card-header bg-transparent">
                                <a href="#">
                                    <h4 class="card-title text-white mb-0"><?= $post->title ?></h4>
                                </a>
                            </div>
                            <div class="card-body">
                                <p class="card-text text-white mb-2"><?= $post->sub_text ?></p>
                                <p class="card-text">
                                    <small class="text-white">Last updated 3 mins ago</small>
                                </p>
                            </div>
                            <div class="card-footer bg-transparent text-center">
                                <a href="javascript:void(0);" class="link-light">Read More <i
                                            class="ri-arrow-right-s-line align-middle ms-1 lh-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- start features -->
<section class="section bg-light py-5" id="features">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-6 col-sm-7 mx-auto">
                <div>
                    <img src="<?= $widgetStatics->files ?>" alt="" class="img-fluid mx-auto">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-muted">
                    <div class="avatar-sm icon-effect mb-4">
                        <div class="avatar-title bg-transparent rounded-circle text-success h1">
                            <img src="<?= $widgetStatics->icon ?>" alt="..." style="width: 40px">
                        </div>
                    </div>
                    <h3 class="mb-3 fs-20"><?= $widgetStatics->title ?></h3>
                    <p class="mb-4 ff-secondary fs-16"><?= $widgetStatics->sub_text ?></p>

                    <div class="row pt-3">
                        <?php foreach ($widgetItem as $item) :
                            $widgetItemArray = explode(":", $item)
                            ?>
                            <div class="col-3">
                                <div class="text-center">
                                    <h4><?= $widgetItemArray[1] ?? "" ?></h4>
                                    <p><?= $widgetItemArray[0] ?? "" ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- end features -->

<!-- start cta -->
<section class="py-5 bg-primary position-relative">
    <div class="bg-overlay bg-overlay-pattern opacity-50"></div>
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-sm">
                <div>
                    <h4 class="text-white mb-0 fw-semibold"><?= $createTitle->title ?></h4>
                </div>
            </div>
            <!-- end col -->
            <div class="col-sm-auto">
                <div>
                    <a href="<?= $createTitle->url ?>" target="_blank" class="btn bg-gradient btn-danger"><i
                                class="ri-shopping-cart-2-line align-middle me-1"></i> Buy Now</a>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- end cta -->

<!-- start features -->
<section class="section">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="text-muted">
                    <h5 class="fs-12 text-uppercase text-success"><?= translate("Design") ?></h5>
                    <h4 class="mb-3"><?= $projectDesign->title ?></h4>
                    <p class="mb-4 ff-secondary"><?= $projectDesign->sub_text ?></p>

                    <div class="row">
                        <?php foreach ($projectDesignDescription as $descriptionItem): ?>
                            <div class="col-sm-5">
                                <div class="vstack gap-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-2">
                                            <div class="avatar-xs icon-effect">
                                                <div class="avatar-title bg-transparent text-success rounded-circle h2">
                                                    <i class="ri-check-fill"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="fs-14 mb-0"><?= $descriptionItem ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="mt-4">
                        <a href="<?= $projectDesign->url ?>" class="btn btn-primary"><?= translate("Learn More") ?> <i
                                    class="ri-arrow-right-line align-middle ms-1"></i></a>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-lg-6 col-sm-7 col-10 ms-auto order-1 order-lg-2">
                <div>
                    <img src="/images/landing/features/img-2.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row align-items-center mt-5 pt-lg-5 gy-4">
            <div class="col-lg-6 col-sm-7 col-10 mx-auto">
                <div>
                    <img src="/images/landing/features/img-3.png" alt="" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-muted ps-lg-5">
                    <h5 class="fs-12 text-uppercase text-success"><?= translate("Structure") ?></h5>
                    <h4 class="mb-3"><?= $projectStructure->title ?></h4>
                    <p class="mb-4"><?= $projectStructure->sub_text ?></p>

                    <?php foreach ($projectStructureDescription as $descriptionItem) : ?>
                        <div class="vstack gap-2">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-2">
                                    <div class="avatar-xs icon-effect">
                                        <div class="avatar-title bg-transparent text-success rounded-circle h2">
                                            <i class="ri-check-fill"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="mb-0"><?= $descriptionItem ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- end features -->

<!-- start plan -->
<section class="section bg-light" id="plans">
    <div class="bg-overlay bg-overlay-pattern"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h3 class="mb-3 fw-semibold"><?= $productTitle->title ?></h3>
                    <p class="text-muted mb-4"><?= $productTitle->description ?></p>

                    <div class="d-flex justify-content-center align-items-center">
                        <div>
                            <h5 class="fs-14 mb-0">Month</h5>
                        </div>
                        <div class="form-check form-switch fs-20 ms-3 " onclick="check()">
                            <input class="form-check-input" type="checkbox" id="plan-switch">
                            <label class="form-check-label" for="plan-switch"></label>
                        </div>
                        <div>
                            <h5 class="fs-14 mb-0">Annual <span
                                        class="badge bg-success-subtle text-success">Save 20%</span></h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row gy-4">
            <div class="col-lg-4">
                <div class="card plan-box mb-0">
                    <div class="card-body p-4 m-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="mb-1 fw-semibold">Basic Plan</h5>
                                <p class="text-muted mb-0">For Startup</p>
                            </div>
                            <div class="avatar-sm">
                                <div class="avatar-title bg-light rounded-circle text-primary">
                                    <i class="ri-book-mark-line fs-20"></i>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 text-center">
                            <h1 class="month"><sup><small>$</small></sup><span class="ff-secondary fw-bold">19</span>
                                <span class="fs-13 text-muted">/Month</span></h1>
                            <h1 class="annual"><sup><small>$</small></sup><span class="ff-secondary fw-bold">171</span>
                                <span class="fs-13 text-muted">/Year</span></h1>
                        </div>

                        <div>
                            <ul class="list-unstyled text-muted vstack gap-3 ff-secondary">
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            Upto <b>3</b> Projects
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            Upto <b>299</b> Customers
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            Scalable Bandwidth
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <b>5</b> FTP Login
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-danger me-1">
                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <b>24/7</b> Support
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-danger me-1">
                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <b>Unlimited</b> Storage
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-danger me-1">
                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            Domain
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="mt-4">
                                <a href="javascript:void(0);" class="btn btn-soft-success w-100">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
            <div class="col-lg-4">
                <div class="card plan-box mb-0 ribbon-box right">
                    <div class="card-body p-4 m-2">
                        <div class="ribbon-two ribbon-two-danger"><span>Popular</span></div>
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="mb-1 fw-semibold">Pro Business</h5>
                                <p class="text-muted mb-0">Professional plans</p>
                            </div>
                            <div class="avatar-sm">
                                <div class="avatar-title bg-light rounded-circle text-primary">
                                    <i class="ri-medal-fill fs-20"></i>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 text-center">
                            <h1 class="month"><sup><small>$</small></sup><span class="ff-secondary fw-bold">29</span>
                                <span class="fs-13 text-muted">/Month</span></h1>
                            <h1 class="annual"><sup><small>$</small></sup><span class="ff-secondary fw-bold">261</span>
                                <span class="fs-13 text-muted">/Year</span></h1>
                        </div>

                        <div>
                            <ul class="list-unstyled text-muted vstack gap-3 ff-secondary">
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            Upto <b>15</b> Projects
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <b>Unlimited</b> Customers
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            Scalable Bandwidth
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <b>12</b> FTP Login
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <b>24/7</b> Support
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-danger me-1">
                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <b>Unlimited</b> Storage
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-danger me-1">
                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            Domain
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="mt-4">
                                <a href="javascript:void(0);" class="btn btn-soft-success w-100">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
            <div class="col-lg-4">
                <div class="card plan-box mb-0">
                    <div class="card-body p-4 m-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="mb-1 fw-semibold">Platinum Plan</h5>
                                <p class="text-muted mb-0">Enterprise Businesses</p>
                            </div>
                            <div class="avatar-sm">
                                <div class="avatar-title bg-light rounded-circle text-primary">
                                    <i class="ri-stack-fill fs-20"></i>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 text-center">
                            <h1 class="month"><sup><small>$</small></sup><span class="ff-secondary fw-bold">39</span>
                                <span class="fs-13 text-muted">/Month</span></h1>
                            <h1 class="annual"><sup><small>$</small></sup><span class="ff-secondary fw-bold">351</span>
                                <span class="fs-13 text-muted">/Year</span></h1>
                        </div>

                        <div>
                            <ul class="list-unstyled text-muted vstack gap-3 ff-secondary">
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <b>Unlimited</b> Projects
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <b>Unlimited</b> Customers
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            Scalable Bandwidth
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <b>Unlimited</b> FTP Login
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <b>24/7</b> Support
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <b>Unlimited</b> Storage
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            Domain
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="mt-4">
                                <a href="javascript:void(0);" class="btn btn-soft-success w-100">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!-- end container -->
</section>
<!-- end plan -->

<!-- start faqs -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h3 class="mb-3 fw-semibold"><?= $questionTitle->title ?></h3>
                    <p class="text-muted mb-4 ff-secondary"><?= $questionTitle->description ?></p>

                    <div class="hstack gap-2 justify-content-center">
                        <button type="button" class="btn btn-primary btn-label rounded-pill"><i
                                    class="ri-mail-line label-icon align-middle rounded-pill fs-16 me-2"></i> Email Us
                        </button>
                        <button type="button" class="btn btn-info btn-label rounded-pill"><i
                                    class="ri-twitter-line label-icon align-middle rounded-pill fs-16 me-2"></i> Send Us
                            Tweet
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row g-lg-5 g-4">
            <div class="col-lg-12">
                <div class="d-flex align-items-center mb-2">
                    <div class="flex-shrink-0 me-1">
                        <i class="ri-question-line fs-24 align-middle text-success me-1"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-0 fw-semibold">General Questions</h5>
                    </div>
                </div>
                <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box"
                     id="genques-accordion">
                    <div class="row">
                        <?php foreach ($selector->getElements(LandingElementEnum::QUESTION) as $question) : ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="<?= $question->id ?>">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#<?= $question->id ?>-collapse" aria-expanded="false"
                                            aria-controls="<?= $question->id ?>-collapse">
                                        <?= $question->title ?>
                                    </button>
                                </h2>
                                <div id="<?= $question->id ?>-collapse" class="accordion-collapse collapse"
                                     aria-labelledby="<?= $question->id ?>" data-bs-parent="#genques-accordion">
                                    <div class="accordion-body ff-secondary">
                                        <?= $question->description ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!--end accordion-->

            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- end faqs -->

<!-- start review -->
<section class="section bg-primary" id="reviews">
    <div class="bg-overlay bg-overlay-pattern"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center">
                    <div>
                        <i class="ri-double-quotes-l text-success display-3"></i>
                    </div>
                    <h4 class="text-white mb-5"><span class="text-success">19k</span>+ Satisfied clients</h4>

                    <!-- Swiper -->
                    <div class="swiper client-review-swiper rounded" dir="ltr">
                        <div class="swiper-wrapper">
                            <?php foreach ($opinionItems = $selector->getElements(LandingElementEnum::OPINION) as $Item) : ?>
                                <div class="swiper-slide">
                                    <div class="row justify-content-center">
                                        <div class="col-10">
                                            <div class="text-white-50">
                                                <p class="fs-20 ff-secondary mb-4">" <?= $Item->description ?> "</p>

                                                <div>
                                                    <h5 class="text-white"><?= $Item->title ?></h5>
                                                    <p>- <?= $Item->sub_text ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-button-next bg-white rounded-circle"></div>
                        <div class="swiper-button-prev bg-white rounded-circle"></div>
                        <div class="swiper-pagination position-relative mt-2"></div>
                    </div>
                    <!-- end slider -->
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- end review -->

<!-- start counter -->
<section class="py-5 position-relative bg-light">
    <div class="container">
        <div class="row text-center gy-4">
            <?php foreach ($stattisticItems = $selector->getElements(LandingElementEnum::STATISTIC) as $statistic) : ?>
                <div class="col-lg-3 col-6">
                    <div>
                        <h2 class="mb-2"><?= $statistic->description ?></h2>
                        <div class="text-muted"><?= $statistic->title ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- end counter -->

<!-- start Work Process -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h3 class="mb-3 fw-semibold">Our Work Process</h3>
                    <p class="text-muted mb-4 ff-secondary">In an ideal world this website wouldn’t exist, a client
                        would acknowledge the importance of having web copy before the Proin vitae ipsum vel ex finibus
                        semper design starts.</p>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row text-center">
            <div class="col-lg-4">
                <div class="process-card mt-4">
                    <div class="process-arrow-img d-none d-lg-block">
                        <img src="/images/landing/process-arrow-img.png" alt="" class="img-fluid">
                    </div>
                    <div class="avatar-sm icon-effect mx-auto mb-4">
                        <div class="avatar-title bg-transparent text-success rounded-circle h1">
                            <i class="ri-quill-pen-line"></i>
                        </div>
                    </div>

                    <h5>Tell us what you need</h5>
                    <p class="text-muted ff-secondary">The profession and the employer and your desire to make your
                        mark.</p>
                </div>
            </div>
            <!-- end col -->
            <div class="col-lg-4">
                <div class="process-card mt-4">
                    <div class="process-arrow-img d-none d-lg-block">
                        <img src="/images/landing/process-arrow-img.png" alt="" class="img-fluid">
                    </div>
                    <div class="avatar-sm icon-effect mx-auto mb-4">
                        <div class="avatar-title bg-transparent text-success rounded-circle h1">
                            <i class="ri-user-follow-line"></i>
                        </div>
                    </div>

                    <h5>Get free quotes</h5>
                    <p class="text-muted ff-secondary">The most important aspect of beauty was, therefore, an inherent
                        part.</p>
                </div>
            </div>
            <!-- end col -->
            <div class="col-lg-4">
                <div class="process-card mt-4">
                    <div class="avatar-sm icon-effect mx-auto mb-4">
                        <div class="avatar-title bg-transparent text-success rounded-circle h1">
                            <i class="ri-book-mark-line"></i>
                        </div>
                    </div>

                    <h5>Deliver high quality product</h5>
                    <p class="text-muted ff-secondary">We quickly learn to fear and thus automatically avoid
                        potentially.</p>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- end Work Process -->

<!-- start team -->
<section class="section bg-light" id="team">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h3 class="mb-3 fw-semibold"><?= $teamTitle->title ?></h3>
                    <p class="text-muted mb-4 ff-secondary"><?= $teamTitle->description ?></p>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <?php foreach ($teamMember = $selector->getElements(LandingElementEnum::TEAM) as $teamItem) : ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body text-center p-4">
                            <div class="avatar-xl mx-auto mb-4 position-relative">
                                <img src="<?= $teamItem->files ?>" alt=""
                                     class="rounded-circle avatar-xl user-profile-image object-fit-cover">
                                <a href="<?= $teamItem->url ?>"
                                   class="btn btn-success btn-sm position-absolute bottom-0 end-0 rounded-circle avatar-xs">
                                    <div class="avatar-title bg-transparent">
                                        <i class="ri-mail-fill align-bottom"></i>
                                    </div>
                                </a>
                            </div>
                            <!-- end card body -->
                            <h5 class="mb-1"><a href="pages-profile.html" class="text-body"><?= $teamItem->title ?></a>
                            </h5>
                            <p class="text-muted mb-0 ff-secondary"><?= $teamItem->description ?></p>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mt-2">
                    <a href="<?= $teamTitle->url ?>" class="btn btn-primary"><?= $teamTitle->sub_text ?> <i
                                class="ri-arrow-right-line ms-1 align-bottom"></i></a>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- end team -->

<!-- start contact -->
<section class="section" id="contact">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h3 class="mb-3 fw-semibold"><?= $contactTitle->title ?></h3>
                    <p class="text-muted mb-4 ff-secondary"><?= $contactTitle->sub_text ?></p>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row gy-4">
            <div class="col-lg-4">
                <div>
                    <?php foreach ($contactDescription as $contactItem) :
                        $contactItemArray = explode(":", $contactItem)
                        ?>
                        <div class="mt-4">
                            <h5 class="fs-13 text-muted text-uppercase"><?= $contactItemArray[0] ?? "" ?>:</h5>
                            <div class="ff-secondary fw-semibold"><?= $contactItemArray[1] ?? "" ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div>
                    <?php foreach ($contactValue as $contactItem) :
                        $contactItemArray = explode("=", $contactItem)

                        ?>
                        <div class="mt-4">
                            <h5 class="fs-13 text-muted text-uppercase"><?= $contactItemArray[0] ?? "" ?>:</h5>
                            <div class="ff-secondary fw-semibold"><?= $contactItemArray[1] ?? "" ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- end col -->
            <div class="col-lg-8">
                <div>
                    <form>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="name" class="form-label fs-13">Name</label>
                                    <input name="name" id="name" type="text" class="form-control bg-light border-light"
                                           placeholder="Your name*">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="email" class="form-label fs-13">Email</label>
                                    <input name="email" id="email" type="email"
                                           class="form-control bg-light border-light" placeholder="Your email*">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="subject" class="form-label fs-13">Subject</label>
                                    <input type="text" class="form-control bg-light border-light" id="subject"
                                           name="subject" placeholder="Your Subject.."/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="comments" class="form-label fs-13">Message</label>
                                    <textarea name="comments" id="comments" rows="3"
                                              class="form-control bg-light border-light"
                                              placeholder="Your message..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-end">
                                <input type="submit" id="submit" name="send" class="submitBnt btn btn-primary"
                                       value="Send Message">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- end contact -->

<!-- start cta -->
<section class="py-5 bg-primary position-relative">
    <div class="bg-overlay bg-overlay-pattern opacity-50"></div>
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-sm">
                <div>
                    <h4 class="text-white mb-0 fw-semibold"><?= $createTitle->title ?></h4>
                </div>
            </div>
            <!-- end col -->
            <div class="col-sm-auto">
                <div>
                    <a href="<?= $createTitle->url ?>" target="_blank" class="btn bg-gradient btn-danger"><i
                                class="ri-shopping-cart-2-line align-middle me-1"></i> Buy Now</a>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- end cta -->