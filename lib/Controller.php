<?php

namespace MyApp;

class Controller {

  protected function isLoggedIn() {
    // $_SESSION['me']
    return isset($_SESSION['me']) && !empty($_SESSION['me']);
  }

}
