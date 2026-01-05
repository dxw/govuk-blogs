<?php

namespace GovUKBlogs\Theme;

class CSSManifest
{
	private $json;

	public function __construct(string $pathToCSSManifest)
	{
		$this->json = json_decode(file_get_contents($pathToCSSManifest), true);
	}

	public function get(string $fileName): string
	{
		/** @var array<string,string> */
		$rewrittenFiles = $this->json['rewrittenFiles'] ?? [];

		if (!array_key_exists($fileName, $rewrittenFiles)) {
			return '';
		}

		return $rewrittenFiles[$fileName];
	}
}
