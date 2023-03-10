<?php

class Helpers
{
  static function rootPath($file_dir)
  {
    return $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $file_dir;
  }
  static function printGreen($stringFormat, ...$values)
  {
    self::print('green', $stringFormat, ...$values);
  }
  static function printBlue($stringFormat, ...$values)
  {
    self::print('blue', $stringFormat, ...$values);
  }
  static function printRed($stringFormat, ...$values)
  {
    self::print('red', $stringFormat, ...$values);
  }
  static function print($color, $stringFormat, ...$values)
  {
    printf("<label style=\"color: %s;\">$stringFormat</label><br/>", $color, ...$values);
  }
}