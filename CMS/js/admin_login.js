window.onload = function(){
	var fm = document.getElementById('adminLogin');
	fm.onsubmit = function(){
		if(fm.code.value.length != 4){
			alert('验证码必须是四位');
			return false;
		}
		if(fm.admin_user.value.length <=2){															//验证用户名
			alert('用户名不得小于两位');
			return false;
		}
		if(fm.admin_pass.value.length < 6){
			alert('密码不能少于六位');
			return false;
		}
	}
	return true;
}
