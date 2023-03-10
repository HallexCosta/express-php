<?php

spl_autoload_register(function ($class) {
  include 'src/' . $class . '.php';
  include 'src/utils/' . $class . '.php';
});