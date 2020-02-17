<?php
	$fielpath = realpath(dirname(__FILE__));

	include_once $fielpath.'/../lib/database.php';
	include_once $fielpath.'/../helpers/format.php';

	class Notification{
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database;
			$this->fm = new Format;
		}
    
    public function getTotalUnreadOrder(){
        $query = "SELECT user_id,order_id,purchaseAt,notification FROM item_sold WHERE notification=0";
		$result = $this->db->select($query);
		return $result;
    }
    
    
    public function OrderNotificationInf(){
        $query = "SELECT user_id,order_id,purchaseAt,notification FROM item_sold WHERE notification=0 ORDER BY order_id DESC LIMIT 6";
		$result = $this->db->select($query);
		return $result;
    }
    
    public function getUserName($id){
        $query = "SELECT name FROM students_table WHERE id='$id'";
		$result = $this->db->select($query);
		if($result){
		    
		    while($nt_result = $result->fetch_assoc()){
		        return $nt_result['name'];
		    }
		}

    }
    public function updateNotificationReadStatus($id){
        $query = "UPDATE item_sold SET notification =1 WHERE order_id='$id'";
		$result = $this->db->update($query);
		return $result;
    }
    
    
    public function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}



    



	}

?> 