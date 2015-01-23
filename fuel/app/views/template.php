<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<?php echo Asset::css([
		'bootstrap.css',
		'http://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css',
		'fm.selectator.jquery.css',
		'styles.css'
	]); ?>
	<style>
		body { margin: 50px; }
	</style>
	<?php echo Asset::js(array(
		'jquery.min.js',
		'bootstrap.js',
		'http://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js',
		'fm.selectator.jquery.js'
	)); ?>
	<script>
		$(function(){
			$('.topbar').dropdown();
			$(".fileinput").fileinput();
		});

		var BASE_URL = '<?= Config::get("base_url") ?>';
		var USER_PREFIX = '<?= Controller_Base::get_prefix(); ?>';
	</script>
</head>
<body>

	<?php if ($current_user): ?>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Seat Plan Management System</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="<?php echo Uri::segment(2) == '' ? 'active' : '' ?>">
						<?php echo Html::anchor('account', 'Dashboard');?>
					</li>

					<?php
						$files = new GlobIterator(APPPATH.'classes/controller/' . Controller_Base::get_prefix() . '/*.php');
						foreach($files as $file)
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
							$userTypes = array();
							foreach (Config::get('simpleauth.groups') as $key => $value) {
		                        if($key < Auth::get($current_user->group))
		                        	$userTypes[$key] = $value['name'];
		                    }
						?>

						<a data-toggle="dropdown" class="dropdown-toggle" href="#"><?= Config::get('simpleauth.groups')[$current_user->group]['name'] ?> <b class="caret"></b></a>
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
					<div class="col-md-4">
						<?= Asset::img(Config::get('base_url').'uploads/'.$current_user->prof_pic, array(
				            'class' => 'img-responsive',
				            'width' => '200px',
				        	)); ?>
						<h4>
					            <?= $current_user->fname.'&nbsp;&nbsp'.
					            $current_user->mname[0].'.&nbsp;&nbsp'.
					            $current_user->lname .'<br/>'.
					            $current_user->email .'<br/>'.
					           	Config::get('gender')[$current_user->gender] . '<br/>' .
					           	$current_user->address .' <br/> '.
					           	$current_user->contact;
					           	?>
				        </h4>
					</div>
				<?php endif; ?>

				<?php echo $content; ?>
				</div>
			</div>
		</div>
		<hr/>
		<footer>
			<p class="pull-right">Page rendered in {exec_time}s using {mem_usage}mb of memory.</p>
			<p>
				<a href="http://fuelphp.com">FuelPHP</a> is released under the MIT license.<br>
				<small>Version: <?php echo e(Fuel::VERSION); ?></small>
			</p>
		</footer>
	</div>
</body>
</html>
