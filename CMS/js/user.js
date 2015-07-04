window.onload = function () {
	var title = document.getElementById('title');
	var ol = document.getElementsByTagName('ol');
	var a = ol[0].getElementsByTagName('a');
 	for (i=0;i<a.length;i++) {
			a[i].className = null;
			if (title.innerHTML == a[i].innerHTML) {
				a[i].className = 'selected';
			}
	}
	var fm = document.getElementById('form');
		//alert(fm.face.options.length);
		fm.face.onchange = function(){
	//	alert(fm.face.options[fm.face.selectedIndex].value);
		fm.face_img.src = '../'+fm.face.options[fm.face.selectedIndex].value;
	}
	

};