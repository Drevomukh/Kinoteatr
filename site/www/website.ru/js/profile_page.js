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
function change_pass(but) {
	var change_pass_div = document.querySelector('div[class=content_rightside_change_pass]');
	if (but.getAttribute('id') == 0) {
		change_pass_div.style.display='flex';
		but.setAttribute('id',1);
	}else if (but.getAttribute('id') == 1) {
		change_pass_div.style.display='none';
		but.setAttribute('id',0);
	}
}
function change_email(but) {
	var change_pass_div = document.querySelector('div[class=content_rightside_change_email]');
	if (but.getAttribute('id') == 0) {
		change_pass_div.style.display='flex';
		but.setAttribute('id',1);
	}else if (but.getAttribute('id') == 1) {
		change_pass_div.style.display='none';
		but.setAttribute('id',0);
	}
}
function open_rev(button_check) {
	var elem = document.querySelector('div[class=liked_films_body_list]');
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

function change_pass_req() {
	var old_pass = document.querySelector('input[name=old_pass]').value;
	var new_pass = document.querySelector('input[name=new_pass]').value;

	var args = 'choice=pass' + '&' + 'old_pass=' + old_pass + '&' + 'new_pass=' + new_pass;
	ajax_chpass_Sending(args);
}

function ajax_chpass_Sending(args) {
	var xhr = new XMLHttpRequest();
	var change_pass_but = document.querySelector('a[class=change_pass_but]');
	var ch_pass_form = document.querySelector('form[class=content_rightside_change_pass_form]');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4) {
			if (xhr.responseText == 'Пароль изменён успешно') {
				alert('Пароль изменён успешно');
				change_pass(change_pass_but);
				for (var i = 0; i <= ch_pass_form.children.length; i++) {
					ch_pass_form.children[i].value='';
				}
			}else {
				alert(xhr.responseText);
			}
		}
	}
	xhr.open('POST','scripts/change_authdata.php');
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send(args);
}


function change_email_req() {
	var old_pass = document.getElementById('pass').value;
	var new_email = document.getElementById('new_email').value;

	var args = 'choice=email' + '&' + 'old_pass=' + old_pass + '&' + 'new_email=' + new_email;
	ajax_chemail_Sending(args);
}

function ajax_chemail_Sending(args) {
	var xhr = new XMLHttpRequest();
	var change_email_but = document.querySelector('a[class=change_email_but]');
	var ch_email_form = document.querySelector('form[class=content_rightside_change_email_form]');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4) {
			if (xhr.responseText == 'Email изменён успешно') {
				alert('Email изменён успешно');
				change_email(change_email_but);
				for (var i = 0; i <= ch_email_form.children.length; i++) {
					ch_email_form.children[i].value='';
				}
			}else {
				alert(xhr.responseText);
			}
		}
	}
	xhr.open('POST','scripts/change_authdata.php');
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