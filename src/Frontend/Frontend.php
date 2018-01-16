<?php namespace Currency\Frontend;

use Currency\FileManager;

/**
 * Class Frontend
 *
 * @package Currency\Frontend
 */
class Frontend {


	/**
	 * @var FileManager
	 */
	private $fileManager;

	public function __construct( FileManager $fileManager ) {
		$this->fileManager = $fileManager;
	}

}