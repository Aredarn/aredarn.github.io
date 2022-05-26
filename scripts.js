var http = new XMLHttpRequest();

var adClick = document.querySelectorAll(".col-md-4");

function animateButton(el, scale, duration, elasticity) {
  anime.remove(el);
  anime({
    targets: el,
    scale: scale,
    duration: duration,
    elasticity: elasticity
  });
}

function enterButton(el) {
  animateButton(el, 1.1, 800, 400)
  console.log("saniy")
};

function leaveButton(el) {
  animateButton(el, 1.0, 600, 300)
};


for (var i = 0; i < adClick.length; i++) {
  adClick[i].addEventListener('mouseenter', function(e) {
  enterButton(e.target);
}, false);

adClick[i].addEventListener('mouseleave', function(e) {
  leaveButton(e.target)
}, false);  
}


function kategories()
{
  fetch('header.html').then(Response=> Response.text()).then(text=>document.getElementById("insert").innerHTML=text);
  http.onreadystatechange = function(){
	if(this.readyState == 4 && this.status == 200){
		document.getElementById("categories").innerHTML = this.responseText;
	}
	};

  http.open("GET", "server.php?m=sz", true);
	http.send();
  
}

function loadItems(){
  fetch('header.html').then(Response=> Response.text()).then(text=>document.getElementById("insert").innerHTML=text);
  categ = document.getElementById("category").innerHTML;
  http.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
      document.getElementById("categories").innerHTML = this.responseText;
    }
    };
  
    http.open("POST", "server.php", true);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("m=i" + "&categ=" + categ);
}


function registration(){
	
	var name = document.getElementById("name").value;
  var image = document.getElementById("image").value;

	http.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			document.getElementById("valasz").innerHTML = this.responseText;
		}
	};
	
	http.open("POST", "server.php", true);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.send("m=r" + "&name=" + name + "&image=" + image );
	
}


function insertHeader()
{
  fetch('header.html').then(Response=> Response.text()).then(text=>document.getElementById("insert").innerHTML=text);
  console.log("mak");
  
}

