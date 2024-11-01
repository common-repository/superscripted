<div id="simple-data-tables" class="simple-data-tables">
  <!-- search, filter, and # results per page -->
  <?php if ('' !== $filter) : ?>
    <?php if ('user' === $type) : ?>
      <div class="dynatable-filter">
        Filter by Role:
        <?php foreach ($data as $row) : ?>
          <?php foreach ($row as $key => $value) : ?>
            <?php if (!in_array($row->roles[0], $roles)) : ?>
              <?php $roles[] = $row->roles[0]; ?>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php endforeach; ?>
        <select id="user-role" name="role">
          <option value="">Display all roles</option>
          <option><?php echo implode('</option><option>', $roles); ?></option>
        </select>
      </div>
    <?php else : ?>
      <div class="dynatable-filter">
        Filter by Author:
        <?php foreach ($data as $row) : ?>
          <?php foreach ($row as $key => $value) : ?>
            <?php if ($key === 'post_author') : ?>
              <?php if (!in_array($value, $authors)) : ?>
                <?php $authors[] = $value; ?>
              <?php endif; ?>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php endforeach; ?>
        <select id="author-name" name="author">
          <option value="">Display all authors</option>
          <option><?php echo implode('</option><option>', $authors); ?></option>
        </select>
      </div>
    <?php endif; ?>
  <?php else : ?>
    <div class="dynatable-filter">&nbsp;</div>
  <?php endif; ?>
  <!-- simple data table content -->
  <table id="table-data-<?php echo $unique_key; ?>" class="sdt-table sdt-table-striped sdt-table-hover">
    <thead class="sdt-thead-light">
      <tr>
        <?php foreach ($data as $row) : ?>
          <?php if ('user' === $type) : ?>
            <?php $row = $row->data; ?>
          <?php endif; ?>
          <?php $row_ordered = array_merge(array_flip($columns), (array) $row); ?>
          <?php foreach ($row_ordered as $key => $value) : ?>
            <?php if (in_array($key, $columns)) : ?>
              <?php if ('user' === $type) : ?>
                <th><?php echo ucwords(str_replace('_', ' ', str_replace('user', '', $key))); ?></th>
              <?php else : ?>
                <th><?php echo ucwords(str_replace('_', ' ', array_search($key, $av_columns[$type]))); ?></th>
              <?php endif; ?>
            <?php endif; ?>
          <?php endforeach; ?>
          <?php break; ?>
        <?php endforeach; ?>
        <th class="sdt-none">Role</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $row) : ?>
        <?php if ('user' === $type) : ?>
          <?php
          $role = $row->roles[0];
          $row = $row->data;
          ?>
        <?php endif; ?>
        <tr>
          <?php $row_ordered = array_merge(array_flip($columns), (array) $row); ?>
          <?php foreach ($row_ordered as $key => $value) : ?>
            <?php if (in_array($key, $columns)) : ?>
              <?php if (preg_match('/^http|https/', $value)) : ?>
                <td><a href="<?php echo $value; ?>">Preview</a></td>
              <?php elseif ($key === 'author') : ?>
                <!-- need to be very careful with whitespaces for filter cells -->
                <td><?php echo trim($value); ?></td>
              <?php else : ?>
                <td><?php echo $value; ?></td>
              <?php endif; ?>
            <?php endif; ?>
          <?php endforeach; ?>
          <!-- used for filter user roles by this hidden cell -->
          <td class="sdt-none"><?php echo $role; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <!-- initialize dynatable -->
  <?php if ('user' === $type) : ?>
    <script>
      (function($) {
        $('#table-data-<?php echo $unique_key; ?>').dynatable({
          inputs: {
            queries: $('#user-role')
          }
        });
      })(jQuery);
    </script>
  <?php else : ?>
    <?php if ('' !== $filter) : ?>
      <script>
        (function($) {
          $('#table-data-<?php echo $unique_key; ?>').dynatable({
            inputs: {
              queries: $('#author-name')
            }
          });
        })(jQuery);
      </script>
    <?php else : ?>
      <script>
        (function($) {
          $('#table-data-<?php echo $unique_key; ?>').dynatable()
        })(jQuery);
      </script>
    <?php endif; ?>
  <?php endif; ?>
</div>