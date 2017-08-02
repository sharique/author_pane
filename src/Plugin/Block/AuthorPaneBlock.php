<?php

namespace Drupal\author_pane\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Author Pane block.
 *
 * @Block(
 *   id = "author_pane_block",
 *   admin_label = @Translation("Author Information"),
 *   context = {
 *     "node" = @ContextDefinition("entity:node", required = FALSE)
 *   }
 * )
 */
class AuthorPaneBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {

    $manager = \Drupal::service('plugin.manager.authorpane');
    $ops = $manager->getDefinitions();

    $options = [];
    foreach ($ops as $item) {
      $options[$item['id']] = $item['name'];
    }

    $config = $this->getConfiguration();

    $form['author_pane'] = [
      '#type' => 'select',
      '#title' => $this->t('Which author pane to display?'),
      //'#default_value' => $config['author_pane'],
      '#options' => $options,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['author_pane'] = $form_state->getValue('author_pane');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $block = [];

    // Try to determine the author from context.
    $author = $this->findAuthor();

    // If we have no author, we can't build the pane.
    if (!is_null($author)) {
      $config = $this->getConfiguration();
      $manager = \Drupal::service('plugin.manager.authorpane');
      $this->authorPane = $manager->createInstance($config['author_pane']);
      $this->authorPane->setAuthor($author);
      $content = $this->authorPane->build();

      // @TODO: More advanced theming on the block?
      $block = ['#markup' => $content];
    }

    return $block;
  }

  /**
   * Attempts to find the author for the current page.
   *
   * @return \Drupal\user\UserInterface
   *   The author user entity.
   */
  private function findAuthor() {
    // Check if we are on a profile page.
    $author = \Drupal::request()->attributes->get('user');
    if (!is_null($author)) {
      return $author;
    }

    // Check if there is a node context we can pull the author from.
    $node = $this->getContextValue('node');
    if (!is_null($node)) {
      return $node->getOwner();
    }

    // @TODO: Figure out how to make this work in other situations.

    // No source found for the author.
    return NULL;
  }
}
