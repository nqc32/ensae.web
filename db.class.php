<?php
class DB {
	
	var $result;
	var $row;
	var $query;
	var $debug;
	
	function DB($debug=FALSE) {
		$this->debug=$debug;
		$this->host = localhost;
		$this->db=cuong;
		$this->user = root;
		$this->pass = cuong;
		$this->link = mysqli_connect($this->host, $this->user, $this->pass,$this->db);
		#mysqli_query($this->link,"SET NAMES utf8") ;
		#mysqli_query($this->link;"SET CHARACTER SET utf8");
		#mysqli_select_db($this->db);
		if (!mysqli_set_charset($this->link, "utf8")) {
		    #printf("Erreur lors du chargement du jeu de caractères utf8 : %s\n", mysqli_error($this->link));
		} else {
		    #printf("Jeu de caractères courant : %s\n", mysqli_character_set_name($this->link));
		}
		
	}
   
	function query($query) {
		if ($this->result=mysqli_query($this->link,$query))  {
			if ($this->debug) {
				echo mysqli_error()."<br />".$query;
				echo "<hr />";
			}
		}
		return $this->result;
	}

	function set_base($base) {
		mysqli_select_db($base);
		return true;
	}
   	
	function fetch() {
		$this->row=mysqli_fetch_row($this->result);
		return $this->row;
	}
      
	function fetch_assoc() {
		$this->row=mysqli_fetch_assoc($this->result);
		return $this->row;
	}
   
	function field_name($field_offset) {
		return mysqli_field_name($this->result,$field_offset);
	}
   
	function num_fields() {
		return mysqli_num_fields($this->result);
	}
	
	function insert_id() {
		return mysqli_insert_id();
	}
	
	function close() {
		mysqli_close($this->link);
	}   
}
/**
 *
 * @create a dropdown select
 *
 * @param string $name
 *
 * @param array $options
 *
 * @param string $selected (optional)
 *
 * @return string
 *
 */
function dropdown( $name, array $options, $selected=null )
{
    /*** begin the select ***/
    $dropdown = '<select name="'.$name.'" id="'.$name.'">'."\n";

    $selected = $selected;
    /*** loop over the options ***/
    foreach( $options as $key=>$option )
    {
        /*** assign a selected value ***/
        $select = $selected==$key ? ' selected' : null;

        /*** add each option to the dropdown ***/
        $dropdown .= '<option value="'.$key.'"'.$select.'>'.$option.'</option>'."\n";
    }

    /*** close the select ***/
    $dropdown .= '</select>'."\n";

    /*** and return the completed dropdown ***/
    return $dropdown;
}
?>