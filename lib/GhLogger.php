<?php

class GhLoggerException extends RuntimeException {
}

class GhLogger {
	const ERROR_LEVEL = 255;
	const DEBUG = 1;
	const NOTICE = 2;
	const WARNING = 4;
	const ERROR = 8;


	static protected $instance;
	static protected $enabled = false;
	static protected $filename;

	protected $file;

	static public function setFileName( $filename ) {
		self::$filename = $filename;
	}

	static public function getFileName() {
		if ( self::$filename == null ) {
			self::$filename = dirname( __FILE__ ) . '/../log/logger.log';
		}

		return self::$filename;
	}

	static public function enableIf( $condition = true ) {
		if ( (bool) $condition ) {
			self::$enabled = true;
		}
	}

	static public function disable() {
		self::$enabled = false;
	}

	static protected function getInstance() {
		if ( ! self::hasInstance() ) {
			self::$instance = new self( "astreinte.log" );
		}

		return self::$instance;
	}

	static protected function hasInstance() {
		return self::$instance instanceof self;
	}

	static public function writeIfEnabled( $message, $level = self::DEBUG ) {
		if ( self::$enabled ) {
			self::writeLog( $message, $level );
		}
	}

	static public function writeIfEnabledAnd( $condition, $message, $level = self::DEBUG ) {
		if ( self::$enabled ) {
			self::writeIf( $condition, $message, $level );
		}
	}

	static public function writeLog( $message, $level = self::DEBUG ) {
		self::getInstance()->writeLine( $message, $level );
	}

	static public function writeIf( $condition, $message, $level = self::DEBUG ) {
		if ( $condition ) {
			self::writeLog( $message, $level );
		}
	}

	protected function __construct() {
		if ( ! $this->file = fopen( self::getFileName(), 'a+' ) ) {
			throw new GhLoggerException( sprintf( "Could not open file '%s' for writing.", self::getFileName() ) );
		}

		$this->writeLine( "\n===================== STARTING =====================", 0 );
	}

	public function __destruct() {
		$this->writeLine( "\n===================== ENDING =====================", 0 );
		fclose( $this->file );
	}

	protected function writeLine( $message, $level ) {
		if ( $level & self::ERROR_LEVEL ) {
			$date    = new DateTime();
			$en_tete = $date->format( 'd/m/Y H:i:s' );
			switch ( $level ) {
				case self::NOTICE:
					$en_tete = sprintf( "%s (notice)", $en_tete );
					break;
				case self::WARNING:
					$en_tete = sprintf( "%s WARNING", $en_tete );
					break;
				case self::ERROR:
					$en_tete = sprintf( "\n%s **ERROR**", $en_tete );
					break;
			}

			if ( isset( $_SESSION['is_logged_in'] ) ) {
				$who   = $_SESSION['user_name'];
				$group = $_SESSION['group'];
			} else {
				$who   = "";
				$group = "";
			}
			$message = sprintf( "%s -- %s -- %s -- %s\n", $en_tete, $message, $who, $group );
			fwrite( $this->file, $message );
		}
	}
}