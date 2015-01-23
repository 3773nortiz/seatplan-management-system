<div class="row">

    <div class="col-md-4">
        <h2>View Seat Plan for <?php echo $class->class_name; ?></h2>
        <p>
        	<strong>Class Name:</strong>
        	<?php echo $class->class_name; ?></p>
        <p>
        	<strong>No of Chairs:</strong>
        	<?php echo $class->chairs; ?></p>
        <!-- <p>
        	<strong>Subject id:</strong>
        	<?php //echo $class->subject_id; ?></p>
        <p>
        	<strong>User id:</strong>
        	<?php //echo $class->user_id; ?></p> -->
    </div>

    <?= render(Controller_Base::get_prefix() . 'class/_seatplan', ['class_id' => $class->id, 'student_seats' => $student_seats]); ?>

    <div class="col-md-4">
        <?php echo Html::anchor(Controller_Base::get_prefix() . 'class/edit/'.$class->id, 'Edit'); ?> |
        <?php echo Html::anchor(Controller_Base::get_prefix() . 'class', 'Back'); ?>
    </div>
</div>