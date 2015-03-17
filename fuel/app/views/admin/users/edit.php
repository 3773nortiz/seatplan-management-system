<h2>Editing Users</h2>
<br/>
<div class="row center-block">
    <div class=" col-md-6 col-md-offset-3 formdetails">
    <?php echo Form::open(array(
            "class"=>"form-horizontal col-md-10 col-md-offset-1 formdetails",
            "enctype" => "multipart/form-data",
            'action' => 'admin/users/edit/' . $user->id,));
    ?>

    <?php echo render('admin/users/_form', compact('action')); ?>

    <?php echo Form::close(); ?>
    </div>
</div>

<p>
    <?php echo Html::anchor(Controller_Base::get_prefix() . 'users/view/'.$user->id, 'View'); ?> |
    <?php echo Html::anchor(Controller_Base::get_prefix() . 'users', 'Back'); ?></p>