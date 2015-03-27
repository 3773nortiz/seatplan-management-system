<?php if ($scenario != 'edit') : ?>
<style type="text/css">
    #seatplan td .before {
        display: none;
    }
</style>
<?php endif; ?>

<div id="seatplan-parent" class="<?= $scenario ?>">
    <div id="seatplan">
        <div class="col-md-12 board position<?= $class->board_position ?>">
            <?php $class_position = Config::get('class_position'); ?>
            <?php if (in_array($class->board_position, [$class_position['top'], $class_position['topleft'], $class_position['topright']])) : ?>
            <button class="board-actions" onclick="moveBoard('board', 'bottom')"><span class="glyphicon glyphicon-circle-arrow-down"></span></button>
            <button class="board-actions left" onclick="moveBoard('board', 'left')"><span class="glyphicon glyphicon-circle-arrow-left"></span></button>
            <button class="board-actions right" onclick="moveBoard('board', 'right')"><span class="glyphicon glyphicon-circle-arrow-right"></span></button>
            <?= Asset::img('board.png') ?>
            <?php endif; ?>
        </div>
        <div class="col-md-12 desk position<?= $class->table_position ?>">
            <?php if (in_array($class->table_position, [$class_position['top'], $class_position['topleft'], $class_position['topright']])) : ?>
            <button class="board-actions" onclick="moveBoard('desk', 'bottom')"><span class="glyphicon glyphicon-circle-arrow-down"></span></button>
            <button class="board-actions left" onclick="moveBoard('desk', 'left')"><span class="glyphicon glyphicon-circle-arrow-left"></span></button>
            <button class="board-actions right" onclick="moveBoard('desk', 'right')"><span class="glyphicon glyphicon-circle-arrow-right"></span></button>
            <?= Asset::img('table.png') ?>
            <?php endif; ?>
        </div>
        <table class="table table-bordered col-md-12">
            <?php
                $yCoord = 'A';
                $chairPlan = json_decode(html_entity_decode($class->chair_plan ?: '{}'));
            ?>
            <?php for($x = 0; $x < Config::get('number_of_seat') / 8; $x++, $yCoord++): ?>
                    <tr>
                    <?php $xCoord = 1; ?>
                    <?php for($y = 0; $y < 11; $y++, $xCoord++): ?>
                        <?php
                            $coord = '';
                            $coord = $yCoord . $xCoord;
                            $hasChair = !empty($chairPlan->{$coord});
                            $hasStudent = !empty($student_seats[$coord]);
                        ?>
                        <td <?= $scenario == 'edit' ? 'ondrop="drop(event)" ondragover="allowDrop(event)"' : '' ?> id="<?= $coord ?>"
                            class="<?= ($hasStudent && $hasChair ? ' has-student' : '') . ($hasChair ? ' has-chair' : '') ?>"
                            onmouseover="hover(this, true)" onmouseout="hover(this, false)">
                            <?php if ($hasChair) : ?>
                                <div <?= $scenario == 'edit' ? 'draggable="true" ondragstart="drag(event)" ondrop="drop(event)" ondragover="allowDrop(event)"' : '' ?> class="chair" id="chair_<?= $coord ?>">
                                </div>
                            <?php endif ?>
                            <?php if ($hasChair && $hasStudent) : ?>
                                <div <?= $scenario == 'edit' ? 'draggable="true" ondragstart="drag(event)"' : '' ?> id="<?= $student_seats[$coord]['user_id'] ?>"
                                    class="<?= Config::get('gender')[$student_seats[$coord]['gender']] ?> student">
                                </div>
                                <?php if ($student_seats[$coord]['status'] && !empty(Config::get('attendace_stat')[$student_seats[$coord]['status']])) : ?>
                                    <span class="attendance-indicator <?= Config::get('attendace_stat')[$student_seats[$coord]['status']]['buttonStyle'] ?>"></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    <?php endfor; ?>
                    </tr>
            <?php endfor; ?>
        </table>

        <div class="col-md-12 desk position<?= $class->table_position ?>">
            <?php if (in_array($class->table_position, [$class_position['bottom'], $class_position['bottomleft'], $class_position['bottomright']])) : ?>
            <button class="board-actions" onclick="moveBoard('desk', 'top')"><span class="glyphicon glyphicon-circle-arrow-up"></span></button>
            <button class="board-actions left" onclick="moveBoard('desk', 'left')"><span class="glyphicon glyphicon-circle-arrow-left"></span></button>
            <button class="board-actions right" onclick="moveBoard('desk', 'right')"><span class="glyphicon glyphicon-circle-arrow-right"></span></button>
            <?= Asset::img('table.png') ?>
            <?php endif; ?>
        </div>
        <div class="col-md-12 board position<?= $class->board_position ?>">
            <?php $class_position = Config::get('class_position'); ?>
            <?php if (in_array($class->board_position, [$class_position['bottom'], $class_position['bottomleft'], $class_position['bottomright']])) : ?>
            <button class="board-actions" onclick="moveBoard('board', 'top')"><span class="glyphicon glyphicon-circle-arrow-up"></span></button>
            <button class="board-actions left" onclick="moveBoard('board', 'left')"><span class="glyphicon glyphicon-circle-arrow-left"></span></button>
            <button class="board-actions right" onclick="moveBoard('board', 'right')"><span class="glyphicon glyphicon-circle-arrow-right"></span></button>
            <?= Asset::img('board.png') ?>
            <?php endif; ?>
        </div>
    </div>
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
                    'onsubmit' => 'addStudentPerSeat(event)'));
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
                                'class'    => 'btn btn-primary add-student-action'));
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
                    'onsubmit' => 'addChair(event)'));
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
            <?= Form::close(); ?>
        </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-sm" id="view-student" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title <?= $scenario == 'edit' ? 'pull-left' : '' ?>" id="exampleModalLabel">Add Chair</h4>
            <?php if ($scenario == 'edit') : ?>
            <button class="btn btn-danger" onclick="removeStudent()">Remove Student</button>
            <?php endif; ?>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-5">
                    <img class="img-responsive img-thumbnail img-responsive" width="200" src="<?= Config::get('base_url').'uploads/'. $current_user->prof_pic ?>" />
                </div>
                <div class="col-md-7">
                    <h4 class="username"><?= $current_user->username ?></h4>
                    <h4 class="email"><?= $current_user->email ?></h4>
                    <p class="bdate"><?= Date::forge($current_user->bdate)->format("%B %d, %Y", true) ?></p>
                    <p class="gender"><?= Config::get('gender')[$current_user->gender] ?></p>
                    <p class="address"><?= $current_user->address ?></p>
                    <p class="contact"><?= $current_user->contact ?></p>
                </div>
            </div>
            <br>
            <div class="row action-attendance">
                <?php foreach (Config::get('attendace_stat') as $key => $value): ?>
                    <div class="col-md-4 text-center">
                        <div class="btn-holder" id="<?= $value['id'] ?>">
                            <button class="btn <?= $value['buttonStyle'] ?>" data-toggle="tooltip" data-placement="top" title="<?= $value['name'] ?>"
                                onclick="setAttendance('<?= $key ?>')"><?= $value['name'][0] ?></button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <?php echo Form::submit('button', 'OK', array(
                        'class'        => 'btn btn-primary btn-block md-close',
                        'data-dismiss' => 'modal')); ?>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-sm" id="late-reason" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Reason for Late</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo Form::input('reason', '', array('class' => 'form-control', 'placeholder'=>'Type in a reason')); ?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <?php echo Form::submit('button', 'OK', array(
                            'onclick'      => 'setAttendance(2, true)',
                            'class'        => 'btn btn-primary btn-block md-close',
                            'data-dismiss' => 'modal')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var classId  = '<?= $class->id ?>';
    var chairPlan = JSON.parse('<?= html_entity_decode($class->chair_plan ?: "{}") ?>');
    var studentSeats = JSON.parse('<?= Format::forge($student_seats)->to_json(); ?>');
    var attendanceStat = JSON.parse('<?= Format::forge(Config::get("attendace_stat"))->to_json() ?>');
    var gender = JSON.parse('<?= Format::forge(Config::get("gender"))->to_json() ?>');
    var currentSelectedChair;
    var dragFromId;
    var draggedId;
    var chairRemoved = false;
    var currentViewedCoord;
    var setDraggingTimeout;

    function allowDrop(ev) {
        ev.preventDefault();
        $('#seatplan td.drag-over').removeClass('drag-over');
        $('#seatplan td.no-drag').removeClass('no-drag');
        $target = $(ev.target);

        var isChair = false;
        if ($target.is('.chair')) {
            $target = $target.closest('td');
            isChair = true;
        }

        if ($target.is('td') || $target.attr('id') == draggedId) {
            $target.addClass('drag-over');
        }

        if ((!isChair && $('#' + draggedId).is('.student')) || (isChair && $('#' + draggedId).is('.chair'))) {
            $target.addClass('no-drag');
        }

    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
        $target = $(ev.target);
        dragFromId = $target.closest('td').attr('id');
        draggedId = ev.target.id;

        if ($target.is('.chair')) {
            $dragImg = $target.closest('td');
            setDraggingTimeout = setTimeout(function () {
                $dragImg.addClass('dragging');
            }, 50);
            $dragImg.find('.before').remove();
            ev.dataTransfer.setDragImage($dragImg[0], ev.offsetX, ev.offsetY);
        }
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
        if (setDraggingTimeout) {
            clearTimeout(setDraggingTimeout);
        }
        $('#' + data).removeClass('drag-over').closest('td').removeClass('dragging');
        if ($target.hasClass('no-drag') || !$target.attr('ondrop') || $target.hasClass('has-student')) {
            setTimeout(function () {
                $target.removeClass('no-drag');
            }, 50);
            return false;
        }

        if (isChair) {
            $target[0].appendChild(document.getElementById(data));
        } else {
            ev.target.appendChild(document.getElementById(data));
            $('#' + data).attr('id', 'chair_' + $target.attr('id'));
        }


        if (isChair) {
            $target.addClass('has-student');
            if (studentSeats[dragFromId].status) {
                $target.append('<span class="attendance-indicator ' + attendanceStat[studentSeats[dragFromId].status].buttonStyle + '"></span>');
            }
            $('#' + dragFromId).removeClass('has-student');
            studentSeats[$target.attr('id')] = studentSeats[dragFromId];
            delete studentSeats[dragFromId];
            $('#' + dragFromId + ' ' + '.nameTag').remove();
            $('#' + dragFromId + ' ' + '.attendance-indicator').remove();

            $.get(BASE_URL + USER_PREFIX + 'studentclass/reseat_student/' + data + '/<?= $class->id ?>/' + $target.attr('id'), function () {

            });
        } else {
            chairPlan[$target.attr('id')] = 1;
            delete chairPlan[dragFromId];

            $target.addClass('has-chair');
            $('#' + dragFromId).removeClass('has-chair').html('');
            $.get(BASE_URL + USER_PREFIX + 'class/update_seatplan/<?= $class->id ?>/' + JSON.stringify(chairPlan), function (data) {

            });
        }
    }

    function hover(ele, show) {
        <?php if ($scenario == 'edit') : ?>
        if (!$(ele).hasClass('has-student') && !$(ele).hasClass('no-drag')) {
            var className = 'hovered';
            $('#seatplan td.hovered').removeClass(className);
            if (show) {
                $(ele).addClass(className);
            }
        }


        $a = $(ele).find('.before');
        if ($(ele).hasClass('has-chair') && !$(ele).hasClass('has-student') && show && $a.length <= 0) {
            $(ele).append('<a class="before">×</a>');
        } else {
            if ($($a.selector + ':hover').length <= 0) {
                $a.remove();
            }
        }
        <?php endif; ?>

        $nameTag = $(ele).find('.nameTag');
        var studentSeat = studentSeats[$(ele).attr('id')];
        if ($(ele).hasClass('has-chair') && $(ele).hasClass('has-student') && show && $nameTag.length <= 0) {
            $(ele).append('<a class="nameTag">' + studentSeat['fname'] + ' ' + studentSeat['mname'][0] + '. ' + studentSeat['lname'] + '</a>');
        } else {
            if ($($nameTag.selector + ':hover').length <= 0) {
                $nameTag.remove();
            }
        }
    }

    function viewStudent(coord) {
        chairRemoved = true;

        currentViewedCoord = coord;
        var studId = studentSeats[coord].user_id;

        $.get(BASE_URL + USER_PREFIX + 'users/get_student/' + studId, function (data) {
            $modal = $('#view-student');
            var data = JSON.parse(data);

            $modal.find('.modal-title').html(data.fname + ' ' + data.mname[0] + '. ' + data.lname);
            $modal.find('.action-attendance .btn-holder.current').removeClass('current')
                .find('button').removeClass('disabled');
            if (studentSeats[coord].status) {
                console.log(attendanceStat[studentSeats[coord].status].id);
                $modal.find('.action-attendance .btn-holder#' + attendanceStat[studentSeats[coord].status].id).addClass('current')
                    .find('button').addClass('disabled');
            }
            console.log(data);
            $modal.find('.img-thumbnail').attr('src', BASE_URL + UPLOADS_PATH + data.prof_pic);
            $modal.find('.username').html(data.username);
            $modal.find('.email').html(data.email);
            $modal.find('.bdate').html(new Date(data.bdate * 1000).toLocaleDateString('en-US', {
                timeZone: "UTC",
                year: "numeric",
                month: "long",
                day: "numeric"
            }));
            $modal.find('.gender').html(gender[data.gender]);
            $modal.find('.address').html(data.address);
            $modal.find('.contact').attr(data.contact);
            $modal.modal('show');

            console.log(data);

        });
    }

    function removeStudent () {
        $.get(BASE_URL + USER_PREFIX + 'studentclass/reseat_student/' + studentSeats[currentViewedCoord]['user_id'] + '/<?= $class->id ?>', function () {
            $('#' + currentViewedCoord).removeClass('has-student');
            $('#' + currentViewedCoord + ' ' + '.nameTag').remove();
            $('#' + currentViewedCoord + ' ' + '.student').remove();
            $('#' + currentViewedCoord + ' ' + '.attendance-indicator').remove();
            angular.element('[ng-controller="AddStudentCtrl"]').scope().removeStudent(studentSeats[currentViewedCoord]);
            delete studentSeats[currentViewedCoord];
            $('#view-student').modal('hide');
        });
    }

    function setAttendance (key, isReasoned) {
        var reason = '';
        if (key == 2) {
            if (!isReasoned) {
                $('#late-reason').modal('show');
                $('#late-reason').find('[name="reason"]').val('');
                return;
            } else if (isReasoned) {
                reason = $('#late-reason').find('[name="reason"]').val();
            }
        }

        $.get(BASE_URL + USER_PREFIX + 'attendance/set_attendace/' + studentSeats[currentViewedCoord]['id'] + '/' + key + '/' + reason, function (data) {
            console.log($('#' + currentViewedCoord + ' attendance-indicator'));

            if (studentSeats[currentViewedCoord].status) {
              $('#' + currentViewedCoord + ' .attendance-indicator')
                .removeClass(attendanceStat[studentSeats[currentViewedCoord].status].buttonStyle)
                .addClass(attendanceStat[key].buttonStyle);
            } else {
                $('#' + currentViewedCoord).append('<span class="attendance-indicator ' + attendanceStat[key].buttonStyle + '"></span>');
            }

            $('#view-student .action-attendance .btn-holder.current').removeClass('current').find('button').removeClass('disabled');
            $('#' + attendanceStat[key].id).addClass('current').find('button').addClass('disabled');
            studentSeats[currentViewedCoord].status = key;
        });
    }

    function removeChair(coord) {
        chairRemoved = true;

        delete chairPlan[coord];
        $.get(BASE_URL + USER_PREFIX + 'class/update_seatplan/<?= $class->id ?>/' + JSON.stringify(chairPlan), function (data) {
            $td = $('#' + coord);
            $td.find('.chair').remove();
            $td.removeClass('has-chair');
        });
    }

    function showAddStudent(coord) {
        if (coord && !chairRemoved) {
            if ($('#' + coord).hasClass('has-chair') && !$('#' + coord).hasClass('has-student')) {
                $('#add-student').modal('show');
            } else if (!$('#' + coord).hasClass('has-chair')) {
                $('#add-chair').modal('show');
            } else {
                // show view student, attendance nuttons x3, and remove
            }
        }
        currentSelectedChair = coord;
        chairRemoved = false;
    }

    function attendace(stat) {

    }

    function addStudent(studentId) {
        if (currentSelectedChair) {
            $.get(BASE_URL + USER_PREFIX + 'studentclass/add_student/' + studentId + '/<?= $class->id ?>/' + currentSelectedChair, function (data) {
                data = JSON.parse(data);
                $selectedChair = $('#' + currentSelectedChair);
                $selectedChair.closest('td').addClass('has-student');
                $selectedChair.append('<div draggable="true" ondragstart="drag(event)" id="' + data.user_id + '" ' +
                    'class="' + gender[data.gender] + ' student"></div>');
                console.log(data);
                studentSeats[currentSelectedChair] = data;
                angular.element('[ng-controller="AddStudentCtrl"]').scope().addStudent(studentId);
                $('#add-student').modal('hide');
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
    }

    function moveBoard (type, direction) {
        var boardPos = '<?= array_search($class->board_position, Config::get("class_position")) ?>';
        var tablePos = '<?= array_search($class->table_position, Config::get("class_position")) ?>';
        var pos = type == 'board' ? boardPos : tablePos;
        console.log(tablePos);

        if (direction == 'top') {
            direction = pos.replace('bottom', 'top');
        } else if (direction == 'bottom') {
            direction = pos.replace('top', 'bottom');
        } else if (direction == 'left') {
            if (pos.endsWith('right')) {
                direction = pos.replace('right', '');
            } else if (pos.endsWith('left')) {

            } else {
                direction = pos + 'left';
            }
        } else if (direction == 'right') {
            if (pos.endsWith('left')) {
                direction = pos.replace('left', '');
            } else if (pos.endsWith('right')) {

            } else {
                direction = pos + 'right';
            }
            console.log(pos);
        }

        $.get(BASE_URL + USER_PREFIX + 'class/moveboard/<?= $class->id ?>/' + type + '/' + direction, function () {
            window.location.reload();
        });
    }

    $(function () {
        console.log(studentSeats);
        $('#select1').selectator();

        $('body').mousemove(function(event) {
            cx = Math.ceil($('body').width() / 2.0);
            cy = Math.ceil($('body').height() / 2.0);
            dx = event.pageX - cx;
            dy = event.pageY - cy;

            var factor = .55;
            tiltx = (dy / cy) * factor;
            tilty = - (dx / cx) * factor;
            radius = Math.sqrt(Math.pow(tiltx,2) + Math.pow(tilty,2));
            degree = (radius * 20);

            $('#seatplan').css('-webkit-transform','rotate3d(' + tiltx + ', ' + tilty + ', 0, ' + degree + 'deg)');
        });

        $('#seatplan')
            .on('click', '.before', function (e) {
                removeChair($(this).closest('td').attr('id'));
            })
            .on('click', '.nameTag', function (e) {
                viewStudent($(this).closest('td').attr('id'));
            })
            <?php if ($scenario == 'edit') : ?>
            .on('click', 'td', function () {
                showAddStudent(this.id);
            })
            <?php endif; ?>
            .on('mousedown', '.chair', function () {
                $(this).closest('td').removeClass('hovered');
            });

        $('#view-student .action-attendance button').tooltip();
    });
</script>