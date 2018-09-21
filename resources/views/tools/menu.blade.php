@guest

@else

<div class="topnav">

  <a href="reports"><img src="../img/doraly.png"></a>

  <div class="dropdown">
    <button class="dropbtn" onclick="myFunction()">{{ Auth::user()->name }}</button>
    <div class="dropdown-content" id="myDropdown">
      <a class="topnav_a" href="profil">Profil</a>
      <a class="topnav_a" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
      </form>
    </div>
  </div>

  <a class="topnav_a" href="reports">Reports</a>
  <a class="topnav_a" href="livecams">Live Cams</a>

</div>

@endguest

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
