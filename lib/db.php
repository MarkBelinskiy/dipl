<?php
class db{
 // публичные объекты
	public $link;
	public $result;
	public $error = array();

 // приватные объекты
	private $path, $user, $pass, $name;

 // вызывается автоматически
	function __construct() {
		global $db_path, $db_user, $db_pass, $db_name;
		$this->path = $db_path;
		$this->user = $db_user;
		$this->pass = $db_pass;
		$this->name = $db_name;
	}

 // коннектимся к MYSQLi
	function connect($path = false, $user = false, $pass = false, $name = false, $port = "3306") {
		if(!$path && !$user && !$pass && !$name) {
			$path = $this->path;
			$user = $this->user;
			$pass = $this->pass;
			$name = $this->name;
		}
		$this->link = new mysqli($path, $user, $pass, $name, $port);
		if(mysqli_connect_errno()) {
			$this->error[mysqli_connect_errno()] = mysqli_connect_error();
		}
	}

 // выполняем запрос в БД
	function query($query) {
		$result = $this->link->query($query);
		if(!$result) {
			$this->error[mysqli_errno($this->link)] = mysqli_error($this->link);
		} else {
			$this->result = $result;
			return $this->result;
		}
	}

 // выполняем запрос в БД
	function one_query($query) {
		return $this->get_assoc($this->link->query($query));
	}

 // возвращяем ассоциативный массив
	function get_assoc($result = false) {
		if (!$result) return mysqli_fetch_assoc($this->result);
		return mysqli_fetch_assoc($result);
	}

 // возвращяем массив с дубрированными ключами в виде цифр
	function get_array($result  = false) {
		if (!$result) return mysqli_fetch_array($this->result);
		return mysqli_fetch_array($result);
	}

 // возвращяем массив в виде объекста
	function get_object($result  = false) {
		if (!$result) return mysqli_fetch_object($this->result);
		return mysqli_fetch_object($result);
	}

 // возвращяем массив в виде строки
	function get_row($result  = false) {
		if (!$result) return mysqli_fetch_row($this->result);
		return mysqli_fetch_row($result);
	}

 // вернуть количество строк
	function get_num_rows($table = false) {
		if (!$table) 
			{	$count = $this->result->num_rows;
				return $count;
			} else {
				$count = $this->get_assoc($this->query("SELECT COUNT(*) as count FROM ".$table));
				return $count['count'];
			}
		}
 // вернуть количество строк в момент запроса
		function get_affected_rows() {
			return mysqli_affected_rows($this->link);
		}

 // вернуть последний id
		function last_id() {
			return mysqli_insert_id($this->link);
		}

 // вернуть названия таблиц
		function col_names($table = false) {
			if(!$table) return false;
			return array_values(array_flip($this->get_assoc($this->query("SELECT * FROM ".$table." LIMIT 1"))));
		}

 // очистка результатов
		function free($result = false) {
			if(!$result)  $result = $this->result;
			mysqli_free_result($result);
			return true;
			
		}

 // закрыть подключение к БД
		function close($link = false) {
			if(!$link) $link = $this->link;
			mysqli_close($link);
			return true;
		}

 // ѕоследний метод
		function __destruct() {
			if(count($this->error)) {
				foreach($this->error as $key => $value){
					echo '<div style="margin:10% auto;width:50%;background:tomato;color:#fff;padding:25px;border-radius:3px;box-shadow:0 1px 5px #000;"><b style="font-size:2em;">'.$key.'</b><br>'.$value.'</div>';
					die();
				}
			}
		}
	}


	$db_path = "localhost";
	$db_user = "s99510pj_mark";
	$db_pass = "s99510pj_mark";
	$db_name = "s99510pj_mark";

	

/*
	$path = $_SERVER["PHP_SELF"];

	if(!empty($_POST['query'])) {
		$select = $db->query($_POST['query']);
		$arr = array();
		while($row = $db->get_assoc($select)) {
			$arr[] = $row;
		}
		print_r($arr);
	} else {
		echo <<<HTML
		<!doctype>
		<html>
		<head>

		</head>
		<body>
			<input type="text" value="" style="width:70%;padding:5px 10px;" name="query"><br>
			<button>SEND</button>
			<div></div>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
			<script>
				$("button").on("click", function()
				{
					var get_result = $("input").val();
					$.post("{$path}", {query:get_result}, function(result)
					{
						$("div").html(result);
					});
});
</script>
</body>
</html>
HTML;
}*/
/*
//Подсчет строк в таблице, если она не указывается то используем из последнего запроса который хранится в $result
$count = $db->query("SELECT * FROM mark");
echo $db->get_num_rows();
*/

/*// Заполнение поля прайс(от 1 до 10) и процент(от 100 до 1000) случайными числами без цикла 
$update = $db->query("UPDATE mark SET price = FLOOR(100+RAND() * 900), percent = FLOOR(1+RAND() * 9) WHERE id>0");
print_r($db->get_affected_rows());*/

// $select = $db->query("select * from mark where id = 4");
/*$db->query("select * from mark  where id = 2");
while ($row = $db->get_assoc()) {
	print_r($row);
}
echo "<br>";
$db->free();
print_r($db->result);*/
/*$db->query("UPDATE mark SET with_per = price-(price/100*percent)");
echo "sdckjshbcdskjhcb";*/
/*$select = $db->query("SELECT price, percent FROM mark");
while($row = $db->get_assoc($select))
{
	print_r($row);
}
*/

?>