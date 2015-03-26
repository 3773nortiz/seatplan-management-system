<div ng-controller="StudentAttendanceCtrl">
	<div class="row no-print">
		<div class="col-md-12">
			<h2><button class="btn btn-default print" onclick="DownloadPDF()" disabled=""><span><i class="fa fa-print"></i></span> Print</button>
			</h2>
			<form id="form-download-file" action="http://spms.amaers.tk/getfile.php" method="POST" hidden>
                <input value="" type="text" name="url">
                <input value="" type="text" name="cacheid" ng-model="cacheid">
            </form>
		</div>
	</div>
	<div class="row no-print">
		<div class="col-md-12">
				<div class="col-md-4">
					<label>Class:</label>
					<div class="form-group course-list">
				        <?= Form::select('class_id', 0, Arr::assoc_to_keyval(Model_Class::getClassName($current_user->id), 'id', 'class_name'),
				            array('class'    => 'form-control')); ?>
					</div>
				</div>

				<div class="col-md-4">
					<label>Start Date:</label>
					<div class="input-daterange input-group" id="datepicker" style="width: 100%;">
					    <input type="text" class="input-sm form-control" name="start"  width="100%"/>
						<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
					</div>
				</div>

				<div class="col-md-4">
					<label>End Date:</label>
					<div class="input-daterange input-group" id="datepicker1" style="width: 100%;">
					    <input type="text" class="input-sm form-control" name="end" />
						<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
					</div>
				</div>
		</div>
	</div>

	<h2>Attendance Report</h2>
	<h5>Date: {{ datePrinted }}</h5>
	<h5>Class: {{ classname }}</h5>
	<?php if ($attendances): ?>
	<br/>
	<h3 class="noStudent" align="center"></h3>
	<table class="table table-striped attendance" ng-show="noStudent == true">
		<thead>
			<tr>
				<th>Name</th>
				<th>Attendance</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td></td>
				<td align="center" class="date" ng-repeat="range in ranges"> {{ range.months }}/{{ range.date }}/{{ range.year }}</td>
			</tr>
			<tr ng-repeat="studList in studLists" id="attendance-list">
				<td class="name">{{studList.attendances[0].lname}}, {{studList.attendances[0].fname}} {{studList.attendances[0].mname[0]}}.</td>
				<td align="center" ng-repeat="range in ranges" ng-class="{'colorStat':getStatusValue(studList, range) != 'N/A'}"  data-toggle="tooltip" data-placement="top" title="{{getReason(studList, range)}}" class="ng-tooltip">{{getStatusValue(studList, range)}}</td>
			</tr>
		</tbody>
	</table>

	<?php else: ?>
	<p>No Attendances.</p>

	<?php endif; ?><p>
	</p>
</div>

<script>
    function DownloadPDF () {
        $('#form-download-file [name="url"]').val(window.location.href);
        $('#form-download-file').submit();
    }
</script>