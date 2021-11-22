<?php
/**
 * Sanitizer
 *
 * @package Google\AMP_Plugin_Name_Compat
 */

namespace Google\AMP_Pretty_Links;

use AMP_Base_Sanitizer;
use DOMElement;
use DOMXPath;

/**
 * Class Sanitizer
 */
class Sanitizer extends AMP_Base_Sanitizer {

	/**
	 * Sanitize.
	 */
	public function sanitize() {
		if ( ! function_exists( 'prli_get_all_links' ) ) {
			return;
		}

		$xpath = new DOMXPath( $this->dom );
		// find Links.
		$links = $xpath->query( '//a' );
		
		// Get Pretty Links.
		$pretty_links      = prli_get_all_links();
		$pretty_links_urls = array();
		if ( ! empty( $pretty_links ) ) {
			foreach ( $pretty_links as $pretty_link ) {
				$pretty_links_urls[] = trailingslashit( prli_get_pretty_link_url( $pretty_link['id'] ) );
			}
		}

		if ( $links instanceof \DOMNodeList ) {
			foreach ( $links as $link ) {
				if ( $link instanceof \DOMElement ) {
					$url           = $link->getAttribute( 'href' );
					$canonical_url = amp_remove_endpoint( $url );
					if ( in_array( $canonical_url, $pretty_links_urls, true ) ) {
						$link->removeAttribute( 'rel' );
						$link->setAttribute( 'rel', 'noamphtml' );
						$link->setAttribute( 'href', $canonical_url );
					}
				}
			}
		}

	}

}
