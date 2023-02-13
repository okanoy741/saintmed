
<!DOCTYPE html>
<html>
<head>
    <title>Saintmed</title>
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="../saleAdminCss.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src= "//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> 
    <script src= "//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script> 
	<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
	<script>
		document.onkeydown=function(evt){
			var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
			if(keyCode == 13)
			{
            //your function call here
            document.search.submit();
        }
    }
</script>
</head>
<body class="align">

    <div class="headder">
    
<div class="menu" onclick="javascript: this.classList.toggle('active');">
  <i class="line">
    <ul class="nav">
      <li> <a href="http://saintmed.dyndns.biz/">Home </a></li>
	  <li> <a href="http://saintmed.dyndns.biz/tenders/tender_list.asp"> | งานโครงการ </a></li>
      <li> <a href="http://saintmed.dyndns.biz/tenders/tender_due.asp"> | กำหนดส่งงาน </a></li>

    </ul>
  </i><i class="line"></i><i class="line"></i>
</div>

    <ul class="nav1">
      <li> <a href="http://saintmed.dyndns.biz/"> <img class="logo" src="../img/saintmed_logo_H.png">  </a></li>
	  <li> <a href="http://saintmed.dyndns.biz/tenders/tender_list.asp"> | งานโครงการ </a></li>
      <li> <a href="http://saintmed.dyndns.biz/tenders/tender_due.asp"> | กำหนดส่งงาน </a></li>
      
    </ul>

</div>