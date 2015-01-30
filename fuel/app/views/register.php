<div class="row center-block">
    <div class=" col-md-6 col-md-offset-3">
          <?php echo Form::open(array(
                    "class"=>"form-horizontal col-md-10 col-md-offset-1",
                    "enctype" => "multipart/form-data",
                    'action' => 'account/register',)); 
            ?>
                <?= View::forge('_form', ['action' => 'register']); ?>

            <?php echo Form::close(); ?>       
    </div>
</div>
