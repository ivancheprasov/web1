<html>
	<head>
    	<meta charset="utf-8">
    	<title>answer</title>
    	<link rel="stylesheet" href="style.css">
	</head>
	<body id="result-body">
	<?php
	if (session_id() === "") session_start();
	$start_time=microtime(true);
	date_default_timezone_set('Etc/GMT-3');
	$time_now=time();
	$x=$_GET['x-input'];
	$y;
	$r;
	$pre_y=preg_replace('/,/', '.', $_GET['y-input']);
	$pre_r=preg_replace('/,/', '.', $_GET['r-input']);
	$match_x=true;
	$match_y=false;
	$match_r=false;
	foreach ($x as $x_coordinate) {
		if(preg_match('/^[0-4]$/',$x_coordinate)||
		preg_match('/^-[1-4]$/',$x_coordinate)){
		}else{
			$match_x=false;
		}
	}
	if(preg_match('/^[0-5]$/',$pre_y)||
		preg_match('/^-[1-3]$/',$pre_y)||
		preg_match('/^-[1-2]\.\d+$/', $pre_y)||
		preg_match('/^[0-4]\.\d+$/', $pre_y)){
		$y=(float)$pre_y;
		$match_y=true;
	}
	if(preg_match('/^[1-4]$/', $pre_r)||
		preg_match('/^[1-3]\.\d+$/', $pre_r)){
		$r=(float)$pre_r;
		$match_r=true;
	}
	$count=count($x);
	if (!isset($_SESSION['points'])){
		$_SESSION['points']=array();
	}
	if(!isset($_SESSION['table'])){
		$_SESSION['table']=array();
		array_unshift($_SESSION['table'],false);
	}
	if(array_shift($_SESSION['table'])){
		$_SESSION['points']=array();
	}
	if($match_y&&$match_r&&($count>0)&&$match_x){
		foreach ($x as $x_coordinate) {
			$point = new Point($x_coordinate, $y, $r);
   			array_unshift($_SESSION['points'], $point);
		}
	}
	while(count($_SESSION['points'])>5){
   		array_pop($_SESSION['points']);
   	}
   	array_unshift($_SESSION['table'],false);
	echo'<table class="point-table">
		<thead>
			<tr>
				<td class="table-heading">
					Результат обработки данных
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<table class="result-table">
						<tr id="first-line">
							<td>
								Координата Х
							</td>
							<td>
								Координата Y
							</td>
							<td>
								Координата R
							</td>
							<td>
								Попадание
							</td>
						</tr>';
	foreach ($_SESSION['points'] as $point) {
		echo			'<tr>
							<td>'.$point->getX().'</td>
							<td>'.$point->getY().'</td>
							<td>'.$point->getR().'</td>
							<td>'.$point->getPresence().'</td>
						</tr>';					
	}
	if(count($_SESSION['points'])<5){
		for($i=0;$i<5-count($_SESSION['points']);$i++){
			echo		'<tr>
							<td><br></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>';		
		}
	}				
		echo 			'</table>
					</td>
				</tr>
				<tr>';
				$time=(float)round(microtime(true)-$start_time,4);
				if ($time==0) $time='Менее 0.0001';				
				echo '<td>Время работы скрипта: '.$time.' сек.
					</td>
				</tr>
				<tr>
					<td>Время последнего запроса: '.date("H:i:s",$time_now).'</td>
				</tr>';
		if($count>5){
		echo 	'<tr>
					<td>Вы ввели слишком много Х координат. Будут сохранены результаты для последних пяти точек.</td>
				</tr>';
		}
		if(!$match_x){
		echo 	'<tr>
					<td>Вы ввели некорректное значение Х или не входящее в допустимый диапозон. Введите значение от -4 до 4.</td>
				</tr>';
		}
		if($count==0){
		echo 	'<tr>
					<td>Вы не выбрали значение Х. Сделайте это.</td>
				</tr>';		
		}
		if(!$match_y){
		echo 	'<tr>
					<td>Введено некорректное значение Y или не входящее в допустимый диапозон. Введите значение от -3 до 5.</td>
				</tr>';		
		}
		if(!$match_r){
		echo 	'<tr>
					<td>Введено некорректное значение R или не входящее в допустимый диапозон. Введите значение от 1 до 4.</td>
				</tr>';		
		}			
		echo '	</tbody>
		</table>';			
	Class Point{
		private $x;
		private $y;
		private $r;
		private $presence;
		public function Point($x, $y, $r){
			$this->x=$x;
			$this->y=$y;
			$this->r=$r;
			$this->check_presence();
		}
		public function check_presence(){
			if($this->x>=0&&$this->y<=0){
				if($this->x<=$this->r&&$this->y>=(-$this->r/2)){
					$this->presence='Да';
				}else{
					$this->presence='Нет';
				}
			}
			if($this->x<=0&&$this->y<=0){
				if($this->y>=-$this->x-$this->r){
					$this->presence='Да';
				}else{
					$this->presence='Нет';
				}
			}
			if($this->x<=0&&$this->y>=0){
				if($this->x**2+$this->y**2<=$this->r**2){
					$this->presence='Да';
				}else{
					$this->presence='Нет';
				}
			}
			if($this->x>0&&$this->y>0){
				$this->presence='Нет';
			}
		}
		public function getX(){
			return $this->x;
		}
		public function getY(){
			return $this->y;
		}
		public function getR(){
			return $this->r;
		}
		public function getPresence(){
			return $this->presence;
		}
	}
	?>
	</body>
</html>	
			    