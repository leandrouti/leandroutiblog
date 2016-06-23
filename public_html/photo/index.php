<?php

	include('../../include/basic.php');
	include('../../include/postList_class.php');
	//show index page with all blog titles, part of the body text and a read more link

	//FlickR info
	$api_key = 'bba97c487b7208a2612e6c48c0bcbdb0';
	$secret = '8555a02805f776a1';
	$flickr_url = 'https://api.flickr.com/services/rest/?';
	$user_id = '22055371@N05';

	$layout = new Layout('..');

	$layout->printHeader('Photo');
	echo "<article><h2>Flickr</h2></a>";
	echo "<p>高解像度の写真は写真の上にクリックするかまた次のリンクに<a href=\"https://www.flickr.com/leandrouti/\">Flickr(https://www.flickr.com/leandrouti)</a>見ることができます。</p>";
	$method = "flickr.people.getPhotos";

	$data = file_get_contents($flickr_url . "&method={$method}&api_key={$api_key}&user_id={$user_id}&format=json");

	$data = str_replace("jsonFlickrApi(", '', $data);

	$data = rtrim( $data,")");


	$json_array = json_decode($data, true);
	$num_per_line = 1;
	foreach($json_array['photos']['photo'] as $value){
		//https://farm{farm-id}.staticflickr.com/{server-id}/{id}_{secret}.jpg
		$farm_id = $value['farm'];
		$server = $value['server'];
		$photo = $value['id'] . "_" . $value['secret'] . '_t.jpg';
		$photo_big = $value['id'] . "_" . $value['secret'] . '_z.jpg';
		$img = '<img src="https://farm' . $farm_id . '.staticflickr.com/' . $server . '/' . $photo . '" class="thumb">';

		$link = '<a href="https://farm' . $farm_id . '.staticflickr.com/' . $server . '/' . $photo_big . '">';
		if($num_per_line % 5 == 0){
			$img .= '<br>';
		}
		echo $link . $img . '</a>';
		$num_per_line++;

	}

	echo "</article>";
	$layout->printFooter();
?>
