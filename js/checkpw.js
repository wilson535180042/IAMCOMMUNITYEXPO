var myInput = document.getElementById("password");
var length = document.getElementById("message");
myInput.onblur = function() {
    length.style.display = "none";
  }
myInput.onkeyup = function() {
    if(myInput.value.length >= 8) {
        length.style.color='transparent';
      } else {
        length.style.color='red';
      }
}
      
      
    
    