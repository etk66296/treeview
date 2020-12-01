<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>treeview</title>
    <link rel="shortcut icon" href="assets/favicon.ico">
    <link
      rel="stylesheet" href="src/3rd/leaflet/leaflet.css"
      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
      crossorigin=""
    />
    <script src="src/3rd/cryptojs-aes.min.js"></script>
    <script src="src/3rd/cryptojs-aes-format.js"></script>
    <script src="src/3rd/cryptico.min.js"></script>
    <script src="src/3rd/leaflet/leaflet.js"
      integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
      crossorigin="">
    </script>
    <script src="src/treeview.js"></script>
    <style>
      html {
        background-color: #000;
        /* overflow: hidden; */
      }
      body {
        margin: 0;
        padding: 0;
      }

      /**********************************************************/
      /*HEADER NAV -->*/
      header {
        margin: 10px;
        border: 5px solid #333;
        border-radius: 12px;
        width: 95vw;
        margin: 5px auto 5px auto;
      }
      /* Add a black background color to the top navigation */
      .topnav {
        background-color: #333;
        overflow: hidden;
      }

      /* Style the links inside the navigation bar */
      .topnav div {
        float: left;
        margin-right: 5px;
        border-radius: 12px;
        color: #f2f2f2;
        background-color: #232923;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
      }

      /* Change the color of links on hover */
      .topnav div:hover {
        background-color: #ddd;
        color: black;
        cursor: pointer;
      }

      /*<-- HEADER NAV*/
      /**********************************************************/

      table, td, th {
        border: 1px solid #aaaaaa;
        color: #ffffff;
      }

      table {
        width: 100%;
        border-collapse: collapse;
      }

      footer {
        margin: 10px;
        border-radius: 12px;
        color: #f2f2f2;
        font-size: 10px;
        width: 95vw;
        margin: 5px auto 5px auto;
      }
      #mapid {
        background-color: hsl(135, 100%, 84%);
        height: 80vh;
        width: 95vw;
        margin: auto;
        border: 5px solid #fff;
        border-radius: 12px;
      }
    </style>
  </head>
  <body>
    <script>
      window.onload = function() {
        // define the map data
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
        // 
        L.tileLayer('assets/maps/tiles/{z}/{x}/{y}.png', {
          attribution: 'Map tiles generated for local use by' +
          '<a href="http://maperitive.net">Maperitive</a>, under' +
          '<a href="http://creativecommons.org/licenses/by/3.0">' +
          'CC BY 3.0</a>. Data by <a href="http://openstreetmap.org">' +
          'OpenStreetMap</a>, under' +
          '<a href="http://www.openstreetmap.org/copyright">ODbL</a>.'
        }).addTo(map)

        // add the trees
        requestTreeLayerData('assets/treeData/treeData.json', (response) => {
          L.geoJSON(response, {
            onEachFeature: (feature, layer) => {
		          let popupContent =  "<ul>" + 
                                  "<li>Sorte: " + feature.properties.cultivar + "</li>" +
                                  "<li>Familie: " + feature.properties.family + "</li>" +
                                  "<li>Gattung: " + feature.properties.kind + "</li>" +
                                  "<li>" + 
                                  "<a href=" + feature.properties.wikipediaLink + ">wiki</a>" +
                                  "</li>" +
                                  "<li>Pos: " + String(feature.geometry.coordinates) + "</li>" +
                                  "</ul>"
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



        // login forgang
        // CLIENT SEITE
        // 1. Der Nutzer gibt Name und Passwort ein.
        // 2. Der Nutzer startet den Event Login.
        // 3. Der Nutzername wird mit einer Standardverschlüsselung kodiert.
        // 4. Der verschlüsselte Nutzername wird an das serverseitige Skript connect übermittelt.
        //  SERVER SEITE:
        //    1. Der erhaltene verschlüsselte Nutzername wird in der Datenbank gesucht.
        //    2. Ist der Eintrag enthalten wird der P

        // login request -->
        // let xhttp_connect = function(passPhrase) {
        //   console.log(passPhrase)
        //   // The passphrase used to repeatably generate this RSA key.
        //   var PassPhrase = "The Moon is a Harsh Mistress."

        //   // The length of the RSA key, in bits.
        //   var Bits = 1024
        //   var rsaKey = cryptico.generateRSAKey(PassPhrase, Bits)
        //   console.log('encrypted user: ', cryptico.publicKeyString(rsaKey))

          
          
        //   // let mysql_response = JSON.parse(passPhrase)
        //   // let htmTmpRespTbl = '<table>' +
        //   //     '<tr>' +
        //   //       '<th>id</th>' +
        //   //       '<th>last_login</th>' +
        //   //       '<th>user_name</th>' +
        //   //       '<th>user_pass</th>' +
        //   //     '</tr>'+
        //   //     '<tr>' +
        //   //       '<td>' + mysql_response.id + '</td>' +
        //   //       '<td>' + mysql_response.last_login + '</td>' +
        //   //       '<td>' + mysql_response.user_name + '</td>' +
        //   //       '<td>' + mysql_response.user_pass + '</td>' +
        //   //     '</tr>'
        //   //   '</table>'
        //   // document.getElementById('tmpsqltable').innerHTML = htmTmpRespTbl
        
        //   // encrypt value
        //   let valueToEncrypt = 'foobar' // this could also be object/array/whatever
        //   let password = '123456'
        //   let encrypted = CryptoJS.AES.encrypt(JSON.stringify(valueToEncrypt), password, { format: CryptoJSAesJson }).toString()
        //   console.log('Encrypted:', encrypted)
        // // something like: {"ct":"10MOxNzbZ7vqR3YEoOhKMg==","iv":"9700d78e12910b5cccd07304333102b7","s":"c6b0b7a3dc072248"}


        // }

        let loginButto = document.getElementById("loginButton")
        loginButton.addEventListener("click", (response) => {
          // connectRequest(xhttp_connect, 'testuser')
          postRequest((response) => {
            console.log(response)
          }, '', './src/login.php')
        })
        // <-- login request
      }
    </script>
    <header>
      <div class="topnav">
        <!-- <div id="addMeadowButton">add meadow</div>
          <div id="addTreeButton">add tree</div> -->
          <div id="loginButton" style="background-color: #4CAF50; float: right; font-size: 12px; margin-left: 5px;">login</div>
          <input
            type="password"
            name="Password"
            id="inputPassword"
            style="margin-left: 5px;float: right; font-size: 12px;"
            required pattern=".{6,12}"
            title="6 to 12 characters."
            value=""
          >
          <label style="color: #fff; margin-left: 5px; float: right; font-size: 10px;">password</label>
          <input id="inputName" style="margin-left: 5px; float: right; font-size: 12px;" type="text" value="">
          <label style="color: #fff; margin-left: 5px; float: right; font-size: 10px;">name</label>
      </div> 
    </header>
    <main>
      <div id="tmpsqltable"></div>
      <div id="mapid">
      </div>
    </main>
    <footer>
      <a href="http://www.ogv-wendlingen.de">Obst- und Gartenbauverein Wendlingen am Neckar</a>
    </footer>
  </body>
</html>
