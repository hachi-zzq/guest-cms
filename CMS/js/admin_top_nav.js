function admin_top_nav(j){
	for(var i=1;i<5;i++){
		document.getElementById('nav'+i).style.background = 'url(../images/li_bg.png) left bottom';
		document.getElementById('nav'+i).style.color = '#fff';
	}
	document.getElementById('nav'+j).style.backgroundPosition = 'right bottom';
	document.getElementById('nav'+j).style.color ='#3b6ea5';
}
