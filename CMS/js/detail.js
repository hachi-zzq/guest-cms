window.onload = function () {
	var comment = document.getElementById('comment');
	comment.onsubmit = function(){
		if(comment.content.value.length == 0 ||comment.content.value.length>255){
			alert('内容不能为空，并且长度不得超过255位');
			comment.content.focus();
			return false;
		}
		if(comment.code.value.length!=4){
			alert('验证码产度必须是四位');
			comment.code.focus();
			return false;
		}
	}
};