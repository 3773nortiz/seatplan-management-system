<div class="row">

    <div class="col-md-4">
        <h2>View Seat Plan for <?php echo $class->class_name; ?></h2>
        <p>
        	<strong>Class Name:</strong>
        	<?php echo $class->class_name; ?></p>
        <p>
        	<strong>No of Chairs:</strong>
        	<?php echo $class->chairs; ?></p>
        <p>
        	<strong>Subject Name:</strong>
        	<?php echo $class->getSubjectName($class->subject_id); ?></p>
        <p>
            <strong>Subject Description:</strong>
            <?php echo $class->getSubjectDescription($class->subject_id); ?></p>
        <p>
            <strong>Attendace For:</strong>
            <?php echo date('F j, Y h:i A'); ?></p>

        <p>
            <strong>Class Schedule:</strong>
            <?php
                for ($x = 0; $x < strlen($class->schedule); $x++) {
                    echo Config::get('schedules')[$class->schedule[$x]];
                }
            ?>
        </p>

        <!-- <p>
        	<strong>User id:</strong>
        	<?php //echo $class->user_id; ?></p> -->
    </div>

    <?= render(Controller_Base::get_prefix() . 'class/_seatplan', compact('students', 'student_seats', 'class', 'scenario')); ?>

    <div class="col-md-4">
        <?php echo Html::anchor(Controller_Base::get_prefix() . 'class', 'Back'); ?>
    </div>
</div>