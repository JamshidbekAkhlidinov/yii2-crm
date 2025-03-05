<?php

namespace app\modules\admin\widgets;

use yii\base\Widget;

class CardWidget extends Widget
{
    public $icon = 'ri-visa-fill';
    public $name = 'Visa Card';
    public $amount = '$8,500';
    public $bgColor = 'bg-success-subtle';
    public $textColor = 'text-success';
    public $url = '';

    public function run()
    {
        return $this->render('card', [
            'icon' => $this->icon,
            'name' => $this->name,
            'amount' => $this->amount,
            'bgColor' => $this->bgColor,
            'textColor' => $this->textColor,
            'url' => $this->url,
        ]);
    }
}