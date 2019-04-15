var avail = document.getElementsByClassName("availability");

for(i in avail){
	if (avail[i].innerHTML == "Available"){
		avail[i].style.color = "green";
	}else{
		avail[i].style.color = "red";
	}
}