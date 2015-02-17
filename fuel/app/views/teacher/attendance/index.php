<div ng-controller="StudentAttendanceCtrl">
	<div class="row pull-right">
		<div class="col-md-6">
			<div class="input-daterange input-group" id="datepicker">
			    <input type="text" class="input-sm form-control" name="start" />
				<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
			    <!--
			    <span class="input-group-addon">to</span>
			    <input type="text" class="input-sm form-control" name="end" />
			    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	 -->		</div>
		</div>

		<div class="col-md-6 pull-right">
			<div class="form-group course-list">
			        <?= Form::select('class_id', 0, Arr::assoc_to_keyval(Model_Class::getClassName($current_user->id), 'id', 'class_name'),
			            array('class'    => 'form-control')); ?>
			</div>
		</div>
	</div>


	<?php if ($attendances): ?>
	<table class="table table-striped attendance">
		<thead>
			<tr>
				<th>Name</th>
				<th>Attendance</th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="studList in studLists">
				<td ng-show="studList > 0">{{noStudent}}</td>
				<td>{{studList.fname}} {{studList.mname[0]}} {{studList.lname}}</td>
				<td>{{getStatusValue(studList.status)}}</td>
			</tr>
		</tbody>
	</table>

	<?php else: ?>
	<p>No Attendances.</p>

	<?php endif; ?><p>
	</p>
</div>