<?php

namespace Drupal\remote_article\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Remote Article entities.
 */
class RemoteArticleEntityViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['remote_article']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Remote Article'),
      'help' => $this->t('The Remote Article ID.'),
    );

    return $data;
  }

}
