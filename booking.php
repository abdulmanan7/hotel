<?php
include_once 'header.php';

if (isset($_GET['id'])) {
	function get_rooms() {
		global $connection;

		$id = mysql_real_escape_string($_GET["id"]);

		try
		{
			$query = $connection->query("SELECT * FROM hl_rooms, hl_hotel
                                        WHERE hl_hotel_hotel_id =" . $id . "
                                        and hotel_id =" . $id . "");
			$rooms = $query->fetchAll();

			return $rooms;
		} catch (Exception $e) {
			return false;
		}
	}

	$rooms = get_rooms($_GET);

	if ($rooms) {

		foreach ($rooms as $room) {

			echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "' id='charge' name='charge' style='float:left; margin:0px 100px;'>";

			echo "<h4 style='color:red'>Hotel: " . $room["hotel_name"] . "</h4>";
			echo "<p>";
			echo "room type : " . $room['room_space'] . " people";
			echo "<br/>";
			echo "room price : " . $room['room_price'] . " &pound;	";
			echo "</p>";

			echo "
            <select name='guests' class='form-control' id='guests' required>
                <option value='0'>Guest(s)</option>

                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
                <option value='5'>5</option>
                <option value='6'>6+</option>

            </select>
              <br>
            <select name='room' class='form-control' id='room' required>
                <option value='0'>Room(s)</option>

                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
                <option value='5'>5</option>

            </select>";?>

        <br/>
        <select class="form-control" class="form-control" name="nights" id="nights" required>
                <option value="0">Night(s)</option>

                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
                <option value='5'>5</option>
                <option value='6'>6+</option>

            </select>

                    <br/>
                    <br/>

            <input type="date" class="form-control" name="checkin">
            <input type="hidden" name="room_id" class="form-control" value="<?php echo $room['room_id'];?>">
            <input type='hidden' name='hotel' class="form-control" value='<?php echo $_GET['id'];?>'/>
            <br>
            <input type='submit' value='Submit' class="btn btn-info"/>

    </form>
<?php

		}

	}

} else {

	if (isset($_POST["nights"])) {

		function get_price() {
			global $connection;

			$room_nb = mysql_real_escape_string($_POST['room']);
			$nights = mysql_real_escape_string($_POST['nights']);

			try
			{
				$query = $connection->query("SELECT SUM((room_price *" . $room_nb . ")* " . $nights . ") as Bill FROM hl_rooms
                                            WHERE hl_hotel_hotel_id ='" . mysql_real_escape_string($_POST['hotel']) . "'
                                            and room_id = '" . mysql_real_escape_string($_POST["room_id"]) . "'");
				$price = $query->fetch();
				return $price;
			} catch (Exception $e) {
				return false;
			}
		}
		$price = get_price($_POST);

		echo "<h4>payment info </h4>";
		echo "<br/>";
		echo "Total due : ";
		echo "<br/>";
		echo $price['Bill'] . "&pound;";

		?>
        <form method="post" action="payment.php">
            <input type="hidden" name="room" value="<?php echo $_POST['room'];?>"/>
            <input type="hidden" name="guests" value="<?php echo $_POST['guests'];?>"/>
            <input type="hidden" name="nights" value="<?php echo $_POST['nights'];?>"/>
            <input type="hidden" name="checkin" value="<?php echo $_POST['checkin'];?>"/>
            <input type="hidden" name="hotel" value="<?php echo $_POST['hotel'];?>"/>
            <input type="hidden" name="price" value="<?php echo $price['Bill'];?>"/>
            <input type="submit" value="Confirm" class="btn btn-info">
        </form>
<?php

	}
}
