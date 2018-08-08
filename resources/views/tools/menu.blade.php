<div class="topnav">
 <a class="active" href="/">Home</a>
 <a href="raport">Raports</a>
 <a href="livecams">Live Cams</a>
   <div class="dropdown">
     <button class="dropbtn" onclick="myFunction()">NUME</button>
     <div class="dropdown-content" id="myDropdown">
       <a href="profil">Profil</a>
       <a href="#">Logout</a>
     </div>
   </div>
</div>

<script>
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
    var myDropdown = document.getElementById("myDropdown");
      if (myDropdown.classList.contains('show')) {
        myDropdown.classList.remove('show');
      }
  }
}
</script>
