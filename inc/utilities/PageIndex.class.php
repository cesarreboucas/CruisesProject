<?php

class PageIndex {
  public static $title = "Cruises";

  static function header() {
  ?>
      <!DOCTYPE html>
      <html lang="en">
        <head>
          <meta charset="utf-8">
          <title><?php echo self::$title; ?></title>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
        </head>
          <body>
            <nav class="navbar" role="navigation" aria-label="main navigation">
              <div class="navbar-brand">
                <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                  <span aria-hidden="true"></span>
                  <span aria-hidden="true"></span>
                  <span aria-hidden="true"></span>
                </a>
                </div>
                <div id="navbarBasicExample" class="navbar-menu">
                  <div class="navbar-start">
                    <a class="navbar-item" href="ships.php">Ships</a>
                    <a class="navbar-item" href="index.php">Tours</a>
                    <div class="navbar-item has-dropdown is-hoverable">
                      <a class="navbar-link">Others</a>
                      <div class="navbar-dropdown">
                        <a class="navbar-item" href="cities.php">Cities</a>
                        <a class="navbar-item" href="facilities.php">Facilities</a>
                      </div>
                    </div>
                  </div>
                  <div class="navbar-end">
                  </div>
                </div>
              </nav>
    <?php
    }

  static function footer() {
    ?>
      </body>
    </html>
  <?php
  }
}

?>