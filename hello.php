<?php
/*
Plugin Name: Bhanu Pratap
Description: This is custom wordpress plugin that will delete and show posts you have to use shortcode BHANUPRATAP for use this plugin
Author: bhanu pratap
Version: 1.0
Author URI: 
*/
?>
<?php
register_activation_hook(__FILE__,'active');
register_deactivation_hook(__FILE__,'deactive');
function active()
{
// code that will run when active button hit	
}
function deactive()
{
	//code that will execute when deactivate button hit
}

function clear_old_posts()
{
	
	global $wpdb;


	$qry = "DELETE from wp_posts where post_type='post'AND post_date < CURRENT_DATE()";
	$d = $wpdb->query($qry);
	if($d == true)
	{
		echo "Post is deleted";
	}
	else {
		echo "Old Post is not avilable";
	}
}



function hello()
{
	
	//echo "<?php esc_html_e( 'Welcome to my custom admin page.', 'my-plugin-textdomain');";
	echo "<form action='' method='POST'>";
	echo "<input type=submit name='clear' value='Clear Old Post'/>";
	echo "<input type=submit name='show' value='Show All Post'/>";
	echo "<input type=submit name='unset' value='Hide All Post'/>";
	echo "</form><br>";


	//clear old post
	if(isset($_POST['clear']))
	{
		clear_old_posts();
	}
	//hide post
	if (isset($_POST['unset'])) {
		unset($_POST['show']);
	}
	//display post
	if (isset($_POST['show'])) {
		$args = array(
			'numberposts' => 1000000
		);

		$latest_posts = get_posts($args);
		echo "<table border=2>";
		foreach ($latest_posts as $res) {
			echo "<tr><th>Post ID</th>   <th>Title of Post</th>     <th>Post Description</th> <th>Post Date</th></tr>";
			echo "<tr><td>$res->ID</td>  <td>$res->post_title</td> <td>$res->post_content</td> <td>$res->post_date</td> </tr>";
		}
		echo "</table>";
	}
}



 add_action('admin_menu', 'my_setup_menu');
 function my_setup_menu(){
add_menu_page( 'BHANU', 'BHANU PRATAP', 'manage_options', 'test-plugin', 'bhanu_function' );
		  }
		  
		  function bhanu_function()
		  {
			  echo"<h1><i>Custome Menu creatred by bhanu...To use this plugin plz paste shortcode [BHANUPRATAP] in your page</i></h1>";
		  }

	
add_shortcode('BHANUPRATAP', 'hello');
?>

