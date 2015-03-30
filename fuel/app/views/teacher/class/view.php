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
    </div>
</div>
<div class="row pull-right">
    <div class="col-md-12">
            <h2><button class="btn btn-default" onclick="DownloadPDF()"><span><i class="fa fa-print"></i></span> Print</button>
            </h2>
            <form id="form-download" action="http://localhost/seatplan-management-system/public/print.php" method="POST" hidden>
                <input value="" type="text" name="url">
            </form>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php echo Html::anchor(Controller_Base::get_prefix() . 'class/edit/'.$class->id, 'Edit'); ?> |
        <?php echo Html::anchor(Controller_Base::get_prefix() . 'class', 'Back'); ?>
    </div>
</div>
<div class="row">
    <?= render(Controller_Base::get_prefix() . 'class/_seatplan', compact('students', 'student_seats', 'class', 'scenario')); ?>
</div>


<script>
    function DownloadPDF () {
        console.log($('#form-download [name="url"]').val(window.location.href));
        $('#form-download [name="url"]').val(window.location.href);
        $('#form-download').submit();
    }
</script>
`