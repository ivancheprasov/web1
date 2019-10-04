<html>
	<head>
    	<meta charset="utf-8">
    	<title>answer</title>
    	<link rel="stylesheet" href="style.css">
    	<?php
		if (session_id() === "") session_start();
		if (!isset($_SESSION['table'])){
			$_SESSION['table']=array();
		}
		array_unshift($_SESSION['table'],true);
		?>
	</head>
	<body id="result-body">
		<table class="point-table">
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
							</tr>
							<tr>
								<td>
									<br>
								</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>
									<br>
								</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>
									<br>
								</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>
									<br>
								</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>
									<br>
								</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>Время работы скрипта: -</td>
				</tr>
				<tr>
					<td>Время последнего запроса: -</td>
				</tr>
				</tbody>
		</table>	
	</body>
</html>	