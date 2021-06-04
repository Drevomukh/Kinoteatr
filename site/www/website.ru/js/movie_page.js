function activate_mobile_menu() {
	var activated_mobile_menu = document.querySelector('div[class=activated_mobile_menu]');
	var activated_mobile_menu_but1 = document.querySelector('div[class=activated_mobile_menu_but1]');
	var activated_mobile_menu_but2 = document.querySelector('div[class=activated_mobile_menu_but2]');
	var activated_mobile_menu_but3 = document.querySelector('div[class=activated_mobile_menu_but3]');
	var action = activated_mobile_menu.getAttribute('id');
	if (action == 0) {
		var anim_activated_mobile_menu = setInterval(activated_mobile_menu_frame,9);
		activated_mobile_menu.setAttribute('id',1);
	};
	if (action == 1) {
		var anim_deactivated_mobile_menu = setInterval(deactivated_mobile_menu_frame,9);
		activated_mobile_menu.setAttribute('id',0);
	};
	var incr_for_menu = 0;
	var deincr_for_menu = 105;
	function activated_mobile_menu_frame() {
		activated_mobile_menu.style.display = 'flex';
		if (activated_mobile_menu.style.height == 105 + 'px') {
			clearInterval(anim_activated_mobile_menu);
		}else {
			incr_for_menu++;
			activated_mobile_menu.style.height = incr_for_menu + 'px';
			if (activated_mobile_menu.style.height == 35 + 'px') {
				activated_mobile_menu_but1.style.display = 'flex';
			}
			if (activated_mobile_menu.style.height == 38 + 'px') {
				document.querySelector('hr[class=hr1]').style.display = 'block';
			}
			if (activated_mobile_menu.style.height == 70 + 'px') {
				activated_mobile_menu_but2.style.display = 'flex';
			}
			if (activated_mobile_menu.style.height == 72 + 'px') {
				document.querySelector('hr[class=hr2]').style.display = 'block';
			}
			if (activated_mobile_menu.style.height == 105 + 'px') {
				activated_mobile_menu_but3.style.display = 'flex';
			}
		}
	}

	function deactivated_mobile_menu_frame() {
		if (activated_mobile_menu.style.height == 0 + 'px') {
			activated_mobile_menu.style.display = 'none';
			clearInterval(anim_deactivated_mobile_menu);
		}else {
			deincr_for_menu--;
			activated_mobile_menu.style.height = deincr_for_menu + 'px';
			if (activated_mobile_menu.style.height == 104 + 'px') {
				activated_mobile_menu_but3.style.display = 'none';
			}
			if (activated_mobile_menu.style.height == 73 + 'px') {
				document.querySelector('hr[class=hr2]').style.display = 'none';
			}
			if (activated_mobile_menu.style.height == 71 + 'px') {
				activated_mobile_menu_but2.style.display = 'none';
			}
			if (activated_mobile_menu.style.height == 39 + 'px') {
				document.querySelector('hr[class=hr1]').style.display = 'none';
			}
			if (activated_mobile_menu.style.height == 35 + 'px') {
				activated_mobile_menu_but1.style.display = 'none';
			}
		}
	}
}
function search_form_activate() {
	var elem = document.querySelector('div[class=header_row_search_form]');
	var button = document.querySelector('p[class=but]');
	if (button.getAttribute('id') == 0) {
		var anim = setInterval(frame,13);
		var incr = 0;
		function frame() {
			elem.style.display = 'flex';
			if (elem.style.width == 45 + '%') {
				clearInterval(anim);
			}else{
				incr++;
				elem.style.width = incr + '%';
			}
		}
	button.setAttribute('id',1);
	}else {
		var neg_anim = setInterval(neg_frame,13);
		var deincr = 45;
		var body = document.querySelector('div[class=upper_space_adapt_search_div]');
		body.style.display = 'none';
		function neg_frame() {
			if (elem.style.width == 0 + '%') {
				clearInterval(neg_anim);
				elem.style.display = 'none';
			}else{
				deincr--;
				elem.style.width = deincr + '%';
			}
		}
	button.setAttribute('id',0);
	}
}
function open_rev(button_check) {
	var elem = document.querySelector('div[class=content_upperrev]');
	if (button_check.getAttribute('id') == 0) {
		elem.style.display = 'none';
		button_check.children[1].style.display = 'flex';
		button_check.setAttribute('id',1);
	}else if (button_check.getAttribute('id') == 1) {
		elem.style.display = 'flex';
		button_check.children[1].style.display = 'none';
		button_check.setAttribute('id',0);
	}
}
function open_tr(button_check) {
	var elem = document.querySelector('div[class=content_lowerrev]');
	if (button_check.getAttribute('id') == 0) {
		elem.style.display = 'none';
		button_check.children[1].style.display = 'flex';
		button_check.setAttribute('id',1);
	}else if (button_check.getAttribute('id') == 1) {
		elem.style.display = 'flex';
		button_check.children[1].style.display = 'none';
		button_check.setAttribute('id',0);
	}
}
function open_film(button_check) {
	var elem = document.querySelector('div[class=content_film]');
	if (button_check.getAttribute('id') == 0) {
		elem.style.display = 'none';
		button_check.children[1].style.display = 'block';
		button_check.setAttribute('id',1);
	}else if (button_check.getAttribute('id') == 1) {
		elem.style.display = 'block';
		button_check.children[1].style.display = 'none';
		button_check.setAttribute('id',0);
	}
}
function butt_color_plus(parent) {
	parent.style.backgroundColor = '#6e6087';
	parent.children[0].style.color = '#EDE49D';
}
function butt_color_minus(parent) {
	parent.style.backgroundColor = '#4c3d69';
	parent.children[0].style.color = '#a39840';
}

function plus_view(movie_id,user_id) {
	args = 'choice=view' + '&' + 'movie_id=' + movie_id + '&' + 'user_id=' + user_id;
	ajaxSending(args);
}

function plus_like(movie_id,user_id) {
	args = 'choice=like' + '&' + 'movie_id=' + movie_id + '&' + 'user_id=' + user_id;
	ajaxSending(args);
}

function ajaxSending(args) {
	var xhr = new XMLHttpRequest();
	var like_but = document.querySelector('div[class=content_film_likebut]');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4) {
			if (xhr.responseText == 'Like+') {
				like_but.style.display = 'none';
			}
		}
	}
	xhr.open('POST','scripts/logs_vl.php');
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send(args);
}
// Верхняя форма поиска фильмов ajax запрос
function film_name_ajax(inp) {
	var args = 'movie_name=' + inp.value;
	var body = document.querySelector('div[class=upper_space_adapt_search_div]');
	if (inp.value == '') {
		body.style.display = 'none';
		return 1;
	}
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if(xhr.readyState == 4){
			body.style.display = 'flex';
			body.innerHTML = xhr.responseText;
		}
	}

	xhr.open('POST','scripts/upper_menu_req.php');
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send(args);
}
function redirect_main_page() {
	document.location.href = 'index.php';
}
