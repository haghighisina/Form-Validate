<?php
function is_required($field, $preg=false, $preg_comment=false){
	if ($_SERVER["REQUEST_METHOD"] == "POST")
		if( !@$_POST[$field]){
			return "<span class='error'>$field is required</span>";
		}
		else if($preg){
			$parameter = test_input($_POST[$field]);
			if (!preg_match($preg,$parameter))
				return "<span class='error'>$preg_comment</span>";
		}
}
function is_email($field){
	if ($_SERVER["REQUEST_METHOD"] == "POST")
		if( @$_POST[$field]){
			$parameter = test_input($_POST[$field]);
			if (!filter_var($parameter,FILTER_VALIDATE_EMAIL))
				return "<span class='error'>invalid email format</span>";
		}
}

function test_input($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} ?>
<style>.error{color: red; font-size:small}</style>
<form method="post">
	<div>
		<label>Name :</label><input type="text" name="name">
		<?= is_required('name', "/^[a-zA-Z ]*$/", 'only letters and valid words') ?>
	</div>
	<div>
		<label>Email :</label><input type="text" name="email">
		<?= is_required('email') ?><?= is_email('email') ?>		
	</div>
	<div>
		<label>Website :</label><input type="text" name="website">
		<?= is_required('website', "/^[a-zA-Z ]*$/", 'invalid url'); ?>
	</div>
	<div>
		<label>Comment :</label><textarea name="comment" rows="5" cols="30"></textarea>
		<?= is_required('comment') ?>
	</div>
	<div>
		<label>Gender :</label><input type="radio" name="gender" value="female">female <input type="radio" name="gender" value="male">male
		<?= is_required('gender') ?>
	</div>
	<div><input type="submit" name="submit" value="submit"></div>
</form>