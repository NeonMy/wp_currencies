<div class="welcome-panel-column-container">
    
        <div>
            <br>
            <span style="font-size: 24px; font-weight: bold; margin-right: 80px">
                <?php if (isset($values['id'])): ?>
                    <?php echo __('Edit currency', 'wp_currencies'); ?>                
                <?php else: ?>
                    <?php echo __('Create currency', 'wp_currencies'); ?>
                <?php endif; ?>
            </span>
            <a href="/wp-admin/admin.php?page=plugin-wp_currencies">Назад</a>
        </div>

    <?php if ($error): ?>
        <?php foreach ($error as $er): ?>
            <ul class="error-message">
                <li><?php echo $er; ?></li>
            </ul>
        <?php endforeach; ?>
    <?php endif; ?>

    <form action="" method="POST" class="welcome-panel-column">
        <?php if (isset($values['id'])): ?>
            <input type="hidden" name="id" required="required" value="<?php echo $values['name']; ?>"> 
        <?php endif; ?>
        <ul>
            <li>

                <div>
                    <label for="name">
                        <input type="text" id="name" name="name" required="required" value="<?php if (isset($values['name'])): ?><?php echo $values['name']; ?><?php endif; ?>"> : 
                        <span class="misc-pub-section misc-pub-post-status"><?php echo __('Name', 'wp_currencies'); ?></span>
                    </label>
                </div>
            </li>

            <li>
                <div>
                    <label for="symbol">
                        <input type="text" id="symbol" name="symbol" required="required" value="<?php if (isset($values['symbol'])): ?><?php echo $values['symbol']; ?><?php endif; ?>"> : 
                        <span class="misc-pub-section misc-pub-post-status"><?php echo __('Symbol', 'wp_currencies'); ?></span>
                    </label>
                </div>
            </li>

            <li>
                <div>
                    <label for="rate">
                        <input type="text" id="rate" name="rate" required="required" value="<?php if (isset($values['rate'])): ?><?php echo $values['rate']; ?><?php endif; ?>"> : 
                        <span class="misc-pub-section misc-pub-post-status"><?php echo __('Rate', 'wp_currencies'); ?></span>
                    </label>
                </div>
            </li>

            <li>
                <div>
                    <label for="iso_code">
                        <input type="text" id="iso" name="iso_code" required="required" value="<?php if (isset($values['iso_code'])): ?><?php echo $values['iso_code']; ?><?php endif; ?>"> : 
                        <span class="misc-pub-section misc-pub-post-status"><?php echo __('ISO', 'wp_currencies'); ?></span>
                    </label>
                </div>
            </li>
        </ul>
        <?php if (isset($values['id'])): ?>
            <input class="button button-primary" value="<?php echo __('Edit', 'wp_currencies'); ?>" type="submit">
        <?php else: ?>
            <input class="button button-primary" value="<?php echo __('Create', 'wp_currencies'); ?>" type="submit">
        <?php endif; ?>
    </form>
</div>