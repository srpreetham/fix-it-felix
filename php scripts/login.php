<?php 
	$sql='';
	// connect to database
	$conn=mysqli_connect('localhost','preet','test1234','dbms');

	//check connection
	if(!$conn){
		echo 'Connecion error: '.mysqli_connect_error();
	}
	


	$email=$password='';
	$errors=array('email'=>'', 'password'=>'');

	if(isset($_POST['submit'])){
		// check email
		if(empty($_POST['email'])){
			$errors['email']='An email is required';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$errors['email']='Email must be a valid email address';
			}
		}

		// check password
		if(empty($_POST['password'])){
			$errors['password']='A password is required';
		} else{
			$password = $_POST['password'];
		}

	}

	// write query
		if(!empty($_POST['kind'])){

			$answer = $_POST['kind'];
			if($answer=="user"){
				$sql = 'SELECT u_email, u_password from user';
			}
			if($answer=="con"){
				$sql = 'SELECT c_email, c_password from contractor';
			}
			if($answer=="auth"){
				$sql = 'SELECT a_email, a_password from authority';
			}

			// make query and get result
		$result=mysqli_query($conn,$sql);

		//fetch the resulting rows as an ASSOCIATIVE array
		$account=mysqli_fetch_all($result,MYSQLI_ASSOC);

		print_r($account);

		//free result from memory
		mysqli_free_result($result);

		//close connection
		mysqli_close($conn);

		
		}
		
 ?>



 <!DOCTYPE html>
 <html>
<?php include('templates/header_two.php') ?>

<div class="container ">
			<div class="row white-text">
					<h5>Select Type:</h5>
					<form>
						<p>
					      <label>
					        <input name="kind" type="radio" value="user" checked />
					        <span class="white-text">User</span>
					      </label>
					    </p>
					    <p>
					      <label>
					        <input name="kind" type="radio" value="con" />
					        <span class="white-text">Contractor</span>
					      </label>
					    </p>
					    <p>
					      <label>
					        <input name="kind" type="radio"  value="auth" />
					        <span class="white-text">Authority</span>
					      </label>
					    </p>
					</form>
			</div>
		</div>

<section class="container white-text">
	<h5>Log-in</h5>
	<form class="white" action="login.php" method="POST" enctype="multipart/form-data">

		<label>Email:</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
			<div class="red-text"><?php echo $errors['email'] ?>
			</div>

		<label for="pwd">Password:</label>
			<input type="password" id="pwd" name="password" value="<?php echo htmlspecialchars($password)?>">
			<div class="red-text"><?php echo $errors['password'] ?>
			</div>

		

		<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
		</div>
	</form>
</section>
<?php include('templates/footer.php') ?>
 </html>