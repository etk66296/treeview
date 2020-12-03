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
      /* header {
        margin: 10px;
        width: 95vw;
        margin: 5px auto 5px auto;
      } */

      /* Change the color of links on hover */
      #logoutButton {
        background-color: #FF0000;
        padding: 5px;
        border-radius: 4px;
        float: right;
        font-size: 12px;
        margin-left: 5px;
      }
      #logoutButton:hover {
        background-color: #4CAF50;
        color: black;
        cursor: pointer;
      }


      /*<-- HEADER NAV*/
      /**********************************************************/

      /**FORM --> */
      /* The popup form - hidden by default */
      .form-popup {
        border-radius: 10px;
        margin-left: 2vw;
        margin-bottom: 10px;
        width: 95vw;
        display: none;
        top: 100;
        left: 15px;
        border: 3px solid #f1f1f1;
        z-index: 9;
      }
      /* Add styles to the form container */
      .form-container {
        padding: 10px;
        background-color: white;
        font-family: Courier, monospace;
      }

      /* Full-width input fields */
      .form-container div label{
        padding: 3px;
        margin: 5px 0 5px 0;
        border: none;
        background: #f1f1f1;
      }

      /* Full-width input fields */
      .form-container div input{
        min-width: 40vw;
      }

      /* When the inputs get focus, do something */
      /* .form-container div {
        background-color: #ddd;
        outline: none;
      } */

      /* Set a style for the submit/login button */
      .form-container .btn {
        background-color: #4CAF50;
        color: white;
        padding: 16px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        margin-bottom:10px;
        opacity: 0.8;
      }

      /* Add a red background color to the cancel button */
      .form-container .cancel {
        background-color: red;
      }

      /* Add some hover effects to buttons */
      .form-container .btn:hover, .open-button:hover {
        opacity: 1;
      }
      /** <-- FORM */

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
<header>
  <!--add tree add meadow function here-->
  <form style="width: 94vw; margin: 3px 0 3px 3vw; font-family: 'Courier New', Courier, monospace;" action="logout.php" method="post" name="logout_form" id="logout_form" autocomplete="off">
    <!--BUTTON SUBMIT-->
    <button
      id="logoutButton"
      style="float:right; border-radius: 5px; margin-bottom: 3px;"
      type="submit"
      class="btn btn-lg btn-primary btn-block"
    >
      logout
    </button>
  </form>
  <div style="margin: 3px 0 3px 40px;">
    <!-- <button
      id="addMeadow"
    >
      +Wiese
    </button> -->
    <button
      id="addTree"
      onclick="openaddTreeForm()"
    >
      +Baum
    </button>
  <div>
</header>
<div class="form-popup" id="addTreeForm">
  <form action="src/addTree.php" class="form-container" method="post" name="addTreeForm" id="addTreeForm" autocomplete="off">
    <div>
    <label for="cultivar">Sorte_____</label>
    <input type="text" placeholder="Schöne aus Boskoop" name="cultivar" required>
    </div>
    <div>
    <label for="family">Familie___</label>
    <input type="text" placeholder="Rosengewächse" name="family" required>
    </div>
    <div>
    <label for="kind">Gattung___</label>
    <input type="text" placeholder="Apfel" name="kind" required>
    </div>
    <div>
    <label for="wikiLink">Wikipedia_</label>
    <input type="text" placeholder="https://de.wikipedia.org/wiki/Sch%C3%B6ner_aus_Boskoop" name="wikiLink" required>
    </div>
    <div>
    <label for="long">Long______</label>
    <input type="text" placeholder="9.4029688" name="long" required>
    </div>
    <div>
    <label for="lat">Lat_______</label>
    <input type="text" placeholder="48.6792663" name="lat" required>
    </div>
    <div>
    <label for="plantingYear">Pflanzjahr</label>
    <input type="text" placeholder="ca. 1960" name="plantingYear" required>
    </div>
    <div>
    <label for="situation">Zustand___</label>
      <select id="TreeSituation" name="situation">
        <option value="VeryHealthy">sehr gesund</option>
        <option value="Healthy">gesund</option>
        <option value="MediumHealthy">mittel gesund</option>
        <option value="LessHealthy">weniger gesund</option>
        <option value="SlightlyIll">leicht krank</option>
        <option value="MediumIll">mittel krank</option>
        <option value="Ill">krank</option>
        <option value="SeriouslyIll">ernsthaft krank</option>
        <option value="Dead">tot</option>
      </select>
    </div>
    <div>
      <button type="submit" class="btn">add</button>
    </div>
  </form>
</div>
<script>
var isOpen = false
function openaddTreeForm() {
  if (isOpen) {
    document.getElementById("addTreeForm").style.display = "none";
    isOpen = false
  } else {
    document.getElementById("addTreeForm").style.display = "block";
    isOpen = true
  }
}
</script>