window.onload = function () {
	var fm = document.getElementById('form');

	fm.onsubmit = function () {
				//验证码验证
		if (fm.code.value.length != 4) {
			alert('验证码必须是4位');
			fm.code.value = ''; //清空
			fm.code.focus(); //将焦点以至表单字段
			return false;
		}
		if (fm.username.value.length < 2 || fm.username.value.length > 20) {
			alert('用户名不得小于2位或者大于20位');
			fm.username.value = ''; //清空
			fm.username.focus(); //将焦点以至表单字段
			return false;
		}
		if (/[<>\'\"\ \　]/.test(fm.username.value)) {
			alert('用户名不得包含非法字符');
			fm.username.value = ''; //清空
			fm.username.focus(); //将焦点以至表单字段
			return false;
		}
		//密码验证
		if (fm.password.value.length < 6) {
			alert('密码不得小于6位');
			fm.password.value = ''; //清空
			fm.password.focus(); //将焦点以至表单字段
			return false;
		}
		
		if(fm.password.value!=fm.re_password.value){
			alert('两次密码不一致');
			fm.re_password.value = ''; //清空
			fm.re_password.focus(); //将焦点以至表单字段
			return false;
		}
		
		if(fm.email.value.length ==0){
			alert('电子邮件不能为空');
			return false;
		}
	};
	
		//alert(fm.face.options.length);
		fm.face.onchange = function(){
	//	alert(fm.face.options[fm.face.selectedIndex].value);
		fm.face_img.src = fm.face.options[fm.face.selectedIndex].value;
	}
};