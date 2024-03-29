<!DOCTYPE html>
<html>
<title>View Product</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ url('js/viewProduct.js') }}"></script>
<script src="{{ url('js/showCartAmount.js') }}"></script>

<style>
body,h1 {font-family: "Raleway", Arial, sans-serif}
h1 {letter-spacing: 6px}
.w3-row-padding img {margin-bottom: 12px}

.imgP{
	height:300px;
	border:5px #FFAC55 solid;
}
</style>

<script>

	var url=window.location.toString(); //取得當前網址
		var id=""; //參數中等號右邊的值
		if(url.indexOf("?")!=-1){ //如果網址有"?"符號
			id = decodeURI(url.split("?")[1].split("=")[1]);
		}

	var stock=0;
	$(function() {



		$.ajax({
			url:"/viewProduct1",
			type:"POST",
			dataType:'json',
			data:{"id": id},
			success: function(product){

				$("#productName").text(product[0].productName);
				$("#productPrice").html("<br>$"+product[0].productPrice);
				$("#productImg").html('<img src="../uploadImg/'+product[0].productImage+'" alt="Image" class="imgP">');
				$("#productDescription").html("<br><br><br><br> "+product[0].productDescription);

				if(product[0].stock <= 0){ //確認庫存
					$('#productName').prepend("<h1 style='color:red;'><strong>已售完!</strong><h1>");
					$('#productDescription').append("<h1 style='color:red;'>已售完!<h1>");
					$('#cartSub').attr("disabled", true);
				}
				stock=product[0].stock;
				var block = $('#block');
				var check = $('<a/>')
				.html('<input type="hidden" name="productName" value="'+product[0].productName+'">'+
					 '<input type="hidden" name="productPrice" value="'+product[0].productPrice+'">')
				.appendTo(block);
			},
			error: function(jqXHR, textStatus, errorThrown){    //失敗的時候跑的函式
			  console.log( errorThrown);
			}
		});


		$("#priceScroll").on("click", function(e){
		  $('html, body').animate({
			scrollTop: $("#productPrice").offset().top  // 只需修改此處
		  }, 750);  // 750是滑動的時間，單位為毫秒
		  e.preventDefault();
		});

		$("#descriptionScroll").on("click", function(e){
		  $('html, body').animate({
			scrollTop: $("#productDescription").offset().top  // 只需修改此處
		  }, 750);  // 750是滑動的時間，單位為毫秒
		  e.preventDefault();
		});


	});

	function amountFunc(value){
		var num = $("#number").val();
		var flag = true;
		if($("#number").val() < 2){
			flag = false;
		}
		if(value == "plus"){
			flag = true;
			num++;
			$("#number").val(num);
		}
		else if(value == "subtract" && flag==true){
			num--;
			$("#number").val(num);
		}

		if(num == stock){
			$('#plus').attr("disabled", true);
		}
	}
</script>
<body>
<!-- Sidebar (hidden by default) -->
<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-large w3-animate-left" style="display:none;z-index:2;width:20%;min-width:150px" id="mySidebar">


    <i onclick="w3_close()" class="fa fa-remove w3-button w3-display-topright"></i>

    <br><br>
	<div style="text-align:center;"><img src="../../imgs/LOGO4.png" style="width:100px; margin-top:-12px;"></div>
	<br>

	<button onclick="return myAccFunc(this);" class="btn btn-link w3-block w3-white w3-left-align" id="user" value="1" style="display:inline;"></button>
	<div name="demoAcc" class="w3-bar-block w3-hide w3-padding-large w3-medium" id="demoAcc1">
		<a href="#" class="w3-bar-item w3-button" onclick="window.location = '../../personalInfo.html';">個人資訊</a>
		<a href="#" class="w3-bar-item w3-button" id="navPoint">點數</a>
		<a href="https://127.0.0.1\wtlab108\viewCard\view.html" class="w3-bar-item w3-button" >名片</a>
	</div>

	<button onclick="return myAccFunc(this);" class="btn btn-link w3-block w3-white w3-left-align" id="cart" value="2" style="display:inline;"></button>
	<div name="demoAcc" class="w3-bar-block w3-hide w3-padding-large w3-medium" id="demoAcc2">
		<a href="../../orderWithIOTA/cart.php?storeID=1" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-shopping-cart" style="display:inline;"></span>&nbsp 我們家 & Starbox 冷飲站</a>
		<a href="../../orderWithIOTA/cart.php?storeID=0" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-shopping-cart" style="display:inline;"></span>&nbsp Super WTLab's Shop</a>
	</div>

	<a href="../../orderWithIOTA/viewOrder.html" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-list-alt" style="display:inline;"></span>&nbsp 查看購買紀錄</a>

	<button onclick="return myAccFunc(this);" class="btn btn-link w3-block w3-white w3-left-align" value="3" style="display:inline;"><span class="glyphicon glyphicon-home" style="display:inline;"></span> &nbsp SHOP <i class='fa fa-caret-down'></i></button>
	<div name="demoAcc" class="w3-bar-block w3-hide w3-padding-large w3-medium" id="demoAcc3">
		<a href="../browserProducts/browserProduct.html?shopID=1" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-home" style="display:inline;"></span>&nbsp 我們家 & Starbox 冷飲站</a>
		<a href="../browserProducts/browserProduct.html?shopID=0" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-home" style="display:inline;"></span>&nbsp Super WTLab's Shop</a>
	</div>


	<a data-toggle="tab" class="w3-bar-item w3-button" onclick="logout();"><span class="glyphicon glyphicon-log-out"></span> 登出</a>

</nav>

<!-- Top menu -->
<div class="w3-top">
  <div class="w3-black w3-xlarge" style="max-width:1200px;margin:auto">
    <div class="w3-button w3-padding-16 w3-left" onclick="w3_open()">☰</div>
    <div class="w3-right w3-padding-16 user" id="navRight"></div>
    <div class="w3-center w3-padding-16"><img src="../../imgs/LOGO4.png" style="width:40px; margin-top:-12px;">&nbsp My Shop</div>
  </div>
</div>

<!-- !PAGE CONTENT! -->
<div class="w3-content" style="max-width:1500px">

<!-- Header -->
<header class="w3-panel w3-center w3-opacity" style="padding:128px 16px">
  <h1 id="productName"></h1>

  <div class="w3-padding-32">
    <div class="w3-bar w3-border">
      <a href="" id="descriptionScroll" class="w3-bar-item w3-button">簡介</a>
      <a href="" id="priceScroll" class="w3-bar-item w3-button w3-light-grey">價格</a>
    </div>
  </div>
</header>

	<div class="w3-center" id="productImg" style="margin-top:-100px;margin-bottom:150px;"></div>

	<div class="w3-center" id="productDescription" style="font-size:25px;margin-top:100px;margin-bottom:150px;"></div>

	<div class="w3-center" id="productPrice" style="font-size:50px;margin-top:150px;margin-bottom:80px;"></div>

	<form method="post" id="myform" action="/addcart">
        <div class="container w3-center" style="margin-bottom:150px;">
					<!--haru偷偷加的-->
						 <input type="text" id="productID" name="productID" value="1"  hidden="hidden">
					<!--haru偷偷加的-->
		<div id="block" class="col-sm-12"></div>


		<button type="button" id="subtract" value="subtract" class="btn btn-primary" onclick="amountFunc(this.id);" >-</button>
		<input type="text" name="number" id="number" value="1" style="border-radius:9px;width:40px;height:40px;text-align:center" readonly="readonly" />
		<button type="button" id="plus" value="plus" class="btn btn-primary" onclick="amountFunc(this.id);">+</button>

		<br><br><br>

		<font style="font-size:20px;">備註</font><br>
		<textarea style="width:300px;height:150px;" name='remark'></textarea>

		<br><br><br>

		<button type="submit" id="cartSub" name="cart" class="btn btn-primary" >加入購物車</button>

        </div>

	</form>


<!-- End Page Content -->
</div>


</div>
<!-- Footer -->
  <footer class="w3-black w3-padding-32 w3-small w3-center" id="footer">
    <h4>版權所有 © WTLAB</h4>
  </footer>

</body>
</html>
