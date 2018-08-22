<?php
class User extends database{
	protected $_table = "member";
	
	public function listUsers($start, $limit){
		$sql = "select * from $this->_table limit $start,$limit";
		$this->query($sql);
		return $this->fetchAll();
	}
	
	public function totalRecord(){
		$sql = "select * from $this->_table";
		$this->query($sql);
		return $this->num_rows();
	}
}