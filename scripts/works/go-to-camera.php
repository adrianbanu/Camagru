<h2>Works</h2><br/>


<div id="camera-and-filters">
	<div id="camera" ondrop="drop(event)" ondragover="allowDrop(event)">
		<canvas id="canva_filters" width="400px" height="300px"></canvas>
		<video id="video" width="400px" height="300px" autoplay></video>
		<canvas id="canvas" width="400px" height="300px"></canvas>
		<img src="../../img/empty.png" style="width:100%;">

	</div>

</div>
	<br/>
	<div id="side">
		<img src="../../img/arrow-left.png" id="arrow-left" onclick='to_top()'/>
		<div id="filters">
			<?php
			include '../functions/filter_functions.php';

			$data = get_filters();
			foreach ($data as $filter)
			{
				echo "<img src='../../".$filter['path_filter']."' class='hidden_path' id='".$filter['id_filter']."'/>";
			}
			for ($i = 0; $i < 5; $i++)
			{
				echo "<div class='filter' style='display:block;'>";
				echo "<img src='' class='image_filter' draggable='true' ondragstart='drag(event)' id=''/>";
				echo "</div>";
			}

			?>

		</div>
		<img src="../../img/arrow-right.png" id='arrow-right' onclick='to_bot()'/>

	</div>

	<div id="move">
		<br/>
		<img src="../../img/more.png" onclick='do_plus()'/>
		<img src="../../img/less.png" onclick="do_less()"/>
		<img src="../../img/left.png" onclick="do_left()"/>
		<img src="../../img/right.png" onclick="do_right()"/>
		<img src="../../img/up.png" onclick="do_top()"/>
		<img src="../../img/down.png" onclick="do_bot()"/>
		<img src="../../img/reset.png" onclick="do_reset()"/>
		<br/>
	</div>
<br/>
<div id="buttons">
	<?php
	if (isset($_SESSION['print_file_uploaded']) && $_SESSION['print_file_uploaded'])
	{
		echo "<button id='reset'>Back to camera</button>";
	}
	else {
		echo "<button id='reset'>Reset camera</button>";
	}
	?>
	<button id="snap">Take photo</button>
	<button id="save">Save</button>
	<form method="post" accept-charset="utf-8" name="form1">
		<input name="hidden_data" id="hidden_data" type="hidden"/>
		<input name="hidden_data2" id="hidden_data2" type="hidden"/>
	</form>

</div>

<br/><br/>

<p class='text'>You can upload an image instead of using the camera</p>
<form method="post" action="reception.php" enctype="multipart/form-data">
	<p class='text'>File (Only png format, 2 Mb max, max width 800, max height 600):</p><br />
	<input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
	Select a file: <input type="file" name="image" id="image" /><br /><p></p>
	<input type="submit" name="submit" value="Send" />
</form>
	<?php
	include '../../errors.php';
	send_image_error();
	if (isset($_SESSION['print_file_uploaded']) && $_SESSION['print_file_uploaded'])
	{
		echo $_SESSION['print_file_uploaded'];
		$_SESSION['print_file_uploaded'] = NULL;
	}

	?>

		<script src="filter-effects.js"></script>
		<script src="drag-and-drop.js"></script>
		<script src="modify-filters.js"></script>
		<script src="camera_handle.js"></script>


	<br/><br/><div class="gallery" id="photos"></div>

</div>
