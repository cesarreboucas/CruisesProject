<?php

class PageShips {

    static function showShips($ships) {
        echo '<table class="table" style="width:100%;">
        <thead>
          <tr>
            <th>Ships Name</th>
            <th>Year of Service</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>';
        foreach($ships as $ship) {
            echo '<tr>
            <td>'.$ship->getShipName().'</td>
            <td>'.$ship->getShipYear().'</td>
            <td><a href="'.$_SERVER['PHP_SELF'].'?act=delete&shipID='.$ship->getShipID().'" class="button is-warning">Delete</a></td>
          </tr>';
        }
        echo '</tbody>
      </table>';
    }

    static function showShipsForm()   { ?>

      <form method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
      
      <h3 class="title is-3">Add Ship</h3>

        <div class="field">
          <label class="label">Ship Name</label>
          <div class="control">
            <input class="input" type="text" name="name" id="name" /> 
          </div>
        </div>

        <div class="field">
          <label class="label">Year of Service</label>
          <div class="control">
            <input class="input" type="text" name="year" id="year" /> 
          </div>
        </div>

        <div class="field">
          <div class="control">
            <button class="button is-link" type="submit">Submit</button>
          </div>
        </div>
      
      </form>

  <?php }
}

?>