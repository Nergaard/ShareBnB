function goBack() {
    window.history.back();
}

function getQueryVariable(variable) {
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}



function menuActive(input_div) {
        input_div.classList.toggle("change");
        let main_menu_classes = document.getElementById('main_menu').classList;
        let main_menu_content = document.getElementById('main_menu_content').classList;
        
        if (main_menu_classes.contains("change_main")) {
                document.getElementById('main_menu').classList.remove('change_main');
        } else {
                document.getElementById('main_menu').classList.add("change_main");
        }
        
        if (main_menu_content.contains("change_main_content")) {
                document.getElementById('main_menu_content').classList.remove('change_main_content');
        } else {
                document.getElementById('main_menu_content').classList.add("change_main_content");
        }
}




function update_search_v1(inputen) {
	document.getElementById('cardcontainer').innerHTML = '';
	let price_min_limit = document.getElementById('range_price_min').value;
	let price_max_limit = document.getElementById('range_price_max').value;

	document.getElementById('range_price_max').min = price_min_limit;
	document.getElementById('range_price_min').max = price_max_limit;

	document.getElementById('range_price_min_output').innerHTML = price_min_limit;
	document.getElementById('range_price_max_output').innerHTML = price_max_limit;

	// console.log(price_min_limit);
	search_query_result.forEach(res => {
		let mem_price = Number(res.r_price);
		if (price_min_limit < mem_price && mem_price < price_max_limit) {
			print_residence_to_cardcontainer(res);
		}
	});
}




function update_search(inputen) {
	let prev_price_min = Number(document.getElementById('range_price_min_output').innerHTML);
	let prev_price_max = Number(document.getElementById('range_price_max_output').innerHTML);
	
	let prev_size_min = Number(document.getElementById('range_size_min_output').innerHTML);
	let prev_size_max = Number(document.getElementById('range_size_max_output').innerHTML);
	
	let prev_sleeps_min = Number(document.getElementById('range_sleeps_min_output').innerHTML);
	let prev_sleeps_max = Number(document.getElementById('range_sleeps_max_output').innerHTML);


	let price_min_limit = document.getElementById('range_price_min').value;
	let price_max_limit = document.getElementById('range_price_max').value;
	document.getElementById('range_price_max').min = price_min_limit;
	document.getElementById('range_price_min').max = price_max_limit;
	document.getElementById('range_price_min_output').innerHTML = price_min_limit;
	document.getElementById('range_price_max_output').innerHTML = price_max_limit;

	let size_min_limit = document.getElementById('range_size_min').value;
	let size_max_limit = document.getElementById('range_size_max').value;
	document.getElementById('range_size_max').min = size_min_limit;
	document.getElementById('range_size_min').max = size_max_limit;
	document.getElementById('range_size_min_output').innerHTML = size_min_limit;
	document.getElementById('range_size_max_output').innerHTML = size_max_limit;

	let sleeps_min_limit = document.getElementById('range_sleeps_min').value;
	let sleeps_max_limit = document.getElementById('range_sleeps_max').value;
	document.getElementById('range_sleeps_max').min = sleeps_min_limit;
	document.getElementById('range_sleeps_min').max = sleeps_max_limit;
	document.getElementById('range_sleeps_min_output').innerHTML = sleeps_min_limit;
	document.getElementById('range_sleeps_max_output').innerHTML = sleeps_max_limit;


	if (
		(prev_price_min > price_min_limit || prev_price_max < price_max_limit) || 
		(prev_size_min > size_min_limit || prev_size_max < size_max_limit) ||
		(prev_sleeps_min > sleeps_min_limit || prev_sleeps_max < sleeps_max_limit)
		){
                set_display(price_min_limit, price_max_limit, size_min_limit, size_max_limit, sleeps_min_limit, sleeps_max_limit);
                setTimeout(function(){ 
                        set_opacity(price_min_limit, price_max_limit, size_min_limit, size_max_limit, sleeps_min_limit, sleeps_max_limit);
				}, 100);
	} else {
		set_opacity(price_min_limit, price_max_limit, size_min_limit, size_max_limit, sleeps_min_limit, sleeps_max_limit);
		setTimeout(function(){ 
			set_display(price_min_limit, price_max_limit, size_min_limit, size_max_limit, sleeps_min_limit, sleeps_max_limit);
		}, 400);
	}
}




function set_opacity(price_min_limit, price_max_limit, size_min_limit, size_max_limit, sleeps_min_limit, sleeps_max_limit) {
	search_query_result.forEach(res => {
		let mem_price = Number(res.r_price);
		let mem_size = Number(res.r_size);
		let mem_sleeps = Number(res.r_sleeps_total);
		let mem_ID = "residence_"+res.r_ID;
		let class_list = document.getElementById(mem_ID).classList;

		if (
			(price_min_limit <= mem_price && mem_price <= price_max_limit) &
			(size_min_limit <= mem_size && mem_size <= size_max_limit) &
			(sleeps_min_limit <= mem_sleeps && mem_sleeps <= sleeps_max_limit)
			) {
			
			if (class_list.contains("opacity--none")) {
				class_list.remove("opacity--none");
				class_list.add("opacity--display");
			}

		} 
		else {
			if (!class_list.contains("opacity--none")) {
				class_list.add("opacity--none");
				class_list.remove("opacity--display");
			} 
		}
	});
}




function set_display(price_min_limit, price_max_limit, size_min_limit, size_max_limit, sleeps_min_limit, sleeps_max_limit) {
	search_query_result.forEach(res => {
		let mem_price = Number(res.r_price);
		let mem_size = Number(res.r_size);
		let mem_sleeps = Number(res.r_sleeps_total);
		let mem_ID = "residence_"+res.r_ID;
		let class_list = document.getElementById(mem_ID).classList;
                
		if (
			(price_min_limit <= mem_price && mem_price <= price_max_limit) &
			(size_min_limit <= mem_size && mem_size <= size_max_limit) &
			(sleeps_min_limit <= mem_sleeps && mem_sleeps <= sleeps_max_limit)
			) {
		
			if (class_list.contains("display--none")) {
				class_list.remove("display--none");
			}
			
		} else {
			
			if (!class_list.contains("display--none")) {
				class_list.add("display--none");
			} 

		}
	});
};


function fetch_search_alternatives(hvor) {
	if (hvor.value == "") {
		document.getElementById("search__results").innerHTML = "";
		return;
	} else { 
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("search__results").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","include/fetch_search_alternatives.php?q="+hvor.value);
		xmlhttp.send();
	}
}

function insert_result_in_search(hvor) {
	document.getElementById("input__search__where").value = hvor.name;
	document.getElementById("search__results").innerHTML = "";
}

function remove_search_results() {
	document.getElementById("search__results").innerHTML = "";
}



function verify_user_id_by_email_with_printout(hvor) {
	if (hvor.value == "") {
		document.getElementById(hvor.name).innerHTML = "";
		return;
	} else { 
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById(hvor.name).innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","modules/verify_user_id_by_email.php?q="+hvor.value);
		xmlhttp.send();
	}
}

function show_hide_rate_residence(input) {
	let doc = document.getElementById('rating__form');
	let class_list = doc.classList;

	if (input.classList.contains("button--active")) {
		input.classList.remove("button--active");
	} else {
		input.classList.add("button--active");
	}

	if (class_list.contains("display--none")) {
		class_list.remove("display--none");
	} else {
		class_list.add("display--none");
	}
}

function approve_rental(input) {
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById(input.name).innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET","modules/approve_rental.php?rental_id="+input.value+"&owner_id="+input.id);
	xmlhttp.send();
}

function approve_rental_renter(input) {
	// console.log('test');
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById(input.name).innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET","modules/approve_rental_renter.php?rental_id="+input.value+"&owner_id="+input.id);
	xmlhttp.send();
}

