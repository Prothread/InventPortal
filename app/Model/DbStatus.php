<?php 

class DbStatus extends Database
{
	
	public function create(Status $statusinfo)
	{
		$date = $statusinfo->getDeadline();
		$date = date("Y-m-d", strtotime($date));

		$sql = "INSERT INTO `status_item` (`subject`, `person`, `deadline`, `category`, `comment`) VALUES ('{$statusinfo->getSubject()}', '{$statusinfo->getName()}', '{$date}', '{$statusinfo->getCategory()}', '{$statusinfo->getComment()}')";

		if($this->dbQuery($sql)) {
			return true;
		}
		return false;
	}

	public function update(Status $statusinfo)
	{
		$date = $statusinfo->getDeadline();
		$date = date("Y-m-d", strtotime($date));

		$sql = "UPDATE `status_item` SET `subject` = '{$statusinfo->getSubject()}', `person`= '{$statusinfo->getName()}', 
		`deadline` = '{$date}', `category` = '{$statusinfo->getCategory()}', `comment` = '{$statusinfo->getComment()}' WHERE `id` = '{$statusinfo->getID()}'";

		if($this->dbQuery($sql)) {
			return true;
		}
		return false;
	}

	public function deleteItemByID($id)
	{
		$sql = "DELETE FROM `status_item` WHERE `id` = '{$id}'";

		$result = $this->dbQuery($sql);

        if($result) {
            return true;
        }

	}

	public function getItems(){
		$sql = "SELECT * FROM `status_item`";

		$result = $this->dbQuery($sql);
		$fetch_all = mysqli_fetch_all($result, MYSQLI_ASSOC);

		if($fetch_all) {
			return $fetch_all;
		}
	}

	public function getItemById($id)
	{
		$sql = "SELECT * FROM `status_item` WHERE `id` = '{$id}'";

		$result = $this->dbQuery($sql);
        $row = mysqli_fetch_assoc($result);

        if($row) {
            return $row;
        }
	}

}