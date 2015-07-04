window.onload = function(){
	var level = document.getElementById('level');
	var option = document.getElementsByTagName('option');
	var state = document.getElementById('state');
	var more_agree = document.getElementById('more_agree');
	more_agree.onsubmit = function(){
		if(state.value!=0 && state.value!=1){
			alert('批审值不合法');
			return false;
		}
	}
	for(var i=0;i<option.length;i++){
		if(option[i].value == level.value){
			option[i].setAttribute('selected','selected');
		}
	}
	var title = document.getElementById('title');
	var ol = document.getElementsByTagName('ol');
	var a = ol[0].getElementsByTagName('a');
 	for (i=0;i<a.length;i++) {
			a[i].className = null;
			if (title.innerHTML == a[i].innerHTML) {
				a[i].className = 'selected';
			}
	}
	
	var add_fm = document.getElementById('add_fm');
	add_fm.onsubmit = function(){
		if(add_fm.admin_user.value<2 || add_fm.admin_user.value>6){
			alert('用户名不能少于2位或者大于6位');
			add_fm.admin_user.focus();
			return false;
		}
		if(add_fm.admin_pass.value<6){
			alert('密码不能少于6位');
			add_fm.admin_pass.focus();
			return false;
		}
		if(add_fm.admin_pass != add_fm.admin_repass){
			alert('密码和密码确认不一致');
			return false;
		}
	}
}
