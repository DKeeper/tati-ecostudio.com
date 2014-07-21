<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'content')->widget(letyii\tinymce\Tinymce::className(), [
        'id' => 'content',
        'configs' => [ // Read more: http://www.tinymce.com/wiki.php/Configuration
            "language" => "ru",
            "height" => "500",
            "plugins" => [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste moxiemanager"
            ],
            "toolbar" => "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        ],
    ]) ?>

    <?= $form->field($model, 'script')->textarea(['rows'=>10]) ?>

    <?= $form->field($model, 'status')->dropDownList(['0'=>Yii::t('view','Inactive'),'1'=>Yii::t('view','Active')]) ?>

    <?= $form->field($model, 'output_order')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('view', 'Create') : Yii::t('view', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
