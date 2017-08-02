<?php
/**
 * @file
 * AuthorPaneManager class used as service .
 */

namespace Drupal\author_pane;


use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

class AuthorPaneManager extends DefaultPluginManager {

  /**
   * {@inheritdoc}
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    $subdir = 'Plugin/AuthorPane';

    // The name of the annotation class that contains the plugin definition.
    $plugin_definition_annotation_name = 'Drupal\author_pane\Annotation\AuthorPane';
    $plugin_interface = 'Drupal\author_pane\AuthorPaneInterface';

    parent::__construct($subdir, $namespaces, $module_handler, NULL, $plugin_definition_annotation_name);

    $this->alterInfo('author_pane_data');
    $this->setCacheBackend($cache_backend, 'author_pane_data');
  }

}
