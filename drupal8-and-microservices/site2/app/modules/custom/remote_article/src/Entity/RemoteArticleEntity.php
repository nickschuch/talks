<?php

namespace Drupal\remote_article\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Defines the RemoteArticle entity.
 *
 * @ingroup remote_article
 *
 * @ContentEntityType(
 *   id = "remote_article",
 *   label = @Translation("Remote Article"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\remote_article\RemoteArticleEntityListBuilder",
 *
 *     "form" = {
 *       "default" = "Drupal\remote_article\Form\RemoteArticleEntityForm",
 *       "add" = "Drupal\remote_article\Form\RemoteArticleEntityForm",
 *       "edit" = "Drupal\remote_article\Form\RemoteArticleEntityForm",
 *       "delete" = "Drupal\remote_article\Form\RemoteArticleEntityDeleteForm",
 *     },
 *     "access" = "Drupal\remote_article\RemoteArticleEntityAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\remote_article\RemoteArticleEntityHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "remote_article",
 *   data_table = "remote_article_field_data",
 *   admin_permission = "administer remote_article entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "title",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/content/remote_article/{remote_article}",
 *     "add-form" = "/admin/content/remote_article/add",
 *     "edit-form" = "/admin/content/remote_article/{remote_article}/edit",
 *     "delete-form" = "/admin/content/remote_article/{remote_article}/delete",
 *     "collection" = "/admin/content/remote_article",
 *   },
 *   field_ui_base_route = "entity.remote_article.collection"
 * )
 */
class RemoteArticleEntity extends ContentEntityBase implements RemoteArticleEntityInterface {

  /**
   * {@inheritdoc}
   */
  public function id() {
    $value = $this->get('id')->value;
    if (empty($value)) {
        return 'NEW';
    }
    return $value;
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('title')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('title', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
  */
  public function getOwnerId() {
    return 'Nope';
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return 'Nope';
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isPublished() {
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function setPublished($published) {
    // Nope.
  }

  /**
   * {@inheritdoc}
   */
  public function getBody() {
    return $this->get('body')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setBody($body) {
    $this->set('body', $body);
    return $this;
  }

    /**
   * {@inheritdoc}
   */
  public static function create(array $values = array()) {
    $entity_manager = \Drupal::entityManager();
    return $entity_manager->getStorage($entity_manager->getEntityTypeFromClass(get_called_class()))->create($values);
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['id'] = BaseFieldDefinition::create('string')
        ->setLabel(new TranslatableMarkup('ID'))
        ->setReadOnly(TRUE)
        ->setSetting('unsigned', TRUE);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setDescription(t('The title of the Remote Article entity.'))
      ->setSettings(array(
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['body'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Body'))
      ->setDescription(t('The content of the Remote Article entity.'))
      ->setSettings(array(
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textarea',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    return $fields;
  }

}
