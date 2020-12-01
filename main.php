<?php
require('src/header.php');
?>
<script>
  window.onload = function() {
    // let loginButto = document.getElementById("loginButton")
    // loginButton.addEventListener("click", (response) => {
    //   let id = document.getElementById("inputName").value
    //   let pw = document.getElementById("inputPassword").value
    //   // connectRequest(xhttp_connect, 'testuser')
    //   postRequest((response) => {
    //     console.log(response)
    //   }, '{id:' + id + ',pw:'+ pw + '}', './submit.php')
    // })

    var map = L.map('mapid', {
      center: [48.666700830713864, 9.41056505665886],
      zoom: 14,
      minZoom: 12,
      maxZoom: 18,
      maxBounds: [
        [48.643634655634429, 9.3110459698857237],
        [48.689767005793307, 9.5100841434319978]
      ]
    })

    L.tileLayer('assets/maps/tiles/{z}/{x}/{y}.png', {
      attribution: 'Map tiles generated for local use by' +
        '<a href="http://maperitive.net">Maperitive</a>, under' +
        '<a href="http://creativecommons.org/licenses/by/3.0">' +
        'CC BY 3.0</a>. Data by <a href="http://openstreetmap.org">' +
        'OpenStreetMap</a>, under' +
        '<a href="http://www.openstreetmap.org/copyright">ODbL</a>.'
    }).addTo(map)
  }
</script>
<main>
  <div id="mapid">
  </div>
</main>


<?php require('src/footer.php');?>
