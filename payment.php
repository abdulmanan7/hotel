<?php
include_once 'header.php';
if (isset($_POST['room'])) {

	function booking_submit() {

		global $connection;

		$room_nb = mysql_escape_string($_POST['room']);
		$guests = mysql_escape_string($_POST['guests']);
		$nights = mysql_escape_string($_POST["nights"]);
		$checkin = mysql_escape_string($_POST["checkin"]);
		$hotel = mysql_escape_string($_POST["hotel"]);
		$user = mysql_escape_string($_SESSION["user_id"]);
		$price = mysql_escape_string($_POST["price"]);

		try
		{
			$query = $connection->prepare("insert into hl_booking
				(booking_room_nb, booking_gest_nb, booking_checkin, booking_nights, booking_price, hl_users_user_id, hl_hotel_hotel_id)
				values(:room_nb, :guests, :checkin, :nights, :price, :user_id, :hotel )");

			$query->execute(array(
				'room_nb' => $room_nb,
				'guests' => $guests,
				'nights' => $nights,
				'checkin' => $checkin,
				'hotel' => $hotel,
				'user_id' => $user,
				'price' => $price,

			));

			return true;

		} catch (Exception $e) {
			echo $e->getMessage();
			echo "try again";
			return false;
		}
	}

	$callback = booking_submit($_POST);

	$latest = $connection->lastInsertId();

	if ($callback) {?>
        <style type="text/css">
            body {
                color:#fff;
                background: url("assets/images/bg3.jpg") no-repeat center center fixed !important;
         }
     </style>

     <div class="col-sm-4 col-md-4 col-lg-4 col-lg-offset-3" style="margin-top:4em">


        <form method="post" action="<?=$_SERVER['PHP_SELF'];?>" id="secure_p" name="secure_p">
            <label for="">Card type:</label>
            <div class="form-group">
                <input type="text" required="required" class="form-control" name="c_type" id="c_type">
            </div>
            <label for="">Card Serial</label>
            <div class="form-group">
                <input type="text" required="required" class="form-control" maxlength="16" name="card" id="card">
            </div>
            <label for="">Expiration date</label>
            <div class="form-group">
                <input type="date" required="required" class="form-control" name="exp" id="expDate">
            </div>
            <input type="hidden" name="booking_id" value="<?php echo $latest?>">
            <div class="form-group">
                <input type="submit" value="confirm" class="btn btn-info">
            </div>
        </form>

    </div>
    <script type="text/javascript">
    $(document).on('click', '#submit', function(event) {
        event.preventDefault();
        var card = $('#card').val();
    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: {param1: 'value1'},
    })
    .done(function() {
        alert("form successfully submited Thanks!");
    });
    });
</script>
    <?php }
} elseif (isset($_POST['card'])) {
	function payment_submit() {

		global $connection;

		$card = mysql_escape_string($_POST['card']);
		$card_type = mysql_escape_string($_POST['c_type']);
		$exp = mysql_escape_string($_POST["exp"]);
		$user = mysql_escape_string($_SESSION["user_id"]);
		$latest = mysql_escape_string($_POST['booking_id']);

		try
		{
			$query = $connection->prepare("insert into hl_users_infos
				(user_credit_card, user_credit_card_type, hl_users_user_id, user_credit_card_exp, hl_booking_id)
				values(:card, :card_type, :user_id, :exp, :booking )");

			$query->execute(array(
				'card' => $card,
				'card_type' => $card_type,
				'exp' => $exp,
				'user_id' => $user,
				'booking' => $latest,

			));

			$_POST['latest'] = $connection->lastInsertId();

			return true;

		} catch (Exception $e) {
			echo $e->getMessage();
			echo "try again";
			return false;
		}
	}

	$callback2 = payment_submit($_POST);

	if ($callback2) {

		function payment_validation() {

			global $connection;

			try {

				$query = $connection->prepare("insert into hl_payment
                    (hl_users_infos_user_info_id)
                    values(:payment_infos )");

				$query->execute(array(
					'payment_infos' => mysql_escape_string($_POST['latest']),

				));

				return true;

			} catch (Exception $e) {
				echo $e->getMessage();
				echo "try again";
				return false;
			}
		}

		$callback3 = payment_validation($_POST);

		if ($callback3) {
			echo "<div class='col-sm-8 col-sm-offset-1' style='margin-top:2em'>
            <div class='alert alert-info'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
                  &times;
              </button>
              thanks for your reservation
          </div>
      </div> ";

		} else {
			echo "We encountered a probleme during the payment process, check your infos and try again";

		}
	} else {
		echo "We encountered a probleme during the payment process, check your infos and try again";
	}

}