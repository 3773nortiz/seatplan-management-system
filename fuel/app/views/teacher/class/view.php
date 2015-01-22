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

        <?php echo Html::anchor(Controller_Base::get_prefix() . 'class/edit/'.$class->id, 'Edit'); ?> |
        <?php echo Html::anchor(Controller_Base::get_prefix() . 'class', 'Back'); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table>
            <?php for($x = 0; $x <= (Config::get('number_of_seat') + (Config::get('number_of_seat')  / 10)) / 11; $x++) {?>
                    <tr>
                     <?php for($y = 0; $y <= (Config::get('number_of_seat')  + (Config::get('number_of_seat')  / 10)) / 4; $y++) {?>
                        <td></td>
                    <?php }?>
                    </tr>
            <?php }?>
        </table>
    </div>
</div>