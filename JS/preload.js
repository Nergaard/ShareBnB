let price_lowest = Infinity;
let price_highest = 0;

let size_lowest = Infinity;
let size_highest = 0;

let sleeps_lowest = Infinity;
let sleeps_highest = 0;



function print_residence_to_cardcontainer(residence) {
	let section = document.createElement('section');
	section.className = 'card_sml zoom';
	section.id = 'residence_'+residence.r_ID;
	section.innerHTML =
		'<a href="?pg=residence_view&id='+residence.r_ID+'">\
				<img src="img/uploads/'+residence.r_img+'" alt="">\
		</a>\
		<article>\
				<h4>'+residence.r_rating_print+'<small>('+residence.r_rating_count+')</sall></h4>\
				<h1>'+residence.r_headline+'</h1>\
				<h3>Kr '+residence.r_price+',-</h3>\
				<section class="card_info">\
				<h8>Antall soverom:</h8>\
				<h8>'+residence.r_bedrooms+'</h8>\
				<h8>Antall sengeplasser:</h8>\
				<h8>'+residence.r_sleeps_main+'</h8>\
				<h8>Antall ekstra sengeplasser:</h8>\
				<h8>'+residence.r_sleeps_extra+'</h8>\
				</section>\
		</article>';
	document.getElementById('cardcontainer').appendChild(section);
}



