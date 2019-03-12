<?php

namespace Drupal\remote_article;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Remote Article entity.
 *
 * @see \Drupal\remote_article\Entity\RemoteArticleEntity.
 */
class RemoteArticleEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\remote_article\Entity\RemoteArticleEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished remote_article entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published remote_article entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit remote_article entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete remote_article entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add remote_article entities');
  }

}
