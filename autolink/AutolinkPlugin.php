<?php

namespace Craft;

/**
 * Class AutolinkPlugin
 */
class AutolinkPlugin extends BasePlugin
{
	/**
	 * @var mixed
	 */
	private $addonJson;

	/**
	 * Plugin constructor
	 */
	public function __construct()
	{
		// Set the plugin path
		$path = realpath(dirname(__FILE__));

		// Get the addon json file
		$this->addonJson = json_decode(
			file_get_contents("{$path}/addon.json")
		);
	}

	/** @noinspection PhpMissingParentCallCommonInspection */
	/**
	 * Get the plugin name
	 *
	 * @return string
	 */
	public function getName()
	{
		return Craft::t('autolink');
	}

	/** @noinspection PhpMissingParentCallCommonInspection */
	/**
	 * Get the plugin Description
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return Craft::t('autolinkDescription');
	}

	/**
	 * Get the plugin version
	 *
	 * @return string
	 */
	public function getVersion()
	{
		return $this->addonJson->version;
	}

	/** @noinspection PhpMissingParentCallCommonInspection */
	/**
	 * Get the plugin schema version
	 *
	 * @return string
	 */
	public function getSchemaVersion()
	{
		return $this->addonJson->schemaVersion;
	}

	/**
	 * Get the plugin developer
	 *
	 * @return string
	 */
	public function getDeveloper()
	{
		return $this->addonJson->author;
	}

	/**
	 * Get the plugin developer URL
	 *
	 * @return string
	 */
	public function getDeveloperUrl()
	{
		return $this->addonJson->authorUrl;
	}

	/** @noinspection PhpMissingParentCallCommonInspection */
	/**
	 * Get the plugin developer URL
	 *
	 * @return string
	 */
	public function getDocumentationUrl()
	{
		return $this->addonJson->docsUrl;
	}

	/**
	 * Add autolink Header Twig extension
	 */
	public function addTwigExtension()
	{
		Craft::import(
			'plugins.autolink.twigextensions.AutoLinkTwigExtension'
		);

		return new AutoLinkTwigExtension();
	}
}
