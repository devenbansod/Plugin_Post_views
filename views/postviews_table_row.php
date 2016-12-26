<?php
/**
  * Post_views_plugin is free software: you can redistribute it and/or modify
  *	it under the terms of the GNU General Public License as published by
  * the Free Software Foundation, either version 2 of the License, or
  * any later version.
  *
  * Post_views_plugin is distributed in the hope that it will be useful,
  * but WITHOUT ANY WARRANTY; without even the implied warranty of
  * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  * GNU General Public License for more details.
  *
  * You should have received a copy of the GNU General Public License
  * along with Post_views_plugin. If not, see http://www.gnu.org/licenses/gpl-2.0.html.
  */
?>
<?php foreach ($posts as $post_obj) : ?>
    <tr>
        <td><?php echo $post_obj->ID; ?></td>
        <td><?php echo $post_obj->post_title; ?></td>
        <?php $user = get_userdata ( $post_obj->post_author );  ?>
        <td><?php echo $user->display_name; ?></td>
        <?php $post_views = get_post_meta( $post_obj->ID, 'post_views', true); ?>
        <td><?php echo ($post_views ? $post_views : '0'); ?> </td>
    </tr>
<?php endforeach; ?>