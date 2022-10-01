<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="de">

<head>
  <title>Helden des Bildschirms Gameserver und Voiceserver</title>

  <meta charset="utf-8">

  <meta name="description" content="Helden des Bildschirms bittet dir Gameserver und Voiceserver, Minecraft, Mods, TeamSpeak, Discord, Meet.">

  <meta property="og:image" content="/icon/android-icon-192x192.png" />

  <meta name="keywords" content="minecraft, rlcraft, gameserver, server, teamspeak, discord, meet, voiceserver">

  <meta name="author" content="Janis">

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">

  <link rel="stylesheet" href="index.css">

  <link rel="apple-touch-icon" sizes="57x57" href="/icon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/icon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/icon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/icon/apple-/icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/icon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/icon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/icon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/icon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/icon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="/icon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/icon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="/icon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/icon/favicon-16x16.png">
  <link rel="manifest" href="/icon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
  <meta name="theme-color" content="#0033CC" />
  <style type="text/css">
  </style>



  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-176121451-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-176121451-1', {
      'anonymize_ip': true
    });
  </script>

  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-K73ZCBF');
  </script>
  <!-- End Google Tag Manager -->

  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5350651163680266" crossorigin="anonymous"></script>
  <div id="wrapper" style="
         min-height: calc(100vh - 98px);
         ">
    <div class="head">
      <img src="/img/logo.png" alt="Logo von @Zauberah erstellt." style="width:64px;height:51px;">
      <a href="/">Helden des Bildschirms</a>
    </div>

</head>

<body>

  <content_box>
    <?php
    $price = (30/(365/12));
    $discount_price = (20/(365/12));
    $discount_days = 90;
    $max_days = 365;
    $min_days = 14;
    $max_orders = 5;
    date_default_timezone_set("UTC");
    //echo date_default_timezone_get();
    $hfp = "../../hidden_file/";
    for ($i=1; $i <= $max_orders; $i++) {
      if (file_exists($hfp ."Bestellung" . $i . ".json")) {  //Datei vorhanden?
        $file = json_decode(file_get_contents($hfp ."Bestellung" . $i . ".json"), true);
        $enddate = json_decode($file['enddate'], true);

        $paid = json_decode($file['paid'], true);
        if ($paid == true) { //Wegen dem break vielleicht etwas blöd plaziert.
          echo "Es ist keine Bestellung bis zum " . date("d.m.Y",$enddate*86400) . " sie können es danach versuchen."; //H:i 2 Uhr sollte nachsehen wieso.
          //return;
        }

        if (filemtime($hfp ."Bestellung" . $i . ".json") >= $enddate) {
          rename($hfp ."Bestellung" . $i . ".json", $hfp ."Bestellung" . $i . ".json");
        } else {
          echo "Es ist eine Bestellung aufgegeben sie können es dennoch versuchen.";
          break;
        }
      }
    }

    if(isset($_POST["submit"])){

      if ($paid == true) {
        exit("Es ist keine Bestellung bis zum " . date("d.m.Y",$enddate*86400) . " sie können es danach versuchen."); //H:i 2 Uhr sollte nachsehen wieso.)
      }

      if (!isset($_POST["subscribe"])) {
        exit("Bitte zustimmen um die Bestellung auszuführen.");
      }

      $request = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=&response=".$_POST["adkey_text_input"]);
      $request = json_decode($request);
        if($request->success == true){
            if($request->score >= 0.6){

            $startdate = (intval(time() / 86400));
            $end_datetime = (intval(strtotime(htmlspecialchars($_POST["end_datetime"])) / 86400)); //Angreifer könnte Text senden.

            $days = $end_datetime - $startdate ;

            if (($min_days != false && $days <= $min_days) || ($min_days == false && $days <= 1)) { //Ja okay geht eh nicht ins Minus und 1 sollte immer ferstgelegt werden.
              echo "Die Mindestdauer beträgt ". $min_days ." Tage.";
              return 0;
            }

            if ($max_days != false && $days >= $max_days) {
              echo "Die Maximaledauer beträgt ". $max_days ." Tage.";
              return 0;
            }

            if ($discount_days != false && $days >= $discount_days) {
                $price = $discount_price;
            }

            $jsone =[
                //Daten von User-Input können zu lang sein.
                'name'=> htmlspecialchars($_POST["name"]),
                'email'=> htmlspecialchars($_POST["email"]),
                'nummernschild'=> htmlspecialchars($_POST["nummernschild"]),
                'startdate'=> $startdate,
                'enddate'=> $end_datetime,
                'days'=> $days,
                'price'=> round($price*$days, 2),
                'paid'=> false,
            ];

            for ($i=1; $i <= $max_orders; $i++) {
              if (!file_exists($hfp ."Bestellung" . $i . ".json")) {  //Datei vorhanden?
                file_put_contents($hfp ."Bestellung" . $i . ".json",json_encode($jsone)); //Was passiert wenn nicht in Datei sollte abgefragt werden ob vorhanden weiter oben.
                ?>
                <h1 style="color: green;">Wir haben deine Anfrage erhalten! </h1> <br> Wir senden dir in den nächsten Stunden eine Rechnung zu. <br> (Das dauert ertwas da wir keinen Zugriff auf die PayPal API haben bei einem Privatkonto und die Gebühren zu hoch
                wären für ein Geschäftskonto.) <br> Du wirst jetzt als möglicher Käufer mit deinem Angbot angezeigt, wenn du diese bezahlst ist der Parkplatz nur noch für dich verfügbar und kein Anderer Nutzer kann einen Vorschlag für diesen Zeitraum stellen. <br>
                <?php
                echo ('Danke ' . htmlspecialchars($_POST["name"]). ' für deine Bestellung für '. $days. " Tage zum Preis von ". $jsone['price'] . " Euro mit voraussichtlichen Ende zum " . (htmlspecialchars($_POST["end_datetime"])) . '<br>'.'Wir senden dir in den nächsten Tagen eine Rechnung für die Tage die du bestellt hast an deine Email: '.htmlspecialchars($_POST["email"]));
                //mail('support@heldendesbildschirms.de', 'Neue Bestellung', 'Neue Bestellung für $days', 'From: Your name <heldendesbildschirm@gmail.com>');
		break;
              } else {
                if ($max_orders != false && $i == $max_orders)
                {
                  echo "Es sind ". $i ." Bestellungen aufgegeben, aus diesem Grund bitten wir sie es später erneut zu versuchen.";
                  //break;
                }
              }
            }

            } else {
                echo "Die Anfrage wurde aufgrund von Spamverdacht blockiert.";
            }
        } else {
            echo "Es gab einen Fehler mit dem Captcha";
        }
    }
   ?>
    <div class="giveaway">
      <form action="index.php" method="post">
        E-Mail (für PayPal Rechnung und Kontakt): <input type="email" value="" id="e-mail" name="email" placeholder="Email" required> <br>
        Name: <input type="text" name="name" placeholder="Name" required><br>
        Nummernschild: <input type="text" name="nummernschild" placeholder="Nummernschild" required><br>
        Dauer: <!--  von: <input type="datetime-local" name="start_datetime" required> --> bis <input type="date" name="end_datetime" id="end_datetime" required> Mindestdauer <?php if ($min_days != false) { echo $min_days. " Tage"; } else {echo "1 Tag";} ?>, die Rechnung wird auf den ersten Tag nach der Rechnung angepasst.  <?php if ($discount_days != false) { echo "<br> Ein Rabatt ist ab ".$discount_days." Tagen möglich."; } ?> <br>
        Kosten: Die Kosten sind bei <text id="price_output"> </text> Euro pro Tag die Kosten sind für dich also bei <text id="calc_price_output"> </text>. <br>
        <text id="user_info_output"> </text> <br>

        <input type="hidden" value="" id="adkey_text_input" name="adkey_text_input"> <br>
        <label for="subscribe">Ich stimme zu, dass man mich über die angegebene E-Mail kontaktieren darf.</label>
        <input type="checkbox" id="subscribe_checkbox" name="subscribe" value="subscribe"> <br>
        <button type="submit" name="submit">Bestellen</button></box>
      </form>
    </div>

    <script src="https://www.google.com/recaptcha/api.js?render=6Lc9k8kfAAAAAAC0AdMMQAZ6u25VOlgzh7L9zbuW"></script>
    <script>
      checkrobot();

      function checkrobot() {
        grecaptcha.ready(function() {
          grecaptcha.execute('6Lc9k8kfAAAAAAC0AdMMQAZ6u25VOlgzh7L9zbuW', {
            action: 'submit'
          }).then(function(token) {
            document.getElementById("adkey_text_input").value = token;
          });
        });
      }

      //var price = Math.round(20/(365/12) * 100 ) / 100;
      var price = <?php echo $price ?>; //20/(365/12);
      var discount_price = <?php if ($discount_days != false) { echo $discount_price; } else {echo $price;} ?>;
      var min_days = <?php if ($min_days != false) { echo $min_days; } else {echo "false";} ?>;
      var max_days = <?php if ($max_days != false) { echo $max_days; } else {echo "false";} ?>;
      function calcprice(days) {
        var startdate = <?php echo (intval(time() / 86400)) ?>;//parseInt(Date.now() / 86400000);
        var days = Date.parse(document.getElementById('end_datetime').value) / 86400000 - startdate;

        document.getElementById('user_info_output').innerText = ("")

        if (max_days != false && days >= max_days) {
          document.getElementById('user_info_output').innerText = ("Fehler: " + "Die Maximaledauer beträgt "+ max_days +" Tage.");
          return 0;
        }

        if ((min_days != false && days >= min_days) || (min_days == false && days >= 1)) {
          if (days >= <?php echo $discount_days ?>) {
            document.getElementById('calc_price_output').innerText = Math.round(days*discount_price * 100 ) / 100  +" Euro für "+ days + " Tage " ;
            document.getElementById('price_output').innerText = Math.round(discount_price * 100 ) / 100;
          }
          else {
            document.getElementById('calc_price_output').innerText = Math.round(days*price * 100 ) / 100  +" Euro für "+ days + " Tage " ;
            document.getElementById('price_output').innerText = Math.round(price * 100 ) / 100;
          }
        } else {
          if (min_days == false) {
            document.getElementById('user_info_output').innerText = ("Fehler: " + "Die Mindestdauer beträgt einen Tag.");
          } else {
            document.getElementById('user_info_output').innerText = ("Fehler: " + "Die Mindestdauer beträgt " + min_days + " Tage.");
          }
        }
      }
      document.getElementById('price_output').innerText = Math.round(price * 100 ) / 100;
      document.getElementById('end_datetime').addEventListener('input', calcprice);
    </script>

    </div>

    <script>
      function copy(txt) {
        var copyText = document.getElementById(txt);
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
        alert("Copied the text: " + copyText.value);
      }
    </script>

    <!--<div id="werbung">
<iframe style="width:120px;height:240px;" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" src="//ws-eu.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&OneJS=1&Operation=GetAdHtml&MarketPlace=DE&source=ac&ref=tf_til&ad_type=product_link&tracking_id=heldendesbild-21&marketplace=amazon&region=DE&placement=B07WFQQLBG&asins=B07WFQQLBG&linkId=8841e2dc7d055c4469d0eaf3233e1d2b&show_border=false&link_opens_in_new_window=false&price_color=333333&title_color=0066c0&bg_color=ffffff">
    </iframe>

<iframe style="width:120px;height:240px;" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" src="//ws-eu.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&OneJS=1&Operation=GetAdHtml&MarketPlace=DE&source=ac&ref=tf_til&ad_type=product_link&tracking_id=heldendesbild-21&marketplace=amazon&region=DE&placement=B07PVCVBN7&asins=B07PVCVBN7&linkId=19eb6fd6268585cc196290d07813cf3a&show_border=false&link_opens_in_new_window=false&price_color=333333&title_color=0066c0&bg_color=ffffff">
    </iframe>
</div>-->

  </content_box>
</body>

<footer>
  <text>
    <ul>
      <!-- <li>&copy; 2019 Helden des Bildschirms</li> -->
      <li><a href="mailto:support@heldendesbildschirms.de">Kontakt</a></li>
      <li><a href="datenschutz.html">Datenschutz</a></li>
      <li><a href="impressum.html">Impressum</a></li>
    </ul>
  </text>
</footer>

</html>
