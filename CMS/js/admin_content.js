window.onload = function(){

	var title = document.getElementById('title');
	var ol = document.getElementsByTagName('ol');
	var a = ol[0].getElementsByTagName('a');
 	for (i=0;i<a.length;i++) {
			a[i].className = null;
			if (title.innerHTML == a[i].innerHTML) {
				a[i].className = 'selected';
			}
	}

	

	
	var content  = document.getElementById('content');
	content.onsubmit = function(){
		if(content.title.value.length == 0){
			alert('标题不能为空');
			return false;
		}
		if(content.nav.value.length == 0){
			alert('必须选择一个栏目');
			return false;
		}
		if(content.content.value.length == 0){
				alert('正文不能为空');
				return false;
			}
	}

}

 function Open_Window(url,name,height,width){
 		 var left = (screen.width - 400) / 2;
		 var top = (screen.height - 100) / 2 - 100;
 	window.open(url,name,'height='+height+',width='+width+',top='+top+',left='+left);
 }
