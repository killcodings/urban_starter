<?php

$select_version = get_field('select_version', 'options') ?? 'v1';
define( 'VERSION_STYLE',  $select_version);

class Config {
	public static string $chosen_theme; // Текущая тема
	public static string $img_assets_dir; // Папка с картинками для верстки
	public static string $acf_blocks_dir; // Папка с блоками ACF
	public static string $parts_dir; // Папка parts
	protected string $app_dir; // Папка App
	protected string $dist_dir; // Сборка
	protected string $assets_ver; // Версия стилей для избежания кэширования браузерами
	protected string $dist_uri; // Урл к папке стилей
	protected string $shared_css_uri; // Урл к файлу общих стилей
	protected string $shared_css_path; // Путь к файлу общих стилей
	protected string $version_css_uri; // Урл к файлу стилей версии
	protected string $version_js_uri; // Урл к файлу скриптов версии
	protected string $shared_js_uri; // Урл к файлу скриптов версии
	protected string $shared_js_path; // Путь к файлу общих скриптов

	public function __construct() {
		$this->app_dir         = get_template_directory() . '/app';
		$this->dist_dir        = get_template_directory() . '/assets/dist';
		$this->dist_uri        = get_template_directory_uri() . '/assets/dist';
		$this->assets_ver      = filemtime( $this->dist_dir . '/css/app.css' );
		$this->shared_css_uri  = $this->dist_uri . '/css/app.css';
		$this->shared_css_path = $this->dist_dir . '/css/app.css';
		$this->shared_js_uri   = $this->dist_uri . '/js/app.js';
		$this->shared_js_path  = $this->dist_dir . '/js/app.js';
		self::$chosen_theme    = wp_cache_get( 'theme-choose', 'theme-setup' );

		if ( ! self::$chosen_theme ) {
			$chosen_theme       = @get_field( 'theme_choose', 'options' );
			self::$chosen_theme = $chosen_theme ?? 'v1';
			wp_cache_set( 'theme-choose',
				self::$chosen_theme,
				'theme-setup',
				60 * 5 );
		}

		$this->version_css_uri = match ( self::$chosen_theme ) {
			'v2' => $this->dist_uri . '/css/ver_2.css',
			'v3' => $this->dist_uri . '/css/ver_3.css',
			default => $this->dist_uri . '/css/ver_1.css'
		};

		$this->version_js_uri  = match ( self::$chosen_theme ) {
			'v2' => $this->dist_uri . '/js/ver_2.js',
			'v3' => $this->dist_uri . '/js/ver_3.js',
			default => $this->dist_uri . '/js/ver_1.js'
		};

		self::$img_assets_dir  = $this->dist_uri . '/images';
		self::$acf_blocks_dir  = '/app/Acf/blocks';
		self::$parts_dir       = get_template_directory() . '/parts';
	}

	public static function get_versions_dir( string $block_dir ): string {
		return self::$acf_blocks_dir . "/$block_dir/" . 'versions/';
	}
}
