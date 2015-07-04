window.onload = function(){
	var uploads = document.getElementById('uploads');
	uploads.onclick =function(){
		window.open('up_img.php?url='+this.title,'up_img','width=500,height=150');
	}
	var fm = document.getElementsByTagName('form')[0];
	fm.onsubmit = function (){
		if(fm.name.value.length < 3){
			alert('图片名称不得少于四位');	
			return false;
		}
		if(fm.url.value.length == 0){
			alert('地址不能为空');	
			return false;
		}
	}
	
}
