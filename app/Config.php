<?php

namespace Urban;

class Config {
	public static string $chosen_theme; // Текущая тема
	public static string $blocks_dir; // Папка с блоками ACF
	public static string $parts_dir; // Папка parts
	protected string $app_dir; // Папка App
	protected string $dist_dir; // Сборка
	protected string $filemtime_style; // Версия стилей
	protected string $general_style; // Путь к файлу общих стилей
	protected string $version_css; // Урл к файлу стилей версии
	protected string $version_js; // Урл к файлу скриптов версии
	protected string $shared_js_path; // Путь к файлу общих скриптов

	public function __construct() {
		$this->app_dir = get_template_directory_uri() . '/app';

		$this->dist_dir = get_template_directory_uri() . '/dist';

		$this->filemtime_style = filemtime( $this->dist_dir . '/css/app.css' );

		$this->general_style = $this->dist_dir . '/css/app.css';

		$this->shared_js_path = $this->dist_dir . '/js/app.js';

		self::$chosen_theme = get_field( 'select_version', 'options' ) ?? 'v1';

		$this->version_css = match ( self::$chosen_theme ) {
			'v2' => $this->dist_dir . '/css/v2.css',
//			'v3' => $this->dist_dir . '/css/v3.css',
			default => $this->dist_dir . '/css/v1.css'
		};

		$this->version_js = match ( self::$chosen_theme ) {
			'v2' => $this->dist_dir . '/js/v2.js',
//			'v3' => $this->dist_dir . '/js/v3.js',
			default => $this->dist_dir . '/js/v1.js'
		};

		self::$blocks_dir = '/blocks';
		self::$parts_dir  = get_template_directory() . '/template-parts';
	}

	public static function get_chosen_theme() {
		return self::$chosen_theme;
	}

}
