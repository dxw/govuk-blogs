<?php

namespace GovUKBlogs\Theme;

class CSSManifest
{
	/** @var array<array-key, mixed> */
	private array $json;

	public function __construct(string $pathToCSSManifest)
	{
		/** @var array<array-key, mixed>|null */
		$json = json_decode(file_get_contents($pathToCSSManifest), true);

		if (!is_array($json)) {
			$json = [];
		}

		$this->json = $json;
	}

	public function get(string $fileName): string
	{
		$rewrittenFiles = $this->json['rewrittenFiles'] ?? [];

		if (!is_array($rewrittenFiles) || !array_key_exists($fileName, $rewrittenFiles)) {
			return '';
		}

		return (string) $rewrittenFiles[$fileName];
	}
}
