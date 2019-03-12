<?php

namespace Drupal\remote_article\Entity\RemoteArticleStore;

use Drupal\Core\Language\LanguageInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Drupal\Core\KeyValueStore\StorageBase;
use Drupal\Core\DependencyInjection\DependencySerializationTrait;

/**
 * Defines a default key/value store implementation.
 *
 * This is Drupal's default key/value store implementation. It uses the database
 * to store key/value data.
 */
class RemoteArticleContentEntityStorage extends StorageBase {

  use DependencySerializationTrait;

  /**
   * The http client.
   *
   * @var \GuzzleHttp\Client
   */
  protected $client;

  /**
   * Overrides Drupal\Core\KeyValueStore\StorageBase::__construct().
   *
   * @param string $collection
   *   The name of the collection holding key and value pairs.
   * @param \Drupal\Component\Serialization\SerializationInterface $serializer
   *   The serialization class to use.
   * @param \Drupal\Core\Database\Connection $connection
   *   The database connection to use.
   * @param string $table
   *   The name of the SQL table to use, defaults to key_value.
   */
  public function __construct($collection, \Articles\ArticlesClient $client) {
    parent::__construct($collection);
    $this->client = $client;
  }

  /**
   * {@inheritdoc}
   */
  public function has($key) {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function getMultiple(array $keys) {
    $result = $this->getAll();

    $values = array();

    foreach ($keys as $key) {
      if (isset($result[$key])) {
        $values[$key] = $result[$key];
      }
    }

    return $values;
  }

  /**
   * {@inheritdoc}
   */
  public function getAll() {
    $articles = array();

    $opts = new \Articles\ListRequest();

    // @todo, We should be checking the return status.
    list($resp, $status) = $this->client->List($opts)->wait();

    foreach ($resp->getArticles() as $delta => $article) {
        $id = $article->getId();
        $articles[$id] = array(
          'id' => [LanguageInterface::LANGCODE_DEFAULT => $id],
          'title' => [LanguageInterface::LANGCODE_DEFAULT => $article->getTitle()],
          'body' => [LanguageInterface::LANGCODE_DEFAULT => $article->getBody()],
      );
    }

    return $articles;
  }

  /**
   * {@inheritdoc}
   */
  public function set($key, $values) {
    $article = new \Articles\Article();
    $article->setId($key);
    $article->setTitle($values['title'][0]['value']);
    $article->setBody($values['body'][0]['value']);

    // Is this a new Article? Create Request.
    if ($key == "NEW") {
        $request = new \Articles\CreateRequest();
        $request->setArticle($article);
        $this->client->Create($request)->wait();
        return;
    }

    $request = new \Articles\UpdateRequest();
    $request->setArticle($article);
    $this->client->Update($request)->wait();
  }

  /**
   * {@inheritdoc}
   */
  public function setIfNotExists($key, $values) {
    $this->set($key, $values);
  }

  /**
   * {@inheritdoc}
   */
  public function rename($key, $new_key) {
    // Not supported.
  }

  /**
   * {@inheritdoc}
   */
  public function deleteMultiple(array $keys) {
    foreach ($keys as $key) {
       $request = new \Articles\DeleteRequest();
       $request->setId($key);
       $this->client->Delete($request)->wait();
    }
  }

  /**
   * {@inheritdoc}
   */
  public function deleteAll() {
    $remote_articles = $this->getAll();
    $this->deleteAll(array_keys($remote_articles));
  }

}
