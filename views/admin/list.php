
<div id="col-left">

    <div>
        <br>
        <span style="font-size: 24px; font-weight: bold; margin-right: 380px">
            <?php echo __('Currencies list', 'wp_currencies'); ?>
        </span>
        <a href="/wp-admin/admin.php?page=plugin-wp_currencies"><?php echo __('Create', 'wp_currencies'); ?></a>
    </div>

    <div>

    </div>
    <?php if (count($result) > 0): ?>
        <table class="wp-list-table widefat fixed striped tags">
            <thead>
                <tr>
                    <td class="manage-column column-cb check-column">
                        <?php echo __('Id', 'wp_currencies'); ?>
                    </td>
                    <td class="manage-column column-cb check-column">
                        <?php echo __('Name', 'wp_currencies'); ?>

                    </td>
                    <td class="manage-column column-cb check-column">
                        <?php echo __('ISO', 'wp_currencies'); ?>

                    </td>
                    <td class="manage-column column-cb check-column">
                        <?php echo __('Options', 'wp_currencies'); ?>

                    </td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $r): ?>
                    <tr>
                        <td >
                            <a href="/wp-admin/admin.php?page=plugin-wp_currencies-edit&id=<?php echo $r['id']; ?>">
                                <?php echo $r['id']; ?>
                            </a>
                        </td>
                        <td >
                            <?php echo $r['name']; ?>
                        </td>
                        <td >
                            <?php echo $r['iso_code']; ?>
                        </td>
                        <td >
                            <!--TODO-->
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    <?php else: ?>
        <?php echo __('Create new currency', 'wp_currencies'); ?>        
    <?php endif; ?>
</div>