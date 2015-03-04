
<div class="row center-block">
    <div class=" col-md-6 col-md-offset-3">
          <?php echo Form::open(array(
                    "class"=>"form-horizontal col-md-10 col-md-offset-1 formdetails",
                    "enctype" => "multipart/form-data",
                    'action' => 'admin/users/create')); 
            ?>
                <?= View::forge(Controller_Base::get_prefix() . 'users/_form', ['action' => 'register']); ?>

            <?php echo Form::close(); ?>       
    </div>
</div>
