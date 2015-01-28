<div class="col-md-12">
    <table class="table table-bordered" id="seatplan">
        <?php $yCoord = 'A'; ?>
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
                    <td ondrop="drop(event)" ondragover="allowDrop(event)" onclick="showAddStudent('<?= $coord ?>')" id="<?= $coord ?>"
                        class="<?= ($y == 5 ? 'no-drag' : '') . (!empty($student_seats[$coord]) ? ' has-student' : '') ?>"
                        onmouseover="hover(this, true)" onmouseout="hover(this, false)">
                        <?php if (!empty($student_seats[$coord])) : ?>
                            <div draggable="true" ondragstart="drag(event)" id="<?= $student_seats[$coord]['user_id'] ?>"
                            class="<?= Config::get('gender')[$student_seats[$coord]['gender']] ?> student">

                            </div>
                        <?php endif; ?>
                    </td>
                <?php endfor; ?>
                </tr>
        <?php endfor; ?>
    </table>
</div>

<div class="modal fade bs-example-modal-sm" id="add-student" tabindex="-1" role="dialog" 
aria-labelledby="mySmallModalLabel" aria-hidden="true" ng-controller="AddStudentCtrl">
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

                <select class="form-control" name="select1" 
                id="select1" ng-show="student.length > 0">
                    <option ng-repeat="student in students" value="{{student.id}}">
                        <span>{{student.fname}} {{student.mname}} {{student.lname}}</span>
                    </option>
                </select>

                 <span ng-if="students.length <= 0">No Student</span>

                <br/><br/><br/><br/>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6">
                            <?php echo Form::submit('submit', 'Add', array(
                                'class'    => 'btn btn-primary add-student-action',
                                'ng-click' => 'removeStudent()'));
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
    var classId  = '<?= $class_id ?>';
    var currentSelectedChair;
    var dragFromId;

    function allowDrop(ev) {
        ev.preventDefault();
        $('#seatplan td.drag-over').removeClass('drag-over');
        $(ev.target).addClass('drag-over');
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
        dragFromId = $(ev.target).closest('td').attr('id');
    }

    function drop(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        $target = $(ev.target);
        $target.removeClass('drag-over');
        if ($target.hasClass('no-drag') || !$target.attr('ondrop')) {
            return false;
        }

        ev.target.appendChild(document.getElementById(data));
        $target.addClass('has-student');
        $('#' + dragFromId).removeClass('has-student');

        $.get(BASE_URL + USER_PREFIX + 'studentclass/reseat_student/' + data + '/<?= $class_id ?>/' + $target.attr('id'));
    }

    function hover(ele, show) {
        if (!$(ele).hasClass('has-student') && !$(ele).hasClass('no-drag')) {
            var className = 'hovered';
            $('#seatplan td.hovered').removeClass(className);
            if (show) {
                $(ele).addClass(className);
            }
        }
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
            $.get(BASE_URL + USER_PREFIX + 'studentclass/add_student/' + studentId + '/<?= $class_id ?>/' + currentSelectedChair, function (data) {
                data = JSON.parse(data);
                $selectedChair = $('#' + currentSelectedChair);
                $selectedChair.closest('td').addClass('has-student');
                $selectedChair.append('<div draggable="true" ondragstart="drag(event)" id="' + data.id + '" ' +
                    'class="' + data.gender + ' student"></div>');
            });

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