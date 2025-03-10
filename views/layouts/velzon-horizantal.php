<?php
/*
 *   Jamshidbek Akhlidinov
 *   21 - 11 2023 15:4:46
 *   https://ustadev.uz
 *   https://github.com/JamshidbekAkhlidinov/yii2basic
 */

/**
 * @var $content
 * @var $this yii\web\View
 */

use app\components\menu\Menu;
use app\models\Advertise;
use app\modules\admin\assets\AdminAsset;
use app\modules\admin\widgets\LanguageSwitcherWidget;
use yii\bootstrap5\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

AdminAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => app()->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

$advertisement = Advertise::findOne(['status' => Advertise::status_active, 'align' => Advertise::align_top]);
?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= app()->language ?>"
      data-layout="horizontal"
      data-topbar="light"
      data-sidebar="dark"
      data-sidebar-size="lg"
      data-sidebar-image="none"
      data-preloader="disable"
>

<head>
    <meta charset="utf-8"/>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<style>
    .active2 {
        z-index: 1;
        color: #212529;
        text-decoration: none;
        background-color: #eff2f7;
    }
</style>

<!-- Begin page -->
<div id="layout-wrapper">

    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box horizontal-logo">
                        <a href="/" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="/images/logo-sm.png" alt="" height="22">
                        </span>
                            <span class="logo-lg">
                            <img src="/images/new/logo-white.png" alt="" height="17">
                        </span>
                        </a>

                        <a href="/" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="/images/logo-sm.png" alt="" height="22">
                        </span>
                            <span class="logo-lg">
                            <img src="/images/new/logo-black.png" alt="" height="17">
                        </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                            id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    </button>
                    <!-- App Search-->
                    <form class="app-search d-none d-md-block" action="<?= Url::to(['post/index']) ?>">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search..." name="search"
                                   autocomplete="off"
                                   id="search-options" value="<?= get('search') ?>">
                            <span class="mdi mdi-magnify search-widget-icon"></span>
                            <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                                  id="search-close-options"></span>
                        </div>
                    </form>
                </div>

                <div class="d-flex align-items-center">

                    <div class="dropdown d-md-none topbar-head-dropdown header-item">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                            <i class="bx bx-search fs-22"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                             aria-labelledby="page-header-search-dropdown">
                            <form class="p-3" action="<?= Url::to(['post/index']) ?>">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Search ..."
                                               aria-label="Recipient's username">
                                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?= LanguageSwitcherWidget::widget() ?>


                    <!--                    <div class="ms-1 header-item d-none d-sm-flex">-->
                    <!--                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"-->
                    <!--                                data-toggle="fullscreen">-->
                    <!--                            <i class='bx bx-fullscreen fs-22'></i>-->
                    <!--                        </button>-->
                    <!--                    </div>-->

                </div>
            </div>
        </div>
    </header>

    <!-- ========== App Menu ========== -->
    <div class="app-menu navbar-menu">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <!-- Dark Logo-->
            <a href="/" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="/images/logo-sm.png" alt="" height="22">
                    </span>
                <span class="logo-lg">
                        <img src="/images/new/logo-white.png" alt="" height="17">
                    </span>
            </a>
            <!-- Light Logo-->
            <a href="/" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="/images/logo-sm.png" alt="" height="22">
                    </span>
                <span class="logo-lg">
                        <img src="/images/new/logo-black.png" alt="" height="17">
                    </span>
            </a>
            <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                <i class="ri-record-circle-line"></i>
            </button>
        </div>

        <div id="scrollbar">
            <div class="container-fluid">

                <div id="two-column-menu">
                </div>
                <?= Menu::getMenu() ?>
            </div>
            <!-- Sidebar -->
        </div>

        <div class="sidebar-background"></div>
    </div>
    <!-- Left Sidebar End -->
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>
    <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0"><?= $this->title ?></h4>

                            <?php
                            echo Breadcrumbs::widget([
                                'homeLink' => [
                                    'url' => '/',
                                    'label' => translate("Home")
                                ],
                                'links' => params()['breadcrumbs'] ?? [],
                                'options' => [
                                    'class' => "m-0",
                                ]
                            ]);
                            ?>

                        </div>
                    </div>
                </div>

                <?php if (session()->hasFlash('alert')) : ?>
                    <?php echo Alert::widget([
                        'body' => ArrayHelper::getValue(
                            session()->getFlash('alert'),
                            'body'
                        ),
                        'options' => ArrayHelper::getValue(
                            session()->getFlash('alert'),
                            'options'
                        ),
                    ]) ?>
                <?php endif; ?>

                <?php if ($advertisement): ?>
                    <a href="<?= $advertisement->url ?>">
                        <img src="<?= $advertisement->image ?>" title="<?= $advertisement->description ?>" width="100%"
                             class="pb-4">
                    </a>
                <?php endif; ?>
                <?= $content ?>
                <!-- end page title -->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script>
                        ©
                        Created by <?= Html::a("<b>ustadev.uz</b>", 'https://ustadev.uz', ['target' => '_blank']) ?>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


<!--preloader-->
<div id="preloader">
    <div id="status">
        <div class="spinner-border text-primary avatar-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


