<div class="col-md-12">
    <table class="table table-bordered" id="seatplan">
        <?php $yCoord = 'A'; ?>
        <?php var_dump($student_seats); ?>
        <?php for($x = 0; $x < Config::get('number_of_seat') / 10; $x++, $yCoord++): ?>
                <tr>
                <?php $xCoord = 1; ?>
                <?php for($y = 0; $y < 11; $y++, $xCoord++): ?>
                    <?php
                        $coord = '';
                        if ($y != 5) {
                            $coord = $yCoord . $xCoord;
                        } else {
                            $xCoord--;
                        }
                    ?>
                    <td ondrop="drop(event)" ondragover="allowDrop(event)" 
                    onclick="showAddStudent('<?= $coord ?>')" id="<?= $coord ?>" class="<?= $y == 5 ? 'no-drag' : '' ?>"></td>
                <?php endfor; ?>
                </tr>
        <?php endfor; ?>
    </table>
    <?= Html::img('assets/img/ic-avatar.jpg', [
        'draggable'     => 'true',
        'ondragstart'   => 'drag(event)',
        'id'            => 'chair-1'
    ]); ?>
</div>

<div class="modal fade bs-example-modal-sm" id="add-student" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="exampleModalLabel">Add Student</h4>
        </div>
        <div class="modal-body">
            <?= Form::open(array('action' => '',  
                    'method' => 'post',
                    'role'   => 'form',
                    'id'     => 'form-add-student-in-seat',
                    'onsubmit' => 'addStudentPerSeat(event)'));
                ?>

                <?= Form::select('select1', 0, $students, array(
                    'class' => 'form-control',
                    'id' => 'select1')); ?>

                <br/><br/><br/><br/>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6">  
                            <?php echo Form::submit('submit', 'Add', array(
                                'class'   => 'btn btn-primary add-student-action'));
                            ?>   
                        </div>  
                        <div class="col-md-6">
                            <?php echo Form::submit('button', 'Close', array(
                                'class'        => 'btn btn-primary add-student-close',
                                'data-dismiss' => 'modal')); ?>     
                        </div> 
                    </div>
                </div>

            <?= Form::close(); ?>
        </div>
    </div>
  </div>
</div>

<script>
    var currentSelectedChair;

    function allowDrop(ev) {
        ev.preventDefault();
        $('#seatplan td.drag-over').removeClass('drag-over');
        $(ev.target).addClass('drag-over');
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        $target = $(ev.target);
        $target.removeClass('drag-over');
        if ($target.hasClass('no-drag')) {
            return false;
        }

        ev.target.appendChild(document.getElementById(data));
        $target.addClass('has-student');
    }

    function showAddStudent(coord) {
        if (coord) {
            $('#add-student').modal('show');
        }
        currentSelectedChair = coord;

    }

    function attendace(stat) {

    }

    function addStudent(studentId) {
        if (currentSelectedChair) {
            $.get(BASE_URL + USER_PREFIX + 'studentclass/add_student/' + studentId + '/<?= $class_id ?>/' + currentSelectedChair);
        }
    }

    function addStudentPerSeat(e) {
        e.preventDefault();
        var studId = $('[name="select1"]').val();
        console.log(studId);
        addStudent(studId);
         $('#add-student').modal('hide');
    }

    $(function () {
        $('#select1').selectator();
    });
</script>