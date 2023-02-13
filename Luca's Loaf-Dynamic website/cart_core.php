<?php include('admin/config.php');

	if(isset($_POST["add_to_cart"]))
	{
		$url = $_POST["url"];
		$food_name = $_POST["hidden_name"];
		if(isset($_COOKIE["shopping_cart"]))
		{
			$cookie_data = stripslashes($_COOKIE['shopping_cart']);

			$cart_data = json_decode($cookie_data, true);
		}
		else
		{
			$cart_data = array();
		}

		$item_id_list = array_column($cart_data, 'item_id');

		if(in_array($_POST["hidden_id"], $item_id_list))
		{
			foreach($cart_data as $keys => $values)
			{
				if($cart_data[$keys]["item_id"] == $_POST["hidden_id"])
				{
					$cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
				}
			}
		}
		else
		{
			$item_array = array(
				'item_id'			=>	$_POST["hidden_id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_img'			=>	$_POST["hidden_img"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$cart_data[] = $item_array;
		}

		
		$item_data = json_encode($cart_data);
		setcookie('shopping_cart', $item_data, time() + (86400 * 30));
		$_SESSION['add_to_cart'] = "<div class='success text-center'><b>$food_name</b> add to cart.</div>";
		header("location:$url");
	}

	if(isset($_GET["action"]))
	{
		if($_GET["action"] == "delete")
		{
			$url = $_GET["url"];
			$food_name = $_GET["food"];
			$cookie_data = stripslashes($_COOKIE['shopping_cart']);
			$cart_data = json_decode($cookie_data, true);
			foreach($cart_data as $keys => $values)
			{
				if($cart_data[$keys]['item_id'] == $_GET["id"])
				{
					unset($cart_data[$keys]);
					$item_data = json_encode($cart_data);
					setcookie("shopping_cart", $item_data, time() + (86400 * 30));
					$_SESSION['add_to_cart'] = "<div class='success text-center'><b>$food_name</b> remove from cart.</div>";
					header("location:$url");
				}
			}
		}
		
		if($_GET["action"] == "clear")
		{
			$url = $_GET["url"];
			setcookie("shopping_cart", "", time() - 3600);
			header("location:$url");
		}
		
		if($_GET["action"] == "order_success")
		{
			$url = $_GET["url"];
			setcookie("shopping_cart", "", time() - 3600);
			$_SESSION['order'] = "<div class='success text-center'>Food ordered successfully.</div>";
			header("location:$url");
		}
	}
