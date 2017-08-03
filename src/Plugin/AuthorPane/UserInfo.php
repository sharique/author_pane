<?php
/**
 * @file
 * Contains \Drupal\author_pane\Plugin\Username.
 */

namespace Drupal\author_pane\Plugin\AuthorPane;


/**
 * Provides the Username plugin.
 *
 * @AuthorPane(
 *   id = "userinfo",
 *   label = @Translation("Userinfo"),
 *   description = @Translation("Author's user info"),
 *   name = "User Info",
 * )
 */
class UserInfo extends AuthorPaneBase {

  public function build() {
    // @TODO: Change this to the real output.
    $output = [
      '#theme' => 'userinfo',
      '#user' => $this->author->getUsername(),
    ];
    return $output;
  }

}