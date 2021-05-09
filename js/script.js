function toggle(bnum)
{
   var x=0;

    if (bnum == 1){
      x=1;
      var blur = document.getElementById('blur');
      blur.classList.add('active');
      var popup = document.getElementById('popup1');
      popup.classList.add('active');
    }

    if (bnum == 2){
      x=2;
      var blur = document.getElementById('blur');
      blur.classList.add('active');
      var popup = document.getElementById('popup2');
      popup.classList.add('active');
    }

    if (bnum == 3){
      x=3;
      var blur = document.getElementById('blur');
      blur.classList.add('active');
      var popup = document.getElementById('popup3');
      popup.classList.add('active');
    }
    
    if (bnum == 4){
      x=4;
      var blur = document.getElementById('blur');
      blur.classList.add('active');
      var popup = document.getElementById('popup4');
      popup.classList.add('active');
    }

    if (bnum == 5) {
      x=5;
      var blur = document.getElementById('blur');
      blur.classList.toggle('active');
      var popupregis = document.getElementById('popupforgot');
      popupregis.classList.toggle('active');
  }
}

function puggle() {
  var elems = document.querySelectorAll(".active");
  [].forEach.call(elems, function(el) {
    el.classList.remove("active");
  });
  e.target.className = "active";
}