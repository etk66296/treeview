<?php
  /*PHP Login and registration script Version 1.0, Created by Gautam, www.w3schools.in*/
  require('src/config.php');
  // require('src/loginFunctions.php');

  /*Check for authentication otherwise user will be redirects to main.php page.*/
  if (!isset($_SESSION['UserData'])) {
    exit(header("location:main.php"));
  }

  require('src/adminHeader.php');
?>

<!-- container -->
<script>
  window.onload = function() {

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
      attribution: 'CC BY 3.0</a>. Data by <a href="http://openstreetmap.org">' +
        'OpenStreetMap</a>, under' +
        '<a href="http://www.openstreetmap.org/copyright">ODbL</a>.'
    }).addTo(map)

    // show the trees
    requestTreeLayerData('assets/treeData/treeData.json', (response) => {
      L.geoJSON(response, {
        userFunction: () => {
          console.log("Hello")
        },
        onEachFeature: (feature, layer) => {

          console.log(feature.id)

          let jsInjection = "" +
            "openaddTreeForm();" +
            "document.getElementById('idSubmitButton').innerHTML = 'update';" + 
            "document.getElementById('idTreeIDHiddenInput').value = '" + feature.id + "';" +
            "document.getElementById('idCultivarInput').value = '" + feature.properties.cultivar + "';" +
            "document.getElementById('idFamilyInput').value = '" + feature.properties.family + "';" +
            "document.getElementById('idKindInput').value = '" + feature.properties.kind + "';" +
            "document.getElementById('idplantingYearInput').value = '" + feature.properties.plantingYear + "';" +
            "document.getElementById('idwikiLinkInput').value = '" + feature.properties.wikipediaLink + "';" +
            "document.getElementById('idLongInput').value = '" + String(feature.geometry.coordinates[0]) + "';" +
            "document.getElementById('idLatInput').value = '" + String(feature.geometry.coordinates[1]) + "';" +
            "document.getElementById('TreeSituation').value = '" + String(feature.properties.situation) + "';"
            "document.getElementById('TreeHealth').value = '" + String(feature.properties.health) + "';"

          
		      let popupContent =  "<ul>" +
            "<li>ID: " + feature.id + "</li>" +
            "<li>Sorte: " + feature.properties.cultivar + "</li>" +
            "<li>Familie: " + feature.properties.family + "</li>" +
            "<li>Gattung: " + feature.properties.kind + "</li>" +
            "<li>Pflanzjahr: " + feature.properties.plantingYear + "</li>" +
            "<li>Gesundheitszustand: " + feature.properties.health + "</li>" +
            "<li>Pflegezustand: " + feature.properties.situation + "</li>" +
            "<li>" + 
            "<a href=" + feature.properties.wikipediaLink + ">wiki</a>" +
            "</li>" +
            "<li>Pos: " + String(feature.geometry.coordinates) + "</li>" +
            "</ul>" +
            "<button type=\"button\" onclick=\"" + jsInjection + "\">update</button>"

		      layer.bindPopup(popupContent)
	      },
        pointToLayer: function (feature, latlng) {
          return L.circleMarker(latlng, {
            radius: 4,
            fillColor: "#ff7800",
            color: "#00ff00",
            weight: 2,
            opacity: 1,
            fillOpacity: 0.5
          })
        }
      }).addTo(map)

    })

  }
</script>
<main>
  <div id="mapid">
  </div>
</main>
<!-- /container -->
<?php require('src/footer.php');?>