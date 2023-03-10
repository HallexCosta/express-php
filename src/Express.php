<?php

require Helpers::rootPath('./src/methods/GET.php');

class Express implements SplSubject
{
  public $currentEndpoint = '';
  public $method = '';
  private SplObjectStorage $observers;

  public function __construct()
  {
    if (DEBUG) {
      echo '<pre>';
    }
    $this->observers = new SplObjectStorage();

    $this->currentEndpoint = $_SERVER['REQUEST_URI'];
    $this->method = $_SERVER['REQUEST_METHOD'];

    if (DEBUG) {
      var_dump($this);
    }
  }

  public function __destruct()
  {
    $this->notify();
    if (DEBUG) {
      echo '</pre>';
    }
  }

  public function get(string $route, Closure $handler)
  {
    if (DEBUG) {
      Helpers::printGreen("Criando rota \"%s\" com método %s", $route, $this->method);
    }
    $this->attach(new GET($route, $handler));
  }
  /**
   * Attach an SplObserver
   * Attaches an SplObserver so that it can be notified of updates.
   *
   * @param SplObserver $observer The SplObserver to attach.
   * @return void
   */
  public function attach($observer)
  {
    $id = spl_object_hash($observer);
    $this->observers->attach($observer, $id);
  }

  /**
   * Detach an observer
   * Detaches an observer from the subject to no longer notify it of updates.
   *
   * @param SplObserver $observer The SplObserver to detach.
   * @return void
   */
  public function detach($observer)
  {
  }

  /**
   * Notify an observer
   * Notifies all attached observers.
   * @return void
   */
  public function notify()
  {
    Helpers::printBlue("Verificando qual endpoint corresponde a URL que o usuário acessou");
    foreach ($this->observers as $observer) {
      $observer->update($this);
    }
  }
}