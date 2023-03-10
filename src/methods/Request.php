<?php

class Request
{
  public $params;
  public $body;
  public $query;
  public $headers;
  public function __construct($endpoint, $params)
  {
    $this->params = $params;
    $this->query = $this->transformQueryParams($endpoint);
    $this->headers = $this->transformHeaders();
    var_dump($this->headers);
    $this->body = $this->transformBody($this->headers['Content-Type']);
    var_dump($this->body);
  }

  public function transformHeaders()
  {
    $contentType = $_SERVER['HTTP_CONTENT_TYPE'] ?? $_SERVER['CONTENT_TYPE'];
    $headers = getallheaders();
    $headers['Content-Type'] = $contentType;

    return $headers;
  }

  public function transformBody($contentType)
  {
    if (strpos($contentType, 'application/json') !== false) {
      Helpers::printGreen('O corpo é do tipo JSON');
      return json_decode(file_get_contents('php://input'));
    }
    if (strpos($contentType, 'multipart/form-data') !== false) {
      Helpers::printGreen('O corpo é do tipo multipart/form-data');
      return $_POST;
    }
    throw new Error('Lança um erro ai pq eu não conheço este formato de corpo');
  }

  public function transformQueryParams($uri)
  {
    // Obtém a string da query string da URI
    $queryString = parse_url($uri, PHP_URL_QUERY);
    $queryParams = [];
    // Analisa a string da query string em uma matriz associativa
    parse_str($queryString, $queryParams);
    var_dump($queryParams);
    // retorna as queryParams
    return $queryParams;
  }
}