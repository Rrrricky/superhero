<!DOCTYPE html>
<html lang="en">
<head>
  <title><?= $title ?></title> <!-- Specific element -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta property="og:image" content="/og-image.jpg">
  <meta property="og:image:width" content="1145">
  <meta property="og:image:height" content="599">
  <meta property="og:title" content="E19 - P2021">
  <meta property="og:description" content="Super-heroes">
  <link rel="apple-touch-icon" sizes="180x180" href="src/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="src/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="src/favicons/favicon-16x16.png">
  <link rel="manifest" href="src/favicons/site.webmanifest">
  <link rel="mask-icon" href="src/favicons/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="styles/reset.css"/>
  <link rel="stylesheet" href="styles/main.css"/>
  <script src="src/lottie.js"></script>
</head>
<body>
  <div id="container">
    <?= $container ?>   <!-- Specific element -->
  </div>
  <div class="loader-container">
    <div id="loader"></div>
  </div>
  <script src="src/loader.js"></script>
  <script src="src/scripts/FirstClass.js"></script>
  <script src="src/scripts/main.js"></script>
</body>
</html>