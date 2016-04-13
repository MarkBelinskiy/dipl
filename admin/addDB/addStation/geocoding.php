
<script type="text/javascript">

	function save_c(lat, lng, address) {
		$.ajax({ 
	 type:'post',//тип запроса: get,post либо head
	 url:'addDB/addStation/ajax.php',//url адрес файла обработчика
	 data:{'coord': lat + "," + lng + "," + address},//параметры запроса
	 response:'text',//тип возвращаемого ответа text либо xml
	 success:function (data) {//возвращаемый результат от сервера
	 	$('#result').html(data);
	 }
	});
	}
	var map;

	$(document).ready(function(){
		map = new GMaps({
			el: '#map',
			lat: 48.3847847,
			lng: 31.1594014
		});
		map.setZoom(5);

		$('#geocoding_form').submit(function(e){
			e.preventDefault();
			GMaps.geocode({
				address: $('#address').val().trim(),
				callback: function(results, status){
					if(status=='OK'){
						var latlng = results[0].geometry.location;
						var lat = latlng.lat();
						var lng = latlng.lng();
						var address = results[0].formatted_address;
						console.log( results[0]);
						save_c(lat, lng, address);

						map.setCenter(latlng.lat(), latlng.lng());
						map.setZoom(11);
						map.addMarker({
							lat: latlng.lat(),
							lng: latlng.lng()
						});
					}
				}
			});
		});
	});
</script>

<div class="wrapper">
	<div class="form">
		<form method="post" id="geocoding_form">
			<label for="address">Введите город:</label>
			<div class="input">
				<input type="text" id="address" name="address" /><br><br>
				<input type="submit"  value="Получить координаты" />
			</div>
		</form>
	</div>
	<div class="result" id="result"></div>

	<div id="map"></div>
</div>