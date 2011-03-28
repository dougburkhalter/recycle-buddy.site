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
					<table>
						<tr><td rowspan="2" class="orangetitle">Location:</td><td><label for="frmCity">City:</label></td><td><label for="frmState">State:</label></td><td rowspan="2"><h3>OR</h3></td><td><label for="frmZip">Zip Code:</label></td></tr>
						<tr><td><input type="text" name="city" id="frmCity" size="20" maxlength="20" /></td><td><input type="text" name="state" id="frmState" size="2" maxlength="2" /></td><td><input type="text" name="zipcode" id="frmZip" size="4" maxlength="5" /></td></tr>
					</table>
					<table>
						<tr><td class="orangetitle">Materials:</td>
							<td><input type="checkbox" name="materials[]" value="plastic" id="chkPlastic" /><label for="chkPlastic">Plastic</label></td>
							<td><input type="checkbox" name="materials[]" value="cardboard" id="chkCardboard" /><label for="chkCardboard">Cardboard</label></td>
							<td><input type="checkbox" name="materials[]" value="aluminum" id="chkAluminum" /><label for="chkAluminum">Aluminum</label></td>
							<td><input type="checkbox" name="materials[]" value="glass" id="chkGlass" /><label for="chkGlass">Glass</label></td>
							<td><input type="checkbox" name="materials[]" value="paper" id="chkPaper" /><label for="chkPaper">Paper</label></td>
						</tr>
						<tr><td>&nbsp;</td><td><input type="submit" value="Search" name="submit" /></td><td><input type="reset" value="Clear" /></td></tr>
					</table>
					</form>
			</div></div>
			<div class="bodytext" style="padding:12px;" align="justify">
			<table>
			<?php
if ($_REQUEST["submit"]) {

foreach ($_POST as $key => $value) {
	if (get_magic_quotes_gpc()) $value=stripslashes($value);
	if ($key=='materials') {
		
	if (is_array($_POST['materials']) ){
		print "<tr><td><code>$key</code></td><td>";
		foreach ($_POST['materials'] as $value) {
				print "<i>$value</i><br />";
				}
				print "</td></tr>";
		} else {
		print "<tr><td><code>$key</code></td><td><i>$value</i></td></tr>\n";
		}
	} else {

	print "<tr><td><code>$key</code></td><td><i>$value</i></td></tr>\n";
	}
}
} else {
	print "<p>No data was submitted.</p>";
}
?>
			</table>
			</div>

<?php
	bottom();
?>