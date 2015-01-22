<h2>Viewing #<?php echo $user->id; ?></h2>

<p>
	<strong>Fname:</strong>
	<?php echo $user->fname; ?></p>
<p>
	<strong>Mname:</strong>
	<?php echo $user->mname; ?></p>
<p>
	<strong>Lname:</strong>
	<?php echo $user->lname; ?></p>
<p>
	<strong>Email:</strong>
	<?php echo $user->email; ?></p>
<p>
	<strong>Username:</strong>
	<?php echo $user->username; ?></p>
<p>
	<strong>Password:</strong>
	<?php echo $user->password; ?></p>
<p>
	<strong>Address:</strong>
	<?php echo $user->address; ?></p>
<p>
	<strong>Bdate:</strong>
	<?php echo $user->bdate; ?></p>
<p>
	<strong>Gender:</strong>
	<?php echo $user->gender; ?></p>
<p>
	<strong>Contact:</strong>
	<?php echo $user->contact; ?></p>
<p>
	<strong>Prof pic:</strong>
	<?php echo $user->prof_pic; ?></p>
<p>
	<strong>Group:</strong>
	<?php echo $user->group; ?></p>
<p>
	<strong>Last login:</strong>
	<?php echo $user->last_login; ?></p>
<p>
	<strong>Login hash:</strong>
	<?php echo $user->login_hash; ?></p>
<p>
	<strong>Profile fields:</strong>
	<?php echo $user->profile_fields; ?></p>

<?php echo Html::anchor(Controller_Base::get_prefix() . 'users/edit/'.$user->id, 'Edit'); ?> |
<?php echo Html::anchor(Controller_Base::get_prefix() . 'users', 'Back'); ?>