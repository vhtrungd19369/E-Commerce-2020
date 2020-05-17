<?php
	require_once "./inc/connectinc.php";
?>
<?php
	require_once "./inc/header.php";
	require_once "./inc/slider.php";
?>
<div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action="hello" method="get" id="member">
                	<input name="Domain" type="text" value="Username" class="field" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}">
                    <input name="Domain" type="password" value="Password" class="field" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
                 </form>
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                    <div class="buttons"><div><button class="grey">Sign In</button></div></div>
                    </div>
    	<div class="register_account">
    		<h3>Register New Account</h3>
    		<form>
		   		<table>
		   			<tbody>
						<tr>
							<td>
								<div>
								<input type="text" name="name" placeholder="Enter Name..." " >
								</div>
								
								<div>
								<input type="text" name="city" placeholder="Enter City..."">
								</div>
								
								<div>
									<input type="text" name="Zipcode" placeholder="Enter Zipcode..."">
								</div>
								<div>
									<input type="text" name="email" placeholder="Enter Email..."">
								</div>
							</td>
							
							<td>
								<!--------------------->
									<div>
										<input type="text" name="address" placeholder="Enter Address..."">
									</div>
								<!--------------------->
								<div>
									<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
										<option value="null">----Select a Country----</option>   

										<option value="AF">Afghanistan</option>
									</select>
								</div>		        
								<!--------------------->
								<div>
									<input type="text" name="phone" placeholder="Enter Address..."">
								</div>
							
								<div>
									<input type="text" name="password" placeholder="Enter Address..."">
								</div>
								<!--------------------->
							</td>
		    			</tr> 
						<!----------------------------------->
					</tbody></table> 
					<div class="search"><div><button class="grey">Create Account</button></div></div>
						<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
				<div class="clear"></div>
		    </form>
    	</div> 	
       <div class="clear"></div>
    </div>
 </div>
 <?php
	require_once "./inc/footer.php";
?>