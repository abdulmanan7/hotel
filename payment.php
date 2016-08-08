<?php
include_once('header.php');


if(isset($_POST['room'])){



    function booking_submit(){

        global $connection;

        $room_nb= $_POST['room'];
        $guests= $_POST['guests'];
        $nights = $_POST["nights"];
        $checkin = $_POST["checkin"];
        $hotel = $_POST["hotel"];
        $user = $_SESSION["user_id"];
        $price = $_POST["price"];



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
                'price' => $price

            ));


            return true;

        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            echo "try again";
            return false;
        }
    }

    $callback = booking_submit($_POST);

    $latest = $connection->lastInsertId();

    if ($callback){ ?>
    <div class="col-sm-5 col-md-5 col-lg-5">
        
      
        <form method="post" action="<?=$_SERVER['PHP_SELF'];?>" id="secure_p" name="secure_p">
                <label for="">Card type:</label>
            <div class="form-group">        
                <input type="text" class="form-control" name="c_type">
            </div>
                <label for="">Card Serial</label>
            <div class="form-group">       
                <input type="text" class="form-control" maxlength="16" name="card">
            </div>       
                <label for="">Expiration date</label>
            <div class="form-group">
                <input type="date"  class="form-control" name="exp">
            </div>    
                <input type="hidden" name="booking_id" value="<?php echo $latest?>">
            <div class="form-group">    
                <input type="submit" value="confirm" class="btn btn-info">
            </div>    
        </form>

    </div> 
    <?php  }
}

elseif (isset($_POST['card']))
{
    function payment_submit(){


        global $connection;

        $card= $_POST['card'];
        $card_type= $_POST['c_type'];
        $exp = $_POST["exp"];
        $user = $_SESSION["user_id"];
        $latest = $_POST['booking_id'];



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
                'booking' => $latest

            ));

            $_POST['latest'] = $connection->lastInsertId();


            return true;

        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            echo "try again";
            return false;
        }
    }




    $callback2 = payment_submit($_POST);


    if($callback2) {

        function payment_validation()
        {

            global $connection;




            try {


                $query = $connection->prepare("insert into hl_payment
				(hl_users_infos_user_info_id)
				values(:payment_infos )");

                $query->execute(array(
                    'payment_infos' => $_POST['latest']

                ));


                return true;

            } catch (Exception $e) {
                echo $e->getMessage();
                echo "try again";
                return false;
            }
        }

        $callback3 = payment_validation($_POST);

        if($callback3){
            echo "<div class='alert alert-info' style='max-width:20em'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
                       &times;
                    </button>
                      thanks for your reservation
                  </div>";

        }
       else{
           echo "We encountered a probleme during the payment process, check your infos and try again";

       }
    }

        else{
             echo "We encountered a probleme during the payment process, check your infos and try again";
        }

}