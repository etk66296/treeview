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
      #loginButton {
        background-color: #4CAF50;
        padding: 5px;
        border-radius: 4px;
        float: right;
        font-size: 12px;
        margin-left: 5px;
      }
      #loginButton:hover {
        background-color: #FF0000;
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
<header>
  <!-- HTML Form -->
  <form style="width: 94vw; margin: 3px 0 3px 3vw; font-family: 'Courier New', Courier, monospace;" action="submit.php" method="post" name="login_form" id="login_form" autocomplete="off">
    <!--BUTTON SUBMIT-->
    <button
      id="loginButton"
      style="float:right; border-radius: 5px; margin-bottom: 3px;"
      type="submit"
      class="btn btn-lg btn-primary btn-block"
    >
      Login
    </button>
    <!-- <button style="float:right;" type="button" class="btn btn-lg btn-info btn-block" data-toggle="modal" data-target="#registration_modal">Create an account</button> -->
    
    <!--INPUT USER-->
    <input
      style="float:left; margin-bottom: 3px;"
      type="email"
      name="Email"
      id="Email"
      class="form-control"
      placeholder="Email address"
      required autofocus
    >

    <!--INPUT PASSWORD-->
    <input
      style="float:left; margin-bottom: 3px; margin-left: 3px;"
      type="password"
      name="Password"
      id="Password"
      class="form-control"
      placeholder="Password"
      required pattern=".{6,12}"
      title="6 to 12 characters."
    >
    <input type="hidden" name="Action" value="login_form"/>
    <div style="float:right;" id="display_error" class="alert alert-danger fade in"></div><!-- Display Error Container -->
  </form>
</header>