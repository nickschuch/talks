<?php

namespace Drupal\remote_article\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Remote Article entities.
 *
 * @ingroup remote_article
 */
interface RemoteArticleEntityInterface extends ContentEntityInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Remote Article name.
   *
   * @return string
   *   Name of the Remote Article.
   */
  public function getName();

  /**
   * Sets the Remote Article name.
   *
   * @param string $name
   *   The Remote Article name.
   *
   * @return \Drupal\remote_article\Entity\RemoteArticleEntityInterface
   *   The called Remote Article entity.
   */
  public function setName($name);

  /**
   * Gets the Remote Article body.
   *
   * @return string
   *   Body of the Remote Article.
   */
  public function getBody();

  /**
   * Sets the Remote Article body.
   *
   * @param string $body
   *   The Remote Article body.
   *
   * @return \Drupal\remote_article\Entity\RemoteArticleEntityInterface
   *   The called Remote Article entity.
   */
  public function setBody($body);

}
