<!DOCTYPE html>
<html ng-app="spmsapp">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<?php echo Asset::css(array(
		'bootstrap.min.css',
		'datepicker3.css',
		'fm.selectator.jquery.css',
		'theme.css',
		'skins/default.css',
		'theme-custom.css',
		'fileinput.min.css',
		'styles.css',
	)); ?>

	<link rel="stylesheet" href="<?php echo Config::get('base_url') . 'assets/vendor/font-awesome/css/font-awesome.css'; ?>" />
	<style>
		body { margin: 50px; }
	</style>

	<script>
		var BASE_URL = '<?= Config::get("base_url") ?>';
		var USER_PREFIX = '<?= Controller_Base::get_prefix(); ?>';
		var USER_GROUP = '<?= json_encode(Auth::get("group"));?>';
		var IMAGES_PATH = '<?= Config::get("images_path") ?>';
		var UPLOADS_PATH = '<?= Config::get("uploads_path") ?>';
		var ATTENDANCE = JSON.parse('<?= Format::forge(Config::get("attendace_stat"))->to_json() ?>');
	</script>

	
	<script src="<?php echo Config::get('base_url') . 'assets/vendor/modernizr/modernizr.js'; ?>"></script>

	<?php echo Asset::js(array(
		'jquery.min.js',
		'bootstrap.min.js',
		'bootstrap-datepicker.js',
		'fm.selectator.jquery.js',
		'theme.js',
		'theme.custom.js',
		'theme.init.js',
		'angular.min.js',
		'angular/addstudentctrl.js',
		'angular/studentattendancectrl.js',
		'fileinput.min.js',
	)); ?>

	<script>
		$(function(){
			$('.topbar').dropdown();
			$('.datepicker').datepicker();		
		});
	</script>
</head>
<body>

	<?php if ($current_user): ?>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header no-print">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Seat Plan Management System</a>
			</div>
			<div class="navbar-collapse collapse no-print">
				<ul class="nav navbar-nav">
					<li class="<?php echo Uri::segment(2) == '' ? 'active' : '' ?>">
						<?php echo Html::anchor('account', 'Dashboard');?>
					</li>
					<?php
						$files = new GlobIterator(APPPATH.'classes/controller/' . Controller_Base::get_prefix() . '/*.php');
						foreach($files as $file) if (!Controller_Base::is_black_listed($file->getBasename('.php')))
						{
							$section_segment = $file->getBasename('.php');
							$section_title = Inflector::humanize($section_segment);
							?>
							<li class="<?php echo Uri::segment(2) == $section_segment ? 'active' : '' ?>">
								<?php echo Html::anchor(Controller_Base::get_prefix() . $section_segment, $section_title); ?>
							</li>
							<?php
						}
					?>
				</ul>
				<ul class="nav navbar-nav pull-right">
					<li class="dropdown">
						<?php
							//$userTypes = array();
							//foreach (Config::get('simpleauth.groups') as $key => $value) {
		                    //    if($key < $current_user->group)
		                    //    	$userTypes[$key] = $value['name'];
		                   // }

							// var_dump($current_user->group);
							// exit();
						?>

						<a data-toggle="dropdown" class="dropdown-toggle" href="#"><?= Config::get('simpleauth.groups')[$current_user->group]['name']; ?> <b class="caret"></b></a> 
						<ul class="dropdown-menu">
							<li>
							<?php echo Html::anchor(Controller_Base::get_prefix() . 'users/edit/'. $current_user->id, 'Edit Profile'); ?></li>
							<li><?php echo Html::anchor('users/logout', 'Logout') ?></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1><?php echo $title; ?></h1>
				<hr>
				<?php if (Session::get_flash('success')): ?>
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<p>
						<?php echo implode('</p><p>', (array) Session::get_flash('success')); ?>
						</p>
					</div>
				<?php endif; ?>

				<?php if (Session::get_flash('error')): ?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<p>
						<?php echo implode('</p><p>', (array) Session::get_flash('error')); ?>
						</p>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-md-12">
				<div class="row">
				<?php if($current_user && $title == 'Dashboard'): ?>
					<div class="col-md-3">
						<section class="panel">
							<div class="panel-body">
								<div class="thumb-info mb-md">
									<?= Asset::img('../../uploads/'.$current_user->prof_pic, array(
						            'class' => 'img-responsive rounded'
						        	)); ?>
									<div class="thumb-info-title">
										<span class="thumb-info-inner">
											<?= $current_user->fname.'&nbsp;&nbsp'.
									            $current_user->mname[0].'.&nbsp;&nbsp'.
									            $current_user->lname; ?>
										</span>
										<?php
											if($current_user->group == 50) {
												echo '<span class="thumb-info-type">'. Config::get('simpleauth.groups')[$current_user->group]['name']. '</span>';
											} else if ($current_user->group == 1) {
												echo '<span class="thumb-info-type">'. $current_user->username  . '</span>';
											}
										?>
									</div>
								</div>


								<hr class="dotted short"/>
								<h5 class="text-muted">About</h5>
								<div class="widget-toggle-expand mb-md">
									<ul class="simple-todo-list">
										<li><?= $current_user->email; ?></li>
										<li><?= Date::forge($current_user->bdate)->format("%B %d, %Y", true); ?></li>
										<li><?= Config::get('gender')[$current_user->gender];?></li>
										<li><?= ($current_user->yearlevel_id > 0 ? (Model_Yearlevel::getStudentYearLevel($current_user->yearlevel_id)) : ''); ?></li>
										<li><?= $current_user->address; ?></li>
										<li><?= $current_user->contact; ?></li>
									</ul>
								</div>
							</div>
						</section>
					</div>
				
				<?php endif; ?>

				<?php echo $content; ?>
				</div>
			</div>
		</div>
		<hr/>
		<footer>

		</footer>
	</div>
</body>
</html>

