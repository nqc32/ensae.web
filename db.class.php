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
		$this->link = mysql_connect($this->host, $this->user, $this->pass);
		mysql_select_db($this->db);
	}
   
	function query($query) {
		if (!$this->result = mysql_query($query, $this->link))  {
			if ($this->debug) {
				echo mysql_error()."<br />".$query;
				echo "<hr />";
			}
		}
		return $this->result;
	}

	function set_base($base) {
		mysql_select_db($base);
		return true;
	}
   	
	function fetch() {
		$this->row=mysql_fetch_row($this->result);
		return $this->row;
	}
      
	function fetch_assoc() {
		$this->row=mysql_fetch_assoc($this->result);
		return $this->row;
	}
   
	function field_name($field_offset) {
		return mysql_field_name($this->result,$field_offset);
	}
   
	function num_fields() {
		return mysql_num_fields($this->result);
	}
	
	function insert_id() {
		return mysql_insert_id();
	}
	
	function close() {
		mysql_close($this->link);
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