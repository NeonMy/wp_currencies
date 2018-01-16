<?php namespace Currency;

use Currency\Admin\Admin;
use Currency\Frontend\Frontend;

/**
 * Class CurrencyPlugin
 *
 * @package Currency
 */
class CurrencyPlugin {

	/**
	 * @var FileManager
	 */
	private $fileManager;
    
    /**
     *
     * @var type 
     */
	static $table = 'wp_currencies';

	/**
	 * PluginManager constructor.
	 *
	 * @param FileManager $fileManager
	 */
	public function __construct( FileManager $fileManager ) {

		$this->fileManager = $fileManager;

        add_action('init', [ $this, 'loadTextDomain' ]);

	}

	/**
	 * Run plugin part
	 */
	public function run() {
		if ( is_admin() ) {
			new Admin( $this->fileManager );
		} else {
			new Frontend( $this->fileManager );
		}

	}

    /**
     * Load plugin translations
     */
    public function loadTextDomain()
    {
        $name = $this->fileManager->getPluginName();
        load_plugin_textdomain($name, false, $name . '/languages/');
    }

	/**
	 * Fired when the plugin is activated
	 */
	public function activate() { 
        $sql =   " CREATE TABLE IF NOT EXISTS `" . \Currency\CurrencyPlugin::$table . "` (".
                 " `id` int(11) NOT NULL AUTO_INCREMENT,".
                 " `name` varchar(255) CHARACTER SET utf8 NOT NULL,".
                 " `symbol` varchar(20) CHARACTER SET utf8 NOT NULL,".
                 " `rate` double(12,5) NOT NULL,".
                 " `iso_code` varchar(20) CHARACTER SET utf8 NOT NULL,".
                 " PRIMARY KEY (`id`)".
                 " ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
        
        \Currency\CurrencyPlugin::incAndUpd($sql);
	}

	/**
	 * Fired when the plugin is deactivated
	 */
	public function deactivate() {
	}

	/**
	 * Fired during plugin uninstall
	 */
	public static function uninstall() {
        $sql = "DROP TABLE " . \Currency\CurrencyPlugin::$table . ";";
        \Currency\CurrencyPlugin::incAndUpd($sql);
	}
    
    public static function incAndUpd($sql = '') {
        global $wpdb;
        
        if (!$sql) {
            return false;
        }   
        
        $wpdb->query($sql);
        
    }
    
}