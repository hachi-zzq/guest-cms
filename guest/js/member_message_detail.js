window.onload = function(){
	var ret = document.getElementById('return');
	var del =document.getElementById('delete');
	ret.onclick = function(){
		history.back();
	}
	del.onclick = function(){
		//confirm 是弹出一个窗口，“确定”为真，“取消”为假
		if(confirm('确定要删除这条短信么？')){
			location.href='?action=delete&id='+this.name;
		}
	}
};