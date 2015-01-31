<?= Asset::img("../../uploads/" .$user->prof_pic, array(
            "class" => "img-responsive",
            "width" => "200px",
            )); ?>
<br/>
<p>
	<strong>Name:</strong>
	<?php echo $user->fname .' '. $user->mname[0] .'. '. $user->lname; ?></p>
<p>
	<strong>Email:</strong>
	<?php echo $user->email; ?></p>
<p>
	<strong>Address:</strong>
	<?php echo $user->address; ?></p>
<p>
	<strong>Birth Date:</strong>
	<?php echo Date::forge($user->bdate)->format("%B %d, %Y", true); ?></p>
<p>
	<strong>Gender:</strong>
	<?php echo Config::get('gender')[$user->gender]; ?></p>
<p>
	<strong>Contact:</strong>
	<?php echo $user->contact; ?></p>


<?php echo Html::anchor(Controller_Base::get_prefix() . 'users', 'Back'); ?>