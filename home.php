<div class="container">

            <?php
setcookie("Remember"
	, ""
	, time() + 60 * 60
	, "/students"
	, "farthing.ex.ac.uk"
	, false
	, true);
?>

        <!-- Collect the nav links, forms, and other content for toggling -->

            <?php
if (isset($_COOKIE['TestCookie'])) {
	echo "<a href='#''>Welcome back!</a>";
} else {
	echo "";
}
?>

<?php
include 'connect.php';
include_once 'header.php';

$cities = select_query("hl_cities");

if ($cities) {

	?>

<div class="row">
    <h2 style="padding-left:15px;font-family:Lucida Console;color:#4d79ff">Place</h2>
        <form method="post" action="<?=$_SERVER['PHP_SELF'];?>" id="city" name="city">
            <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                    <select  name="cities" id="cities" class="form-control" required>
                        <option value="0">Choose a city</option>
                        <?php foreach ($cities as $city) {?>
                            <option value='<?php echo $city["city_id"];?>'><?php echo $city["city_name"];?></option>
                        <?php }
	?>
                    </select>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                    <select  name="rooms" id="rooms" class="form-control" required>
                        <option value="0">Room(s)</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                        <option value='5'>5</option>
                        <option value='6'>6+</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" value="Submit" class="btn btn-info"/>
            </div>
        </form>
    </div>


<?php
}
if (isset($_POST['cities'])) {
	function get_hotel() {
		global $connection;

		try
		{
			$query = $connection->query("SELECT * FROM hl_hotel
                                        WHERE hl_cities_cities_id ='" . mysql_real_escape_string($_POST["cities"]) . "'
                                        and hotel_rooms >= '" . mysql_real_escape_string($_POST["rooms"]) . "'");
			$hotels = $query->fetchAll();
			return $hotels;
		} catch (Exception $e) {
			return false;
		}
	}
	$hotels = get_hotel($_POST);

	foreach ($hotels as $hotel) {
		?>
        <div class="col-sm-8" style="padding-top:1.5em;">
            <table class="table table-bordered table-hover">
                <thead>
                   <th>
                     Hotel
                   </th>
                    <th>
                     Address
                   </th>
                   <th>
                     Zip
                   </th>
                    <th>
                     Select this hotel
                   </th>
                </thead>
                <tbody>
                   <tr>
                     <td>
              <?php echo "<a href='booking.php?id=" . $hotel["hotel_id"] . "'>" . $hotel['hotel_name'] . "</a>"?>
                     </td>
                     <td>
              <?php echo $hotel['hotel_address'];?>
                     </td>
                     <td>
              <?php echo $hotel['hotel_zip'];?>
                     </td>
                     <td>
              <?php echo "<a href='booking.php?id=" . $hotel["hotel_id"] . "'>Select this hotel</a>";?>
                     </td>
                   </tr>

                </thbody>
            </table>
        </div>
<?php
}
}
?>
</div>
</div>
<?php include_once 'footer.php';?>
<script>
    jQuery(document).ready(function($) {
        $(document).on('click', '#submit', function(event) {
            event.preventDefault();
        var error = false;
        if ($('#email').val()=="") {
            var error = true;
            $('#email').addClass('error').focus(function(event) {
                $(this).removeClass('error');
            });
        }else if($('#password').val()==""){
            var error = true;
            $('#password').addClass('error').focus(function(event) {
                $(this).removeClass('error');
            });
        }else{
            if (!error) {
                $('form').submit();
            }
        }
        });
    });
</script>