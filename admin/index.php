
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Jaldi:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/reset.css?1"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css?1"> <!-- Resource style -->
	<link rel="stylesheet" href="css/table.css?1"> <!-- Resource style -->
	<link href='http://fonts.googleapis.com/css?family=Quattrocento+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>


	<link rel="stylesheet" type="text/css" href="css/ajaxlivesearch.css?1">

	<!-- Live Search Styles -->
	<link rel="stylesheet" href="css/fontello.css?1">
	<link rel="stylesheet" href="css/animation.css?1">
    <!--[if IE 7]>
    <link rel="stylesheet" href="css/fontello-ie7.css">
    <![endif]-->


    <link rel="stylesheet" type="text/css" href="addDB/addStation/examples.css" />

    <title>Управление сайтом</title>
</head>
<body>

	<ul class="cd-accordion-menu animated">
		<li class="has-children">
			<input type="checkbox" name ="group-1" id="group-1" >
			<label for="group-1">Поезда</label>

			<ul>
				<li class="has-children">
					<input type="checkbox" name ="sub-group-1" id="sub-group-1" >
					<label for="sub-group-1">Расписание поезда</label>

					<ul>
						<li><a id="add_list">Добавить </a></li>
						<li><a id="delete_list">Удалить</a></li>
						<li><a id="update_list">Редактировать</a></li>
					</ul>
				</li>

				<li class="has-children">
					<input type="checkbox" name ="sub-group-2" id="sub-group-2" >
					<label for="sub-group-2">Путь поезда</label>

					<ul>
						<li><a id="add_way">Добавить </a></li>
						<li><a id="delete_way">Удалить</a></li>
						<li><a id="update_way">Редактировать</a></li>
					</ul>
				</li>

				<li class="has-children">
					<input type="checkbox" name ="sub-group-3" id="sub-group-3" >
					<label for="sub-group-3">Стоимость билетов поезда</label>

					<ul>
						<li><a id="add_ticket_cost">Добавить </a></li>
						<li><a id="delete_ticket_cost">Удалить</a></li>
						<li><a id="update_ticket_cost">Редактировать</a></li>
					</ul>
				</li>
<!-- 
				<li class="has-children">
					<input type="checkbox" name ="sub-group-4" id="sub-group-4" >
					<label for="sub-group-4" >Состав поезда</label>

					<ul>
						<li><a>Добавить </a></li>
						<li><a id="delete_composition">Удалить</a></li>
						<li><a>Редактировать</a></li>
					</ul>
				</li>
				<li class="has-children">
					<input type="checkbox" name ="sub-group-2" id="sub-group-2">
					<label for="sub-group-2">Sub Group 2</label>
					
					<ul>
						<li class="has-children">
							<input type="checkbox" name ="sub-group-level-3" id="sub-group-level-3">
							<label for="sub-group-level-3">Sub Group Level 3</label>
							
							<ul>
								<li><a>Image</a></li>
								<li><a>Image</a></li>
							</ul>
						</li>
						<li><a>Image</a></li>
					</ul>
				</li>  -->
				<li><a id="add_train">Добавить </a></li>
				<li><a id="delete_train">Удалить</a></li>
				<li><a id="update_train">Редактировать</a></li>
			</ul>
		</li>

		<li class="has-children">
			<input type="checkbox" name ="group-2" id="group-2" >
			<label for="group-2"  id="toggle">Станции</label>

			<ul>
				<li><a id="add_station">Добавить </a></li>
				<li><a id="delete_station">Удалить</a></li>
			</ul>
		</li>

		<li class="has-children">
			<input type="checkbox" name ="group-3" id="group-3" >
			<label for="group-3">Категории вагона</label>

			<ul>
				<li><a id="add_category">Добавить </a></li>
				<li><a id="delete_category">Удалить</a></li>
				<li><a id="update_category">Редактировать</a></li>
			</ul>
		</li>

	</ul> <!-- cd-accordion-menu -->

	<button class="clear" >Очистить все</button>
	<div class="content">
		<div class="select_trains"></div>
		<div class="select_stations"></div>
		<div class="select_category"></div>
	</div>
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script type="text/javascript" src="addDB/addStation/gmaps.js"></script>
	<script src="js/select.js"></script> <!-- Resource jQuery -->
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="js/main.js"></script> 
	<script type="text/javascript" src="js/ajaxlivesearch.js"></script>
</body>
</html>