<?php

/**
 * @var $bgColor
 * @var $textColor
 * @var $icon
 * @var $name
 * @var $amount
 * @var $url
 */

?>

<div class="form-chck card-radio col-md-3 p-1">
    <div class="form-check-label" style="padding-right:15px">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <div class="avatar-xs">
                    <div class="avatar-title <?= $bgColor ?> <?= $textColor ?> fs-18 rounded">
                        <i class="<?= $icon ?>"></i>
                    </div>
                </div>
            </div>
            <div class="flex-grow-1 ms-3">
                <h6 class="mb-1"><?= $name ?></h6>
                <div class="d-flex justify-content-between">
                    <b class="pay-amount"><?= $amount ?></b>
                    <a href="<?= $url ?>" class="pay-amount btn btn-sm bg-success" title="Add">
                        <i class=" ri-add-circle-line"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
