var adClick = document.querySelectorAll(".pc");


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
  animateButton(el, 1.2, 800, 400)
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

  