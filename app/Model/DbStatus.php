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

}