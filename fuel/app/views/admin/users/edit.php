<h2>Editing Users</h2>
<br/>
<div class="row center-block">
    <div class=" col-md-6 col-md-offset-3 formdetails">
<?php echo render('admin/users/_form', compact('action')); ?>
<p>
    <?php echo Html::anchor(Controller_Base::get_prefix() . 'users/view/'.$user->id, 'View'); ?> |
    <?php echo Html::anchor(Controller_Base::get_prefix() . 'users', 'Back'); ?></p>    
    </div>
</div>