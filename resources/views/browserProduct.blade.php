
<html>
<title>Browser Products</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="{{ url('js/showCartAmount.js') }}"></script>
  <script src="{{ url('js/browserProduct.js') }}"></script>
  <script src="{{ url('js/categoryNode.js') }}"></script>

<style>
.w3-sidebar a {font-family: "Roboto", sans-serif}
body {
	font-family: "微软雅黑";
	background-image: url( "../../imgs/b2.jpg");

	  background-attachment: fixed;
	  background-repeat: no-repeat;
	  background-position: center;
	  background-size: cover;
}

	.abgne_tip_gallery_block {
	  margin: 0;
	  padding: 0;
	  width: 213px;
	  height: 213px;
	  overflow: hidden;
	  position: relative;
	}
	.abgne_tip_gallery_block img {
	  position: absolute;
	  border: 0;
	}
	.abgne_tip_gallery_block .caption {
	 position: absolute;
	 top: 173px; /* .abgne_tip_gallery_block 的高 - 想顯示 title 的高(這邊是設 55) */
	 width: 100%; /* .abgne_tip_gallery_block 的寬 - .caption 的左右 padding */
	 padding: 10px 10px 10px;
	 cursor: pointer;
	 color: #fff;
	 background: url(https://goo.gl/8nT7pc) repeat;opacity:0.7;
	}
	.abgne_tip_gallery_block .caption h4 {
	  margin: 0;
	  padding: 0px 0px 10px;
	}
	.abgne_tip_gallery_block .caption h4 a {
	  text-decoration: none;
	  color: #fff;
	}
	.abgne_tip_gallery_block .caption h4 a:hover {
	  text-decoration: underline;
	}
</style>
<script>

  $(document).ready(function () {

	var data = (function () {
		$.ajax({
			async: false,
			global: false,
			url: "../categoryTree/makeJson.php",
			dataType: "json",
			success: function (product) {
				data = new CategoryTree(product);
			}
		});
		return data;
	})();

	setOption(data.layer1, "#sel1", data.categoryMap);

	$(document).on("change", "#sel1", function () {
		$('#sel2').empty();
		$('#sel3').empty();
		for(value in data.layer1){
			if( $('#sel1').val() == data.layer1[value].categoryID ){
				setOption(data.layer1[value].children, "#sel2");
			}
		}
	});
	//雙重保證
	$(document).on("change", "#sel2", function () {
		$('#sel3').empty();
		for(value in data.categoryMap){
			if($('#sel2').val() == data.categoryMap[value].categoryID){
			setOption(data.categoryMap[value].children, "#sel3");
			}
		}
	});
	$(document).on("click", "#sel2", function () {
		$('#sel3').empty();
		for(value in data.categoryMap){
			if($('#sel2').val() == data.categoryMap[value].categoryID){
			setOption(data.categoryMap[value].children, "#sel3");
			}
		}
	});
	//雙重保證
  });

  function setOption(layer1, id, categoryMap){
	for(value in layer1){
		$(id).append($("<option value='" + layer1[value].categoryID + "'>" + layer1[value].categoryName + "</option>"));
	}
	for(value in layer1){
		if( $('#sel1').val() == layer1[value].categoryID ){
			setOption(layer1[value].children, "#sel2");
		}
	}
	for(value in categoryMap){
		if($('#sel2').val() == categoryMap[value].categoryID){
		setOption(categoryMap[value].children, "#sel3");
		}
	}
  }
</script>
<body class="w3-content" style="max-width:1200px">

<!-- Sidebar (hidden by default) -->
<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-large w3-animate-left" style="display:none;z-index:2;width:20%;min-width:150px" id="mySidebar">


    <i onclick="w3_close()" class="fa fa-remove w3-button w3-display-topright"></i>

    <br><br>

	<div style="text-align:center;"><img src="../../imgs/LOGO4.png" style="width:100px; margin-top:-12px;"></div>
	<br>

	<button onclick="return myAccFunc(this);" class="btn btn-link w3-block w3-white w3-left-align" id="user" value="1" style="display:inline;"></button>
	<div name="demoAcc" class="w3-bar-block w3-hide w3-padding-large w3-medium" id="demoAcc1">
			<a href="#" class="w3-bar-item w3-button" onclick="window.location = 'http://localhost:8001/test';">個人資訊</a>
		<a href="#" class="w3-bar-item w3-button" id="navPoint">點數</a>
		<a href="https://wtlab.ddns.net\wtlab108\viewCard\view.html" class="w3-bar-item w3-button" >名片</a>
	</div>

	<button onclick="return myAccFunc(this);" class="btn btn-link w3-block w3-white w3-left-align" id="cart" value="2" style="display:inline;"></button>
	<div name="demoAcc" class="w3-bar-block w3-hide w3-padding-large w3-medium" id="demoAcc2">
		<a href="../../orderWithIOTA/cart.php?storeID=1" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-shopping-cart" style="display:inline;"></span>&nbsp 我們家 & Starbox 冷飲站</a>
		<a href="../../orderWithIOTA/cart.php?storeID=0" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-shopping-cart" style="display:inline;"></span>&nbsp Super WTLab's Shop</a>
	</div>

	<a href="http://localhost:8008/viewOrder" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-list-alt" style="display:inline;"></span>&nbsp 查看購買紀錄</a>

	<button onclick="return myAccFunc(this);" class="btn btn-link w3-block w3-white w3-left-align" value="3" style="display:inline;"><span class="glyphicon glyphicon-home" style="display:inline;"></span> &nbsp SHOP <i class='fa fa-caret-down'></i></button>
	<div name="demoAcc" class="w3-bar-block w3-hide w3-padding-large w3-medium" id="demoAcc3">
		<a href="/browserProduct?shopID=1" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-home" style="display:inline;"></span>&nbsp 我們家 & Starbox 冷飲站</a>
		<a href="/browserProduct?shopID=0" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-home" style="display:inline;"></span>&nbsp Super WTLab's Shop</a>
	</div>


	<a data-toggle="tab" class="w3-bar-item w3-button" onclick="logout();"><span class="glyphicon glyphicon-log-out"></span> 登出</a>

</nav>



<!-- Top menu -->
<div class="w3-top">
  <div class="w3-black w3-xlarge" style="max-width:1200px;">
    <div class="w3-button w3-padding-16 w3-left" onclick="w3_open()">☰</div>
    <div class="w3-right w3-padding-16" id="navRight"></div>
    <div class="w3-center w3-padding-16"><img src="../../imgs/LOGO4.png" style="width:40px; margin-top:-12px;">&nbsp My Shop</div>
  </div>
</div>


<!-- !PAGE CONTENT! -->

	<br>
	<br>

<div class="w3-row">



  <!-- Product grid -->
  <div class="w3-container">

    <!-- Push down content on small screens
  <div class="w3-hide-large" style="margin-top:83px"></div>
-->
  <!-- Top header -->
  <br><br>
  <header class="w3-container w3-xlarge w3-center">
    <h1 class="w3-center" id="shopName"></h1>
  </header>


  <div class="w3-container w3-center">

	  <br>
	  <br>

		<i class="fa fa-search"></i>
  		關鍵字搜尋：<br>
		<input type="text" name="query" id="query" list="keyword_list" style="width:40%; border-radius:10px;" autocomplete="off" placeholder="  輸入關鍵字">
		<button type='button' class='btn btn-info' id='keywordQueryBtn' onclick='keywordQuery();'>送出</button>
		<button type='button' class='btn btn-info' id='delKeywordQueryBtn' onclick='emptyBlock();init();'>清除</button>
		<div id="hint"></div>
		<br>

	  <br>

		<i class="fa fa-search"></i>
		種類搜尋：<br>
	    <select id="sel1" name="sel1"></select> &nbsp
		<select id="sel2" name="sel2"></select> &nbsp
		<select id="sel3" name="sel3"></select> &nbsp
		<button type='button' class='btn btn-info' onclick='checkForm();'>搜尋</button>

  </div>

	<br><br>
	<div class="w3-container w3-center">

      <div class="w3-container w3-third" id="block1"></div>
      <div class="w3-container w3-third" id="block2"></div>
      <div class="w3-container w3-third" id="block3"></div>
	  <br><br>
      <div class="w3-container w3-third" id="block4"></div>
      <div class="w3-container w3-third" id="block5"></div>
      <div class="w3-container w3-third" id="block6"></div>
	  <br><br>
      <div class="w3-container w3-third" id="block7"></div>
      <div class="w3-container w3-third" id="block8"></div>
      <div class="w3-container w3-third" id="block9"></div>
	  <br><br>
      <div class="w3-container w3-third" id="block10"></div>
      <div class="w3-container w3-third" id="block11"></div>
      <div class="w3-container w3-third" id="block12"></div>

	</div>

	</br></br>

	  <div class="w3-container w3-text-grey">
		<p id="pagination" style="text-align:center;"></p>
	  </div>


  </div>



  <!-- Footer -->
  <footer class="w3-black w3-padding-32 w3-small w3-center" id="footer">
    <h4>版權所有 © WTLAB</h4>
  </footer>

  <!-- End page content -->
</div>



</body>
</html>
