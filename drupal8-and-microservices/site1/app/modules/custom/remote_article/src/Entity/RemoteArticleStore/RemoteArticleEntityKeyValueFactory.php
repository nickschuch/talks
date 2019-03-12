<?php

namespace Drupal\remote_article\Entity\RemoteArticleStore;

use Drupal\Core\KeyValueStore\KeyValueFactoryInterface;
use Drupal\Component\Serialization\SerializationInterface;
use Drupal\Core\Database\Connection;

/**
 * Defines the key/value store factory for the database backend.
 */
class RemoteArticleEntityKeyValueFactory implements KeyValueFactoryInterface {

  /**
   * The database connection to use.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $client;

  /**
   * Constructs this factory object.
   *
   * @param \Drupal\Component\Serialization\SerializationInterface $serializer
   *   The serialization class to use.
   * @param \Drupal\Core\Database\Connection $connection
   *   The Connection object containing the key-value tables.
   */
  function __construct(\Articles\ArticlesClient $client) {
    $this->client = $client;
  }

  /**
   * {@inheritdoc}
   */
  public function get($collection) {
    return new RemoteArticleContentEntityStorage($collection, $this->client);
  }

}
