<?php
include "head.php";
?>
<div class="grid3">
    <p id ="headr2">ข้อมูลการจับคู่เลขที่สินค้ากับเลขที่ อย.</p>
</div>
<div class="grid4">
 <form action="../FDA/insert_new_fda.php" method="POST">
    <div class="">
        <div class="col-lg-12">
            <!-- <div id="row">
                <div class="input-group m-3">
                    <div class="input-group-prepend">
                        <button class="btn btn-danger" id="DeleteRow" type="button">
                        <i class="bi bi-trash"></i>
                        Delete
                    </button>
                </div>
                <input type="text" class="form-control m-input" name="item[]"  placeholder="----- เลขที่ใบอณุญาต ------"> &nbsp;&nbsp;
                <input type="text" class="form-control m-input2" name="item[]" placeholder="----- รายละเอียดสินค้า ------"> &nbsp;&nbsp;
                <input type="text" class="form-control m-input3" name="item[]" placeholder="----- รุ่น ------"> &nbsp;&nbsp;
                <input type="date" class="form-control m-input4" name="item[]" >
            </div>
        </div> -->
        
        <div id="newinput"></div>
        <button id="rowAdder" type="button"
        class="btn btn-dark">
        <span class="bi bi-plus-square-dotted">
        </span> ADD 
    </button>
</div>
</div>
<input type="submit" value="บันทึก" >
</form>


</form>
</div>

<script type="text/javascript">
    var i = 0;
    $("#rowAdder").click(function () {
        i =i+1;
        newRowAdd =
        '<div id="row"> <div class="input-group m-3">' +
        '<div class="input-group-prepend">' +
        '<button class="btn btn-danger" id="DeleteRow" type="button">' +
        '<i class="bi bi-trash"></i> Delete</button> </div>' +
        '<input type="text"  class="form-control m-input" name="item1'+i+'" placeholder="----- เลขที่ใบอณุญาต ------"> &nbsp;&nbsp; <input type="text" class="form-control m-input2" name="item2'+i+'" placeholder="----- รายละเอียดสินค้า ------"> &nbsp;&nbsp; <input type="text" class="form-control m-input3" name="item3'+i+'" placeholder="----- รุ่น ------"> &nbsp;&nbsp; <input type="date" class="form-control m-input4" name="item4'+i+'"> </div> </div>';

        $('#newinput').append(newRowAdd);
        $('#newinput').insertBefore(html);
    });

    $("body").on("click", "#DeleteRow", function () {
        $(this).parents("#row").remove();
    })





</script>

<script>
    var submit = document.querySelector("input[type=submit]");

/* set onclick on submit input */   
    submit.setAttribute("onclick", "return test()");

//submit.addEventListener("click", test);

    function test() {

      if (confirm('กรุณาตรวจสอบข้อมูล ถูกต้องหรือไม่?')) {         
        return true;         
    } else {
        return false;
    }

}
</script>

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