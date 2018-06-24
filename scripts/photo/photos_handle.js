function increment_like(this_element){
	var nb_like = document.getElementById('compteur').innerHTML;
	nb_like++;
	this_element.removeAttribute ('onmouseout');
	this_element.removeAttribute ('onclick');
	this_element.setAttribute ('title', 'You already like this photo!');
	document.getElementById('compteur').innerHTML = nb_like;
	this_element.src = "../../img/thumbs-up_grey.png";
	var fd = new FormData(document.forms["form_photo"]);
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'update_nb_like_photo.php', true);
	xhr.send(fd);
    //see here as reference:
    //https://developer.mozilla.org/en-US/docs/Web/API/FormData/Using_FormData_Objects
}