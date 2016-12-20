<?php

namespace Craft;

/**
 * Class AutoLinkTwigExtension
 */
class AutoLinkTwigExtension extends \Twig_Extension
{
	/**
	 * Get Twig Extension name
	 *
	 * @return string
	 */
	public function getName()
	{
		return 'Autolink';
	}

	/** @noinspection PhpMissingParentCallCommonInspection */
	/**
	 * Get array of Twig Functions
	 *
	 * @return array
	 */
	public function getFilters()
	{
		return array(
			'autolink' => new \Twig_Filter_Method(
				$this,
				'autolink'
			)
		);
	}

	/**
	 * Autolink
	 *
	 * @param string $content
	 * @return string
	 */
	public function autolink($content)
	{
		// Regex
		$regexp = '/(<a.*?>)?((https?:\/\/)(?:www\.|(?!www))[^\s\.]+\.[^\s]{1,}|www\.[^\s]+\.[^\s]{1,})[^?.,! ](<\/a.*?>)?/i';

		// Anchor
		$anchorMarkup = "<a href=\"%s\">%s</a>";

		// Run regex matching
		preg_match_all($regexp, $content, $matches, \PREG_SET_ORDER);

		// Iterate through matches
		foreach ($matches as $match) {
			// Set vars
			$link = $match[0];
			$existingAnchor = $match[1];
			$protocol = isset($match[3]) ? $match[3] : '';

			// Make sure this is not an existing anchor
			if ($existingAnchor) {
				continue;
			}

			// Set protocol
			$finalLink = $link;
			if (! $protocol) {
				$finalLink = "http://{$link}";
			}

			// Setup replacement
			$replace = sprintf($anchorMarkup, $finalLink, $link);

			// Run replacement
			$content = str_replace($link, $replace, $content);
		}

		// Get the character set
		$charset = craft()->templates->getTwig()->getCharset();

		// Return the filtered content
		return new \Twig_Markup($content, $charset);
	}
}
