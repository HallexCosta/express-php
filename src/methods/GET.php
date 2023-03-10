<?php

require_once(Helpers::rootPath('./src/methods/Request.php'));
require_once(Helpers::rootPath('./src/methods/Response.php'));

class GET implements SplObserver
{
  public $endpoint;
  public $handler;

  public function __construct($endpoint, $handler)
  {
    $this->method = strtoupper(get_class($this));
    $this->endpoint = $endpoint;
    $this->handler = $handler;
  }
  /**
   * Receive update from subject
   * This method is called when any SplSubject to which the observer is attached calls SplSubject::notify().
   *
   * @param SplSubject $subject The SplSubject notifying the observer of an update.
   * @return void
   */
  public function update($subject)
  {
    $splitedEndpoint = explode('/', $this->endpoint);
    $splitedCurrentEndpoint = explode('/', $subject->currentEndpoint);
    array_shift($splitedEndpoint);
    array_shift($splitedCurrentEndpoint);

    $endpointSize = sizeof($splitedEndpoint);
    $currentEndpointSize = sizeof($splitedCurrentEndpoint);
    $endpointsIsEquivalent = $endpointSize === $currentEndpointSize;

    if ($endpointsIsEquivalent) {
      echo '<strong>Is equivalents</strong></br>';
    }

    if (DEBUG) {
      Helpers::print("currentEndpoint=%s", $subject->currentEndpoint);
      Helpers::print("observerEndpoint=%s", $this->endpoint);
    }

    $isEndpoint = $this->verifyEndpointURI($subject->currentEndpoint);
    $isMethod = $this->verifyEndpointMethod($subject->method);
    var_dump($this->method);

    // execute endpoint handler
    if ($isEndpoint && $isMethod) {
      call_user_func_array($this->handler, []);
    }

    // var_dump($endpointsIsEquivalent);
    if ($endpointsIsEquivalent && $subject->method === 'POST') {
      $params = [];

      foreach ($splitedEndpoint as $index => $paramName) {
        if (strpos($paramName, ':') !== false) {
          // getting value from endpoint URI, ex: '/users/2'
          $paramValue = $splitedCurrentEndpoint[$index];

          if (strpos($paramValue, '?') !== false) {
            $paramValueWithoutQueryParams = explode('?', $paramValue)[0];
            $params[$paramName] = $paramValueWithoutQueryParams;
          } else {
            $params[$paramName] = $paramValue;
          }
        }
      }

      call_user_func_array($this->handler, [
        new Request($subject->currentEndpoint, $params),
        new Response()
      ]);
      var_dump($params);
    }
  }

  public function verifyEndpointURI($currentEnpoint)
  {
    if ($currentEnpoint === $this->endpoint) {
      return true;
    }

    return false;
  }

  public function verifyEndpointMethod($currentMethod)
  {
    if ($this->method === $currentMethod) {
      return true;
    }

    return false;
  }

  public function queryParams()
  {

  }
}