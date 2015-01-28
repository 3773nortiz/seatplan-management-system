<div class="col-md-12" style="-webkit-perspective: 5000;">
    <table class="table table-bordered" id="seatplan" style="-webkit-transform-style: preserve-3d;">
        <?php
            $yCoord = 'A';
            $chairPlan = json_decode(html_entity_decode($class->chair_plan));
        ?>
        <?php for($x = 0; $x < Config::get('number_of_seat') / 10; $x++, $yCoord++): ?>
                <tr>
                <?php $xCoord = 1; ?>
                <?php for($y = 0; $y < 11; $y++, $xCoord++): ?>
                    <?php
                        $coord = '';
                        $coord = $yCoord . $xCoord;
                    ?>
                    <td ondrop="drop(event)" ondragover="allowDrop(event)" onclick="showAddStudent('<?= $coord ?>')" id="<?= $coord ?>"
                        class="<?= (!empty($student_seats[$coord]) ? ' has-student' : '') . (!empty($chairPlan->{$coord}) ? ' has-chair' : '') ?>"
                        onmouseover="hover(this, true)" onmouseout="hover(this, false)">
                        <?php if (!empty($chairPlan->{$coord})) : ?>
                            <div draggable="true" ondragstart="drag(event)" ondrop="drop(event)" ondragover="allowDrop(event)" class="chair" id="chair_<?= $coord ?>"
                            style="-webkit-transform: translateZ(20px);">
                            <?php if (!empty($student_seats[$coord])) : ?>
                                <div draggable="true" ondragstart="drag(event)" id="<?= $student_seats[$coord]['user_id'] ?>"
                                class="<?= Config::get('gender')[$student_seats[$coord]['gender']] ?> student" style="-webkit-transform: translateZ(30px);">

                                </div>
                            <?php endif; ?>
                            </div>
                        <?php endif ?>
                    </td>
                <?php endfor; ?>
                </tr>
        <?php endfor; ?>
    </table>
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
    var dragFromId;
    var draggedId;

    function allowDrop(ev) {
        ev.preventDefault();
        $('#seatplan td.drag-over').removeClass('drag-over');
        $target = $(ev.target);

        if ($target.is('.chair')) {
            $target = $target.closest('td');
        }


        if ($target.is('td') || $target.attr('id') == draggedId) {
            $target.addClass('drag-over');
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
        if ($target.hasClass('no-drag') || !$target.attr('ondrop') || $target.hasClass('has-student')) {
            return false;
        }

        ev.target.appendChild(document.getElementById(data));

        if (isChair) {
            $target.addClass('has-student');
            $('#' + dragFromId).removeClass('has-student');

            $.get(BASE_URL + USER_PREFIX + 'studentclass/reseat_student/' + data + '/<?= $class->id ?>/' + $target.attr('id'));
        } else {
            $target.addClass('has-chair');
            $('#' + dragFromId).removeClass('has-chair');

            // $.get(BASE_URL + USER_PREFIX + 'studentclass/reseat_student/' + data + '/<?= $class->id ?>/' + $target.attr('id'));
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
            if ($('#' + coord).hasClass('has-chair')) {
                $('#add-student').modal('show');
            } else {
                $('#add-chair').modal('show');
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

    function addChair() {

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