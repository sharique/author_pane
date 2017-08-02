<?php
/**
 * @file
 * Contains the \Drupal\author_pane\Annotation\AuthorPaneDatum annotation plugin.
 */

namespace Drupal\author_pane\Annotation;

use Drupal\Component\Annotation\Plugin;


/**
 * Defines a AuthorPane annotation object.
 *
 * @Annotation
 */
class AuthorPane extends Plugin {
  /**
   * Machine name of the plugin.
   *
   * @var string
   */
  public $id;

  /**
   * Title of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

  /**
   * A longer explanation of what the plugin is for.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $description;

}