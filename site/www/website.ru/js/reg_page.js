var count = 0;

function next_slide(n) {
	count+=n;
	var movie_preview = document.querySelector('div[class=slider_content_body_movie_preview]');
	var movie_preview_height = movie_preview.offsetHeight;
	var slider_body = document.querySelector('div[class=slider_content_body]');
	var first_slider_body = slider_body.children[count-1];

	if (count > 9) {
		count--;
	}else {
		var incr = 0;
		var id = setInterval(next_slide_anim,0.5);
		function next_slide_anim() {
			if (first_slider_body.style.marginTop == -movie_preview_height + 'px') {
				document.querySelector('div[class=slider_content_prev]').children[0].setAttribute('onclick','prev_slide(-1)');
				clearInterval(id);
			}else {
				incr--;
				first_slider_body.style.marginTop = incr + 'px';
				document.querySelector('div[class=slider_content_prev]').children[0].removeAttribute('onclick');
			}
		}
	}
}
function prev_slide(n) {
	count+=n;
	var movie_preview = document.querySelector('div[class=slider_content_body_movie_preview]');
	var movie_preview_height = movie_preview.offsetHeight;
	var slider_body = document.querySelector('div[class=slider_content_body]');
	var first_slider_body = slider_body.children[count];

	if (count < 0) {
		count++;
	}else {
		var deincr = -movie_preview_height;
		var id = setInterval(prev_slide_anim,0.5);
		function prev_slide_anim() {
			if (first_slider_body.style.marginTop == 0 + 'px') {
				document.querySelector('div[class=slider_content_next]').children[0].setAttribute('onclick','next_slide(1)');
				clearInterval(id);
			}else{
				deincr++;
				first_slider_body.style.marginTop = deincr + 'px';
				document.querySelector('div[class=slider_content_next]').children[0].removeAttribute('onclick');
			}
		}
	}
}

function activate_mobile_menu() {
	var activated_mobile_menu = document.querySelector('div[class=activated_mobile_menu]');
	var activated_mobile_menu_but1 = document.querySelector('div[class=activated_mobile_menu_but1]');
	var activated_mobile_menu_but2 = document.querySelector('div[class=activated_mobile_menu_but2]');
	var activated_mobile_menu_but3 = document.querySelector('div[class=activated_mobile_menu_but3]');
	var action = activated_mobile_menu.getAttribute('id');
	if (action == 0) {
		var anim_activated_mobile_menu = setInterval(activated_mobile_menu_frame,9);
		activated_mobile_menu.setAttribute('id',1);
	}
	if (action == 1) {
		var anim_deactivated_mobile_menu = setInterval(deactivated_mobile_menu_frame,9);
		activated_mobile_menu.setAttribute('id',0);
	}
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
function check_pass_length(elem) {
	var val = elem.value;
	var conf_pass = document.querySelector('input[name=conf_pass]');
	check_confpass_length(conf_pass);
	if (val.length == 0) {
		elem.style.backgroundColor = '#fff';
	}else if ((val.length > 6) && (val.length < 9)){
		elem.style.backgroundColor = '#fdff85';
	}else if (val.length < 6) {
		elem.style.backgroundColor = '#ff5c5c';
	}else if (val.length > 9) {
		elem.style.backgroundColor = '#6dfc7b';
	}
}
function check_confpass_length(elem) {
	var conf_val = elem.value;
	var pass = document.querySelector('input[name=pass]');
	var pass_val = pass.value;
	if (conf_val.length == 0) {
		elem.style.backgroundColor = '#fff';
	}else if (conf_val == pass_val) {
		elem.style.backgroundColor = '#6dfc7b';
	}else {
		elem.style.backgroundColor = '#ff5c5c';
	}
}
function reg_ajax_req() {
	var login = document.querySelector('input[name=login]');
	var log_val = login.value;
	var val_non = document.querySelector('input[name=pass]');
	var val = val_non.value;
	var error_div = document.querySelector('div[class=wrong_auth]');
	if (log_val != 0) {
		if (val.length < 6) {
			error_div.style.display = 'flex';
			error_div.innerHTML = "<p>Слабый пароль</p>";
		}else if ((val.length > 6) && (val.length < 9)){
			error_div.style.display = 'flex';
			error_div.innerHTML = "<p>Средний пароль</p>";
		}else {	
		var xhr = fetch('/scripts/reg_script.php',{method: 'POST', body: new FormData(document.getElementById('form'))}).then(function(response){
			response.text().then(function(data){
				if (data == 'OK') {
					error_div.style.display = 'none';
					alert('Регистрация прошла успешно. Авторизируйтесь!');
					document.location.href = 'authorization_page.php';
				}else {
					error_div.style.display = 'flex';
					error_div.innerHTML = "<p>" + data +"</p>";
				}
			})});
		}
	}else {
		login.style.backgroundColor = '#ff5c5c';
	}
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