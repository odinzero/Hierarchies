<?php ?>

<table class="table">
    <thead>
        <tr>
            <th>category_id</th>
            <th>name</th>
            <th>lft</th>
            <th>rgt</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $v1) { ?>
               <tr>
            <?php foreach ($v1 as $k => $v ) { ?>  
                <td>
                    <?= $v ?>
                </td>
            <?php  } ?>
        </tr>
  <?php  } ?>
    </tbody>
</table>
