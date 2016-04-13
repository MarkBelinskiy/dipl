	<form action="addDB/addTrain/train_to_db.php" method="POST">
		<p>Введите номер поезда:</p>
		<input type="text" name="n_train"><br><br>
	
		<p>Введите тип поезда:</p>
		<select  name="type_train">
			<option value="0">скорые пассажирские (круглогодичного обращения) </option>
			<option value="1">скоростные </option>
			<option value="2">ускоренные </option>
			<option value="3">скорые пассажирские (сезонного обращения) </option>
			<option value="4">пассажирские летние </option>
			<option value="5">пассажирские разового назначения </option>
			<option value="6">разового назначения летние </option>
			<option value="7">местные </option>
			<option value="8">ускоренные в дальнем и местном сообщении повышенной комфортности </option>
			<option value="9">ускоренные в дальнем и местном сообщении без предоставления дополнительных услуг </option>
			<option value="10">почтово–багажные, грузопассажирские </option>
			<option value="11">пригородные </option>
		</select><br><br>

		<p>Введите название поезда:</p>
		<input type="text" name="name_train"><br><br>

		<input type="submit" value="Добавить в БД">
	</form>
</body>
</html>