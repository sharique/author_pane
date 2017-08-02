<?php

namespace Drupal\author_pane;

use Drupal\Component\Plugin\PluginInspectionInterface;

interface AuthorPaneInterface extends PluginInspectionInterface {

  /**
   * Returns renderable array
   *
   * @return array
   */
  public function build();

}