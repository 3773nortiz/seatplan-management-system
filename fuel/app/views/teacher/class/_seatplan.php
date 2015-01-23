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
                    <td ondrop="drop(event)" ondragover="allowDrop(event)" onclick="showAddStudent('<?= $coord ?>')" id="<?= $coord ?>" class="<?= $y == 5 ? 'no-drag' : '' ?>"></td>
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

        }
        currentSelectedChair = coord;
        addStudent(1);
    }

    function addStudent(studentId) {
        if (currentSelectedChair) {
            $.get(BASE_URL + USER_PREFIX + 'studentclass/add_student/' + studentId + '/<?= $class_id ?>/' + currentSelectedChair);
        }
    }
</script>