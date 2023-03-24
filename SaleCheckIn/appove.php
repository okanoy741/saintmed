<?php
include "../SaleCheckIn/head.php";
session_start();
if (empty($_SESSION['USERNAME']) ) { 
 header("Location: ../SaleCheckIn/logininput.php?");
}

    require_once "../SaleCheckIn/conn.php";
    $comment = $_POST['comment'];
    $sql = $conn->query("UPDATE sale_check_in SET appove_status = '2', comment_am = '$comment' WHERE id = '".$_GET['ID']."' ");
   
    header("Location: ../SaleCheckIn/indexAM.php?");
?>

<script> 


    $(document).ready(function () {

        $('#nav').children('li').first().children('a').addClass('active')
        .next().addClass('is-open').show();

        $('#nav').on('click', 'li > a', function() {

            if (!$(this).hasClass('active')) {

                $('#nav .is-open').removeClass('is-open').hide();
                $(this).next().toggleClass('is-open').toggle();

                $('#nav').find('.active').removeClass('active');
                $(this).addClass('active');
            } else {
                $('#nav .is-open').removeClass('is-open').hide();
                $(this).removeClass('active');
            }
        });
    });


</script> 