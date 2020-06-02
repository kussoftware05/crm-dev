<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model admin\models\OrderMaster */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="page-form">

<?php $form = ActiveForm::begin(); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-8">

            <div class="row">
                <div class="col-sm-4 col-md-4">
                    <h5>General</h5>
                    <?= $form->field($order_model, 'order_date')->input('date')->label('Date Created') ?>

                    <div class="form-group">
                        <?= $form->field($order_model, 'order_status')->dropDownList([
                                'Processing' => 'Processing', 
                                'Completed' => 'Completed',
                                'Pending' => 'Pending',
                                'Cancel' => 'Cancel',
                            ], 
                            ['prompt' => 'Choose...']
                            ) ?>
                    </div>

                    <div class="form-group">
                        <?= $form->field($order_model, 'user_id')->dropDownList($customer_list,['prompt' => 'Select Customer'])->label('Customer') ?>
                    </div>

                </div>
                <div class="col-sm-4 col-md-4">
                    <h5>Billing Details</h5>
                    <?= $form->field($billing_model, 'first_name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($billing_model, 'last_name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($billing_model, 'company_name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($billing_model, 'address_line_1')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($billing_model, 'address_line_2')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($billing_model, 'city')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($billing_model, 'zipcode')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($billing_model, 'email')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-4 col-md-4">
                    <h5>Shipping Details</h5>
                    <div>
                        <input type="checkbox" id="s_same_as_b" name="shipping_same_as_billing" value="1">
                        <label for="shipping-confarmation">Shipping same as billing</label>
                    </div>
                    <div id="shipping-details">
                        <?= $form->field($shipping_model, 'first_name')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($shipping_model, 'last_name')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($shipping_model, 'company_name')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($shipping_model, 'address_line_1')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($shipping_model, 'address_line_2')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($shipping_model, 'city')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($shipping_model, 'zipcode')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($shipping_model, 'email')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-sm-4">
            <h5>Products</h5>
            <div class="product-container">

                <?php if(!empty($product_list)) : ?>
                
                <?php foreach($product_list as $key => $name ) : ?>
                    <div>
                        <input type="checkbox" name="productlist[]" value="<?= $key ?>">
                        <label for="id-<?= $key ?>"><?= $name ?></label>
                    </div>
                <?php endforeach ?>
                
                <?php else:  ?>
                    <?= 'currently no product in the system.' ?>
                <?php endif ?>
            </div>
        </div>

    </div>

</div>

<div class="form-group mt-3">
    <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
