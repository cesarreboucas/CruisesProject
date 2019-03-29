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
          <link rel="stylesheet" href="css/bulma-calendar.min.css">
          <script src="js/bulma-calendar.min.js"></script>
          <script>
        </head>
          <body>
            <nav class="navbar is-link" role="navigation" aria-label="main navigation">
              <div class="navbar-brand">
                <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" 
                  data-target="navbarBasic">
                  <span aria-hidden="true"></span>
                  <span aria-hidden="true"></span>
                  <span aria-hidden="true"></span>
                </a>
                </div>
                <div id="navbarBasic" class="navbar-menu">
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
              <script>
              document.addEventListener('DOMContentLoaded', () => {
                const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
                if ($navbarBurgers.length > 0) {
                  $navbarBurgers.forEach( el => {
                    el.addEventListener('click', () => {
                      const target = el.dataset.target;
                      const $target = document.getElementById(target);
                      //console.log(target);
                      el.classList.toggle('is-active');
                      $target.classList.toggle('is-active');
                    });
                  });
                }
              });
              </script>
              <div id="container" style="margin:auto;width:80%;">
    <?php
    }

  static function showTours($tours) {
    if(!empty($tours)) {
      echo '<table class="table" style="width:100%;">
              <tr>
                <th>Ship</th>
                <th>Sailing Date</th>
                <th>Duration</th>
                <th>Departure</th>
                <th>Destiny</th>
                <th>One-Way</th>
                <th>Actions</th>
              </tr>';
      foreach($tours as $tour) {
        echo '<tr>
            <td>'.$tour->getShipName().'</td>
            <td>'.$tour->getSailingDate()->format('d-M-Y').'</td>
            <td>'.$tour->getDuration().'</td>
            <td>'.$tour->getFromCityName().'</td>
            <td>'.$tour->getToCityName().'</td>
            <td>'.($tour->getOneway()==1?'One Way':'Round Trip').'</td>
            <td>
              <a href="'.$_SERVER['PHP_SELF'].'?id='.$tour->getId().'&a=e" class="button is-primary">Edit</a>
              <a href="'.$_SERVER['PHP_SELF'].'?id='.$tour->getId().'&a=e" class="button is-primary">Delete</a>
            </td>
          </tr>';
      }
      echo '</table>';
    }
  }
  static function FormTour($tour) {
    CitiesMapper::Initialize();
    $cities = CitiesMapper::getCities();
  ?>

    <div class="field">
      <label class="label">Sailing Date</label>
      <div class="control">
        <input class="input" type="input" />
      </div>
    </div>
    <div class="field">
      <label class="label">Ship</label>
      <div class="select is-fullwidth">
        <select>
          <option value="1">1 Sei la</option>
          <option value="2">2 Sei la 2</option>
        </select>
    </div>
    </div>
    <div class="field">
      <label class="label">Duration</label>
      <div class="control">
        <input class="input" type="input" />
      </div>
    </div>
    <div class="field">
      <label class="label">Departure</label>
      <div class="select is-fullwidth">
        <select>
          <option value=0>Select City</option>
          <?php 
            if(!empty($cities)) {
              foreach($cities as $city) {
                echo '<option value="'.$city->getId().'">'.$city->getName().'</option>';
              }
            }
            ?>
        </select>
    </div>
    <div class="field">
      <label class="label">Destiny</label>
      <div class="select is-fullwidth">
        <select>
          <option value=0>Select City</option>
          <?php 
          if(!empty($cities)) {
            foreach($cities as $city) {
              echo '<option value="'.$city->getId().'">'.$city->getName().'</option>';
            }
          }
          ?>
        </select>
    </div>
    <div class="field">&nbsp;
      <div class="control">
        <label class="checkbox">
          <input type="checkbox"> One Way
        </label>
      </div>
    </div>
    <div class="field is-grouped">
      <div class="control">
        <button class="button is-link">Submit</button>
      </div>
    </div>
  <?php
  }

  static function footer() {
    ?>
        </div>
      </body>
    </html>
  <?php
  }
}

?>