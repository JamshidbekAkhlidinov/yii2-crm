<?php
/*
 *   Jamshidbek Akhlidinov
 *   7 - 3 2025 14:1:27
 *   https://ustadev.uz
 *   https://github.com/JamshidbekAkhlidinov
 */

/**
 * @var $post \app\forms\PostForm
 * @var $this \yii\web\View
 */

use alexantr\elfinder\InputFile;
use alexantr\tinymce\TinyMCE;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = translate("Create new post");
params()['breadcrumbs'][] = $this->title;
$form = ActiveForm::begin();

?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <?php
                echo $form->field($post, 'title')->textInput();
                echo $form->field($post, 'description')->widget(
                    TinyMCE::class,
                    [
                        'presetPath' => '@app/config/tinymce.php',
                        'clientOptions' => [
                            'height' => 600,
                            'file_picker_callback' => alexantr\elfinder\TinyMCE::getFilePickerCallback(['/post/tinymce']),
                        ],
                    ]
                );
                echo Html::submitButton("Save", ['class' => 'btn btn-success']);
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <?php
                echo $form->field($post, 'sub_text')->textarea();
                echo $form->field($post, 'image')->widget(
                    InputFile::class,
                    [
                        'clientRoute' => '/post/input',
                        'options' => [
                            'id' => 'post_image_input',
                        ]
                    ]
                );
                echo Html::submitButton("Save", ['class' => 'btn btn-success']);
                ?>
            </div>
        </div>
    </div>
</div>

<?php

ActiveForm::end();
?>
