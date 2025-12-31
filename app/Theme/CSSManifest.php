<?php

namespace GovUKBlogs\Theme;

class CSSManifest
{
	private $json;

	public function __construct($pathToCSSManifest)
	{
		$this->json = json_decode(file_get_contents($pathToCSSManifest), true);
	}

	public function get($fileName): string
	{
		if (!array_key_exists($fileName, $this->json['rewrittenFiles'])) {
			return '';
		}
		return $this->json['rewrittenFiles'][$fileName];
	}
}
