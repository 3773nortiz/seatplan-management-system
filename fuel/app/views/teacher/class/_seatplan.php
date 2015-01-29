<div class="col-md-12" id="seatplan-parent">
    <table class="table table-bordered" id="seatplan">
        <?php
            $yCoord = 'A';
            $chairPlan = json_decode(html_entity_decode($class->chair_plan ?: '{}'));
        ?>
        <?php for($x = 0; $x < Config::get('number_of_seat') / 10; $x++, $yCoord++): ?>
                <tr>
                <?php $xCoord = 1; ?>
                <?php for($y = 0; $y < 11; $y++, $xCoord++): ?>
                    <?php
                        $coord = '';
                        $coord = $yCoord . $xCoord;
                        $hasChair = !empty($chairPlan->{$coord});
                        $hasStudent = !empty($student_seats[$coord]);
                    ?>
                    <td ondrop="drop(event)" ondragover="allowDrop(event)" onclick="showAddStudent('<?= $coord ?>')" id="<?= $coord ?>"
                        class="<?= ($hasStudent && $hasChair ? ' has-student' : '') . ($hasChair ? ' has-chair' : '') ?>"
                        onmouseover="hover(this, true)" onmouseout="hover(this, false)">
                        <?php if ($hasChair) : ?>
                            <div draggable="true" ondragstart="drag(event)" ondrop="drop(event)" ondragover="allowDrop(event)" class="chair" id="chair_<?= $coord ?>">
                            </div>
                        <?php endif ?>
                        <?php if ($hasChair && $hasStudent) : ?>
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
            <br/>

            <?= Form::open(array('action' => '',
                    'method' => 'post',
                    'role'   => 'form',
                    'id'     => 'form-add-student-in-seat',
                    'onsubmit' => 'addChair(event)'));
                ?>

                <select class="form-control" name="select1" 
                id="select1" ng-show="student.length > 0">
                    <option ng-repeat="student in students" value="{{student.id}}">
                        <span>{{student.fname}} {{student.mname}} {{student.lname}}</span>
                    </option>
                </select>

                 <span ng-if="students.length <= 0">No Student</span>

                <br/><br/><br/>
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

<div class="modal fade bs-example-modal-sm" id="add-chair" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="exampleModalLabel">Add Chair</h4>
        </div>
        <div class="modal-body">
            <?= Form::open(array('action' => '',
                    'method' => 'post',
                    'role'   => 'form',
                    'id'     => 'form-add-student-in-seat',
                    'onsubmit' => 'addStudentPerSeat(event)'));
                ?>

                <div class="row">
                    <div class="col-md-12"> 
                    <div class="form-group">
                        <div class="col-md-6">
                            <?php echo Form::submit('submit', 'Add', array(
                                    'class'   => 'btn btn-primary add-chair-action'));
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo Form::submit('button', 'Close', array(
                                'class'        => 'btn btn-primary add-student-close',
                                'data-dismiss' => 'modal')); ?>
                        </div>
                    </div>
                </div>
                </div>
        </div>
    </div>
  </div>
</div>

<script>
    var classId  = '<?= $class->id ?>';
    var chairPlan = JSON.parse('<?= html_entity_decode($class->chair_plan ?: "{}") ?>');
    var currentSelectedChair;
    var dragFromId;
    var draggedId;

    function allowDrop(ev) {
        ev.preventDefault();
        $('#seatplan td.drag-over').removeClass('drag-over').removeClass('no-drag');
        $target = $(ev.target);

        var isChair = false;
        if ($target.is('.chair')) {
            $target = $target.closest('td');
            isChair = true;
        }

        if ($target.is('td') || $target.attr('id') == draggedId) {
            $target.addClass('drag-over');
        }

        if (!isChair && $('#' + draggedId).is('.student')) {
            $target.addClass('no-drag');
        }

    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
        dragFromId = $(ev.target).closest('td').attr('id');
        draggedId = ev.target.id;
    }

    function drop(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        var isChair = false;
        $target = $(ev.target);
        if ($target.is('.chair')) {
            isChair = true;
            $target = $target.closest('td');
        }
        $target.removeClass('drag-over');
        $('#' + data).removeClass('drag-over');
        if ($target.hasClass('no-drag') || !$target.attr('ondrop') || $target.hasClass('has-student') || (!$target.hasClass('has-chair') && $('#' + data).is('.student'))) {
            return false;
        }

        if (isChair) {
            $target[0].appendChild(document.getElementById(data));
        } else {
        ev.target.appendChild(document.getElementById(data));
            $('#' + data).attr('id', 'chair_' + $target.attr('id'));
        }


        if (isChair) {
            $.get(BASE_URL + USER_PREFIX + 'studentclass/reseat_student/' + data + '/<?= $class->id ?>/' + $target.attr('id'), function () {
            $target.addClass('has-student');
            $('#' + dragFromId).removeClass('has-student');
            });
        } else {
            chairPlan[$target.attr('id')] = 1;
            delete chairPlan[dragFromId];

            $.get(BASE_URL + USER_PREFIX + 'class/update_seatplan/<?= $class->id ?>/' + JSON.stringify(chairPlan), function (data) {
            $target.addClass('has-chair');
                $('#' + dragFromId).removeClass('has-chair').html('');
            });
        }
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
            if ($('#' + coord).hasClass('has-chair') && !$('#' + coord).hasClass('has-student')) {
                $('#add-student').modal('show');
            } else if (!$('#' + coord).hasClass('has-chair')) {
                $('#add-chair').modal('show');
            } else {
                // show view student, attendance nuttons x3, and remove
            }
        }
        currentSelectedChair = coord;
    }

    function attendace(stat) {

    }

    function addStudent(studentId) {
        if (currentSelectedChair) {
            $.get(BASE_URL + USER_PREFIX + 'studentclass/add_student/' + studentId + '/<?= $class->id ?>/' + currentSelectedChair, function (data) {
                data = JSON.parse(data);
                $selectedChair = $('#' + currentSelectedChair);
                $selectedChair.closest('td').addClass('has-student');
                $selectedChair.append('<div draggable="true" ondragstart="drag(event)" id="' + data.id + '" ' +
                    'class="' + data.gender + ' student"></div>');
            });

        }
    }

    function addChair(e) {
        e.preventDefault();
        if (currentSelectedChair) {
            chairPlan[currentSelectedChair] = 1;

            $.get(BASE_URL + USER_PREFIX + 'class/update_seatplan/<?= $class->id ?>/' + JSON.stringify(chairPlan), function (data) {
                data = JSON.parse(data);
                $selectedChair = $('#' + currentSelectedChair);
                $selectedChair.addClass('has-chair');
                $selectedChair.append('<div draggable="true" ondragstart="drag(event)" ondrop="drop(event)" ondragover="allowDrop(event)" class="chair"' +
                    'id="chair_' + currentSelectedChair + '"></div>');
                $('#add-chair').modal('hide');
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

        $('body').mousemove(function(event) {
            cx = Math.ceil($('body').width() / 2.0);
            cy = Math.ceil($('body').height() / 2.0);
            dx = event.pageX - cx;
            dy = event.pageY - cy;

            tiltx = (dy / cy);
            tilty = - (dx / cx);
            radius = Math.sqrt(Math.pow(tiltx,2) + Math.pow(tilty,2));
            degree = (radius * 20);

            $('#seatplan').css('-webkit-transform','rotate3d(' + tiltx + ', ' + tilty + ', 0, ' + degree + 'deg)');
        });
    });
</script>