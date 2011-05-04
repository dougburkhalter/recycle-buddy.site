<?php
	include("topbot.inc.php");
	$header="Search";
	top("Search", $header);
?>
			<div class="bodytext" style="padding:12px;" align="justify">
				<strong>Search for recycling centers in your area.</strong><br />
				<!--<br />
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur id est   tincidunt nisl pellentesque tincidunt. Donec in mauris. Mauris neque magna,   consectetuer id, malesuada vitae, tincidunt sit amet, mi. Aliquam lacinia.   Suspendisse potenti. Proin justo lorem, rutrum ac, facilisis in, malesuada sed,   ligula. Mauris lobortis lacus at nibh. Aenean vitae odio vel odio placerat   hendrerit. Suspendisse lacus lacus, tempor id, pharetra eget, ornare sit amet,   pede. Sed aliquet, justo ac elementum pretium, arcu leo placerat est, a luctus   purus diam eget arcu. Nam augue diam, mollis a, scelerisque eget, aliquet   condimentum, pede. Vestibulum tristique lectus sed augue.-->
			</div>
			<div class="panel" align="justify">
				<!--<div class="orangetitle">Coming Soon</div>-->
				<div class="bodytext">
					Choose a location and what you'd like to recycle (leave checkboxes blank for all recycling centers in an area):<br />
					<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
					<script language="javascript" type="text/javascript"><!--
						function clearForm() {
						
							var allInputs = document.getElementsByTagName("input");
							for (var i = 0; i < allInputs.length; i++) {
								if (allInputs[i].type == "text" && !(allInputs[i].id == "quickzip") ) {
									allInputs[i].value = "";
								} else if (allInputs[i].type == "checkbox") {
									allInputs[i].checked = false;
								}
							}
						}
						
						function fillForm() {
							var allInputs = document.getElementsByTagName("input");
							for (var i = 0; i < allInputs.length; i++) {
								switch(allInputs[i].id) {
									case "frmCity":
										<?php if ($_POST['City']) Echo 'allInputs[i].value = "' . $_POST['City'] . '";' . PHP_EOL; else echo PHP_EOL;  ?>
										break;                                                                      
									case "frmState":                                                                
										<?php if ($_POST['State']) echo 'allInputs[i].value = "' . $_POST['State'] . '";' . PHP_EOL; else echo PHP_EOL;  ?>
										break;                                                                      
									case "frmCityState":
										<?php if ($_POST['CityState']) echo 'allInputs[i].value = "' . $_POST['CityState'] . '";' . PHP_EOL; else echo PHP_EOL;  ?>
										break;
									case "frmZip":                                                                  
										<?php if ($_POST['ZipCode']) echo 'allInputs[i].value = "' . $_POST['ZipCode'] . '";' . PHP_EOL; else echo PHP_EOL;  ?>
										break;
									case "chkPlastic":
										<?php if (is_array($_POST['Materials']) && in_array("Plastic", $_POST['Materials'])) echo "allInputs[i].checked = true;\n"; else echo PHP_EOL; ?>
										break;                                                                          
									case "chkCardboard":                                                                
										<?php if (is_array($_POST['Materials']) && in_array("Cardboard", $_POST['Materials'])) echo "allInputs[i].checked = true;\n"; else echo PHP_EOL;  ?>
										break;                                                                          
									case "chkAluminum":                                                                 
										<?php if (is_array($_POST['Materials']) && in_array("Aluminum", $_POST['Materials'])) echo "allInputs[i].checked = true;\n"; else echo PHP_EOL;  ?>
										break;                                                                          
									case "chkGlass":                                                                    
										<?php if (is_array($_POST['Materials']) && in_array("Glass", $_POST['Materials'])) echo "allInputs[i].checked = true;\n"; else echo PHP_EOL;  ?>
										break;                                                                          
									case "chkPaper":                                                                    
										<?php if (is_array($_POST['Materials']) && in_array("Paper", $_POST['Materials'])) echo "allInputs[i].checked = true;\n"; else echo PHP_EOL;  ?>
										break;                                                                          
								}
							}
						} //-->
					</script>
					<table>
						<!-- Old layout, new one matches app
						<tr><td rowspan="2" class="orangetitle">Location:</td>
							<td><label for="frmCity">City:</label></td>
							<td><label for="frmState">State:</label></td>
							<td rowspan="2"><h3>OR</h3></td><td><label for="frmZip">Zip Code:</label></td>
						</tr>
						<tr><td><input type="text" name="City" id="frmCity" size="20" maxlength="20" /></td>
							<td><input type="text" name="State" id="frmState" size="2" maxlength="2" /></td>
							<td><input type="text" name="ZipCode" id="frmZip" size="4" maxlength="5" /></td>
						</tr>
						-->
						<tr><td rowspan="2" class="orangetitle">Location:</td>
							<td><label for="frmCityState">City & State:</label></td>
							<td rowspan="2"><h3>OR</h3></td><td><label for="frmZip">Zip Code:</label></td>
						</tr>
						<tr><td><input type="text" name="CityState" id="frmCityState" size="30" maxlength="30" /></td>
							<td><input type="text" name="ZipCode" id="frmZip" size="4" maxlength="5" /></td>
						</tr>
					</table>
					<table>
						<tr><td class="orangetitle">Materials:</td>
							<td><input type="checkbox" name="Materials[]" value="Plastic" id="chkPlastic" /><label for="chkPlastic">Plastic</label></td>
							<td><input type="checkbox" name="Materials[]" value="Cardboard" id="chkCardboard" /><label for="chkCardboard">Cardboard</label></td>
							<td><input type="checkbox" name="Materials[]" value="Aluminum" id="chkAluminum" /><label for="chkAluminum">Aluminum</label></td>
							<td><input type="checkbox" name="Materials[]" value="Glass" id="chkGlass" /><label for="chkGlass">Glass</label></td>
							<td><input type="checkbox" name="Materials[]" value="Paper" id="chkPaper" /><label for="chkPaper">Paper</label></td>
						</tr>
						<tr>
							<td><input type="hidden" name="App" value="Website" /></td>
							<td><input type="submit" value="Search" name="submit" /></td>
							<td><input type="reset" value="Clear" /></td>
						</tr>
					</table>
					</form>
			</div></div>
			
			<?php
if ($_REQUEST["submit"]) {
	?>
			<div class="bodytext" style="padding:12px;" align="justify">
			<table>
			<script language="javascript" type="text/javascript"><!-- 
				fillForm();
			//--></script>
	<?php
	include("getlocations.php");
	?>
				</table>
			</div>
	<?php
}

	bottom();
?>