<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Articles {

  class ArticlesClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
      parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Articles\CreateRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Create(\Articles\CreateRequest $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/articles.Articles/Create',
      $argument,
      ['\Articles\CreateResponse', 'decode'],
      $metadata, $options);
    }

    /**
     * @param \Articles\GetRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Get(\Articles\GetRequest $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/articles.Articles/Get',
      $argument,
      ['\Articles\GetResponse', 'decode'],
      $metadata, $options);
    }

    /**
     * @param \Articles\UpdateRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Update(\Articles\UpdateRequest $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/articles.Articles/Update',
      $argument,
      ['\Articles\UpdateResponse', 'decode'],
      $metadata, $options);
    }

    /**
     * @param \Articles\DeleteRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Delete(\Articles\DeleteRequest $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/articles.Articles/Delete',
      $argument,
      ['\Articles\DeleteResponse', 'decode'],
      $metadata, $options);
    }

    /**
     * @param \Articles\ListRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function List(\Articles\ListRequest $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/articles.Articles/List',
      $argument,
      ['\Articles\ListResponse', 'decode'],
      $metadata, $options);
    }

  }

}
