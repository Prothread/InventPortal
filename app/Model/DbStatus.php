<?php 

class DbStatus extends Database
{
	
	public function create(Status $statusinfo)
	{
		$sql = "INSERT INTO `status_item` (`subject`, `person`, `deadline`, `category`) VALUES ('{$statusinfo->getSubject()}', '{$statusinfo->getName()}', '{$statusinfo->getDeadline()}', '{$statusinfo->getCategory()}')";

		if($this->dbQuery($sql)) {
			return true;
		}
		return false;
	}

	public function getItems(){
		$sql = "SELECT * FROM `status_item`";

		$result = $this->dbQuery($sql);
		$fetch_all = mysqli_fetch_all($result, MYSQLI_ASSOC);

		if($fetch_all) {
			return $fetch_all;
		}
	}

}