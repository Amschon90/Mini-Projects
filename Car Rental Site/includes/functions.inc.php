<?php
function create_form_field($label='', $type='text', $name='', $id='', $extras=array()){
	global $$name;
	if(!empty($$name)){
		$value = $$name;
		$value = stripslashes($value);
	}
	echo "<p>";
	if(!empty($label)) echo "<label for='$id'>$label</label>";
	if(($type=='text') || ($type=='email') || ($type=='tel') || ($type=='url') || ($type=='password') || ($type=='date') || ($type=='color') || ($type=='number')){
		echo "<input type='$type' id='$id' name='$name'";
		if(!empty($value)) echo "value='$value'";
			if(count($extras) > 0){
				foreach($extras as $key=>$var){
					echo "$key='$var'";
				}
			}
		echo ">";
	}elseif($type=='textarea'){
		echo "<textarea id='$id' name='$name'";
			if(count($extras) > 0){
				foreach($extras as $key=>$var){
					echo "$key='$var'";
				}
			}
		echo ">";
		if(!empty($value)) echo "$value";
		echo "</textarea>";
	}
	echo "</p>";
}

function create_drop_down_from_query($label='', $name='', $id='', $multi_array = array(), $extras=array(), $errors_array){
	global $$name;
	if(!empty($$name)) $value = $$name;
	echo "<p>";
	if(count($errors_array) > 0 && !empty($errors_array[$name])) echo "<span style='color:red;>{$errors_array[$name]}</span><br>";
	if(!empty($label)) echo "<label>$label</label>";
	echo "<select name='$name' id='$id' size='1'";
	if(count($extras) > 0){
		foreach($extras as $key=>$value){
			echo "$key='$value'";
		}
	}
	echo ">";
	foreach($multi_array as $ind=>$one_record){
		echo "<option value='".$one_record[$name]."'";
			if(isset($$name)&&($$name==$one_record[$name])) echo "selected='selected'";
		if($name == 'rental_pickup_locations_id') echo ">".$one_record['location']."</option>";
		if($name == 'rentals_id') echo ">".$one_record['description']."&nbsp;-&nbsp;Daily&nbsp;Rate:&nbsp;"."$".$one_record['daily_rate']."</option>";
	}
	echo "</select></p>";
}

function add_slashes($data){
	if(get_magic_quotes_gpc()) $data = stripslashes($data);
	return addslashes($data);
}

function rollback($msg){
	global $link;
	mysqli_query($link, 'ROLLBACK');
	mysqli_close ($link);
	exit($msg);
}

function redirect($msg, $url, $time){
	header("refresh:$time; url=$url");
	exit($msg);
}

?>