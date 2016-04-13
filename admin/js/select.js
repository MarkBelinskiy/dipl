$( ".clear" ).click(function() {
	$( ".content" ).html('<div class="select_trains"></div><div class="select_stations"></div><div class="select_category"></div>');
	$(':checkbox').siblings('ul').attr('style', 'display:block;').slideUp(300);
	$(':checkbox').prop({'checked': false});

});

/////////////////////////////////////////////////////////////////////////////////
////////////////////////////////SELECT FUNCTIONS/////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

$("#group-1").click(function(){
	$(".select_trains").toggle('fast', select_trains());
});

$("#group-2").click(function(){
	$(".select_stations").toggle('fast', select_stations());
});

$("#group-3").click(function(){
	$(".select_category").toggle('fast', select_category());
});


function select_trains() {
	$.ajax({ 
	 type:'post',//тип запроса: get,post либо head
	 url:'ajax/select_trains.php',//url адрес файла обработчика
	 response:'text',//тип возвращаемого ответа text либо xml
	 success:function (data) {//возвращаемый результат от сервера
	 	$('.select_trains').html(data);
	 }
	});
}

function select_list_by_id(id_train) {
	$.ajax({ 
	 type:'post',//тип запроса: get,post либо head
	 url:'ajax/select_list.php',//url адрес файла обработчика
	 data: {'id_train': id_train},
	 response:'text',//тип возвращаемого ответа text либо xml
	 success:function (data) {//возвращаемый результат от сервера
	 	$('.select_list_by_id').html(data);
	 }
	});
}

function select_way_by_id(id_list) {
	$.ajax({ 
	 type:'post',//тип запроса: get,post либо head
	 url:'ajax/select_way.php',//url адрес файла обработчика
	 data: {'id_list': id_list},
	 response:'text',//тип возвращаемого ответа text либо xml
	 success:function (data) {//возвращаемый результат от сервера
	 	$('.select_way_by_id').html(data);
	 }
	});
}


function select_ticket_cost_by_id(id_way) {
	$.ajax({ 
	 type:'post',//тип запроса: get,post либо head
	 url:'ajax/select_ticket_cost.php',//url адрес файла обработчика
	 data: {'id_way': id_way},
	 response:'text',//тип возвращаемого ответа text либо xml
	 success:function (data) {//возвращаемый результат от сервера
	 	$('.select_ticket_cost_by_id').html(data);
	 }
	});
}


function select_composition() {
	$.ajax({ 
	 type:'post',//тип запроса: get,post либо head
	 url:'ajax/select_composition.php',//url адрес файла обработчика
	 response:'text',//тип возвращаемого ответа text либо xml
	 success:function (data) {//возвращаемый результат от сервера
	 	$('.select_composition').html(data);
	 }
	});
}

function select_stations() {
	$.ajax({ 
	 type:'post',//тип запроса: get,post либо head
	 url:'ajax/select_stations.php',//url адрес файла обработчика
	 response:'text',//тип возвращаемого ответа text либо xml
	 success:function (data) {//возвращаемый результат от сервера
	 	$(".select_stations").html("<div class=\"add_station\"></div><div class=\"update_station\"></div>"+data);
	 }
	});
}

function select_category() {
	$.ajax({ 
	 type:'post',//тип запроса: get,post либо head
	 url:'ajax/select_category.php',//url адрес файла обработчика
	 response:'text',//тип возвращаемого ответа text либо xml
	 success:function (data) {//возвращаемый результат от сервера
	 	$(".select_category").html("<div class=\"add_category\"></div>"+data);
	 }
	});
}

/////////////////////////////////////////////////////////////////////////////////
////////////////////////////////ADD FUNTTIONCS///////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

$("#add_station").click(function(){
	$(".add_station").toggle('fast', add_station());
});

$("#add_train").click(function(){
	$(".add_train").toggle('fast', add_train());
});

$("#add_list").click(function(){
	$(".add_list").toggle('fast', add_list());
});

$("#add_way").click(function(){
	$(".add_way").toggle('fast', add_way());
});

$("#add_ticket_cost").click(function(){
	$(".add_ticket_cost").toggle('fast', add_ticket_cost());
});

$("#add_category").click(function(){
	$(".add_category").toggle('fast', add_category());
});


function add_station() {

	$.ajax({ 
	 type:'post',//тип запроса: get,post либо head
	 url:'addDB/addStation/geocoding.php',//url адрес файла обработчика
	 response:'text',//тип возвращаемого ответа text либо xml
	 success:function (data) {//возвращаемый результат от сервера
	 	$('.add_station').html(data);
	 }
	});
}

function add_train() {

	$.ajax({ 
	 type:'post',//тип запроса: get,post либо head
	 url:'addDB/addTrain/addTrain.php',//url адрес файла обработчика
	 response:'text',//тип возвращаемого ответа text либо xml
	 success:function (data) {//возвращаемый результат от сервера
	 	$('.add_train').html(data);
	 }
	});
}

function add_list() {

	$.ajax({ 
	 type:'post',//тип запроса: get,post либо head
	 url:'addDB/addList/addList.php',//url адрес файла обработчика
	 response:'text',//тип возвращаемого ответа text либо xml
	 success:function (data) {//возвращаемый результат от сервера
	 	$('.add_list').html(data);
	 }
	});
}


function add_way() {

	$.ajax({ 
	 type:'post',//тип запроса: get,post либо head
	 url:'addDB/addWay/addWay.php',//url адрес файла обработчика
	 response:'text',//тип возвращаемого ответа text либо xml
	 success:function (data) {//возвращаемый результат от сервера
	 	$('.add_way').html(data);
	 }
	});
}

function add_ticket_cost() {

	$.ajax({ 
	 type:'post',//тип запроса: get,post либо head
	 url:'addDB/addTicketCost/addTicketCost.php',//url адрес файла обработчика
	 response:'text',//тип возвращаемого ответа text либо xml
	 success:function (data) {//возвращаемый результат от сервера
	 	$('.add_ticket_cost').html(data);
	 }
	});
}

function add_category() {

	$.ajax({ 
	 type:'post',//тип запроса: get,post либо head
	 url:'addDB/addWagonCategory/addWagonCategory.php',//url адрес файла обработчика
	 response:'text',//тип возвращаемого ответа text либо xml
	 success:function (data) {//возвращаемый результат от сервера
	 	$('.add_category').html(data);
	 }
	});
}



/////////////////////////////////////////////////////////////////////////////////
////////////////////////////////UPDATE FUNCTIONS/////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////


$("#update_category").click(function () {
	if($('*').is('.cat_form')) {
		$(".update_category").toggle('fast', function () {
			$(".update_category").html('<div class="update_category"></div>');
		});
	} else {
		var cat_id = prompt('Введите id поля для редактирования', 1);
		$(".update_category").toggle('fast', update_category(cat_id));
	}
});

function update_category(cat_id) {

	$.ajax({ 
	 type:'post',//тип запроса: get,post либо head
	 url:'updateDB/updateWagonCategory/updateWagonCategory.php',//url адрес файла обработчика
	 data: {'cat_id': cat_id},
	 response:'text',//тип возвращаемого ответа text либо xml
	 success:function (data) {//возвращаемый результат от сервера
	 	$('.update_category').html(data);
	 }
	});
}



$("#update_train").click(function () {
	if($('*').is('.train_form')) {
		$(".update_train").toggle('fast', function () {
			$(".update_train").html('<div class="update_train"></div>');
		});
	} else {
		var train_id = prompt('Введите id поля для редактирования', 1);
		$(".update_train").toggle('fast', update_train(train_id));
	}
});


function update_train(train_id) {

	$.ajax({ 
	 type:'post',//тип запроса: get,post либо head
	 url:'updateDB/updateTrain/updateTrain.php',//url адрес файла обработчика
	 data: {'train_id': train_id},
	 response:'text',//тип возвращаемого ответа text либо xml
	 success:function (data) {//возвращаемый результат от сервера
	 	$('.update_train').html(data);
	 }
	});
}


$("#update_list").click(function () {
	if($('*').is('.list_form')) {
		$(".update_list").toggle('fast', function () {
			$(".update_list").html('<div class="update_list"></div>');
		});
	} else {
		var list_id = prompt('Введите id поля для редактирования', 1);
		$(".update_list").toggle('fast', update_list(list_id));
	}
});


function update_list(list_id) {

	$.ajax({ 
	 type:'post',//тип запроса: get,post либо head
	 url:'updateDB/updateList/updateList.php',//url адрес файла обработчика
	 data: {'list_id': list_id},
	 response:'text',//тип возвращаемого ответа text либо xml
	 success:function (data) {//возвращаемый результат от сервера
	 	$('.update_list').html(data);
	 }
	});
}


$("#update_way").click(function () {
	if($('*').is('.way_form')) {
		$(".update_way").toggle('fast', function () {
			$(".update_way").html('<div class="update_way"></div>');
		});
	} else {
		var way_id = prompt('Введите id поля для редактирования', 1);
		$(".update_way").toggle('fast', update_way(way_id));
	}
});


function update_way(way_id) {

	$.ajax({ 
	 type:'post',//тип запроса: get,post либо head
	 url:'updateDB/updateWay/updateWay.php',//url адрес файла обработчика
	 data: {'way_id': way_id},
	 response:'text',//тип возвращаемого ответа text либо xml
	 success:function (data) {//возвращаемый результат от сервера
	 	$('.update_way').html(data);
	 }
	});
}

$("#update_ticket_cost").click(function () {
	if($('*').is('.ticket_cost_form')) {
		$(".update_ticket_cost").toggle('fast', function () {
			$(".update_ticket_cost").html('<div class="update_ticket_cost"></div>');
		});
	} else {
		var ticket_cost_id = prompt('Введите id поля для редактирования', 1);
		$(".update_ticket_cost").toggle('fast', update_ticket_cost(ticket_cost_id));
	}
});


function update_ticket_cost(ticket_cost_id) {

	$.ajax({ 
	 type:'post',//тип запроса: get,post либо head
	 url:'updateDB/updateTicketCost/updateTicketCost.php',//url адрес файла обработчика
	 data: {'ticket_cost_id': ticket_cost_id},
	 response:'text',//тип возвращаемого ответа text либо xml
	 success:function (data) {//возвращаемый результат от сервера
	 	$('.update_ticket_cost').html(data);
	 }
	});
}





/////////////////////////////////////////////////////////////////////////////////
////////////////////////////////DELETE FUNCTIONS/////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

$("#delete_train").click(function () {
	window.open("https://free5.beget.ru/phpMyAdmin/sql.php?server=1&db=s99510pj_mark&table=Train");
});

$("#delete_list").click(function () {
	window.open("https://free5.beget.ru/phpMyAdmin/sql.php?server=1&db=s99510pj_mark&table=List");
});

$("#delete_way").click(function () {
	window.open("https://free5.beget.ru/phpMyAdmin/sql.php?server=1&db=s99510pj_mark&table=Way");
});

$("#delete_ticket_cost").click(function () {
	window.open("https://free5.beget.ru/phpMyAdmin/sql.php?server=1&db=s99510pj_mark&table=TicketCost");
});

$("#delete_composition").click(function () {
	window.open("https://free5.beget.ru/phpMyAdmin/sql.php?server=1&db=s99510pj_mark&table=Composition");
});

$("#delete_station").click(function () {
	window.open("https://free5.beget.ru/phpMyAdmin/sql.php?server=1&db=s99510pj_mark&table=Station");
});

$("#delete_category").click(function () {
	window.open("https://free5.beget.ru/phpMyAdmin/sql.php?server=1&db=s99510pj_mark&table=WagonCategory");
});