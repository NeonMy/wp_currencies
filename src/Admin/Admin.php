<?php

namespace Currency\Admin;

use Currency\FileManager;

/**
 * Class Admin
 *
 * @package Currency\Admin
 */
class Admin {

    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * Admin constructor.
     *
     * Register menu items and handlers
     *
     * @param FileManager $fileManager
     */
    public function __construct(FileManager $fileManager) {
        $this->fileManager = $fileManager;

        add_action('admin_menu', [$this, 'currency_list']);
        add_action('admin_menu', [$this, 'currency_create']);
        add_action('admin_menu', [$this, 'currency_edit']);
    }

    /**
     * 
     */
    public function currency_list() {
        add_menu_page(
                $this->fileManager->getPluginName(), __('Currencies', 'wp_currencies'), 'manage_options', 'plugin-' . $this->fileManager->getPluginName(), function () {
            global $wpdb;
            $result = [];
            $result = $wpdb->get_results("SELECT * FROM " . \Currency\CurrencyPlugin::$table, ARRAY_A);
            $this->fileManager->includeTemplate('admin/list.php', ['result' => $result]);
        }, 'dashicons-welcome-learn-more');
    }

    /**
     * 
     */
    public function currency_create() {

        $error['error'] = [];
        $error['values'] = [];

        if ($_POST) {
            $error['error'] = self::checkData();

            if (!$error['error']) {
                $last_id = (int) self::save($_POST);
                if ($last_id) {
                    header('Location: /wp-admin/admin.php?page=plugin-wp_currencies-edit&id=' . $last_id);
                }
            } else {
                $error['values'] = $_POST;
            }
        }

        add_submenu_page(
                'plugin-' . $this->fileManager->getPluginName(), $this->fileManager->getPluginName(), __('Create', 'wp_currencies'), 'manage_options', 'plugin-' . $this->fileManager->getPluginName() . '-create', function () use ($error) {
            $this->fileManager->includeTemplate('admin/currency.php', $error);
        }, '');
    }

    /**
     * 
     */
    public function currency_edit() {
        global $wpdb;

        $error['error'] = [];
        $error['values'] = [];

        if ($_POST) {
            $error['error'] = self::checkData();

            if (!$error['error']) {
                self::save($_POST, ['id' => $_POST['id']]);
            }
        }

        $curId = isset($_GET['id']) ? (int)$_GET['id'] : false;
        $curId = (!$curId && isset($_POST['id'])) ? (int) $_POST['id'] : $curId;

        if ($curId) {
            $error['values'] = $wpdb->get_row("SELECT * FROM " . \Currency\CurrencyPlugin::$table . " WHERE id = " . $curId, ARRAY_A);
        }

        if ($error['values']) {
            add_submenu_page(
                    '', $this->fileManager->getPluginName(), __('Edit', 'wp_currencies'), 'manage_options', 'plugin-' . $this->fileManager->getPluginName() . '-edit', function () use ($error) {
                $this->fileManager->includeTemplate('admin/currency.php', $error);
            }, '');
        }
    }

    private function checkData() {

        $error = [];

        foreach ($_POST as $key => $value) {

            if ($key == 'rate' && !(float) $value) {
                $error[] = __('Field', 'wp_currencies') . ' ' . $key . ' ' . __('must be FLOAT', 'wp_currencies');
                continue;
            }

            if (!$value) {
                $error[] = __('Field', 'wp_currencies') . ' ' . $key . ' ' . __('is required', 'wp_currencies');
                continue;
            }
        }

        return $error;
    }

    private function save($data, $where = []) {
        global $wpdb;
        if ($where) {

            foreach ($where as $k => $v) {
                unset($data[$k]);
            }

            $wpdb->update(\Currency\CurrencyPlugin::$table, $data, $where);
        } else {
            $wpdb->insert(\Currency\CurrencyPlugin::$table, $data);
            return $wpdb->insert_id;
        }
    }

}
