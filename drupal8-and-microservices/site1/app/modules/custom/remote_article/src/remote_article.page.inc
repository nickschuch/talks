<?php

/**
 * @file
 * Contains remote_article.page.inc.
 *
 * Page callback for Remote Article entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Remote Article templates.
 *
 * Default template: remote_article.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_remote_article(array &$variables) {
  // Fetch RemoteArticleEntity Entity Object.
  $remote_article = $variables['elements']['#remote_article'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}