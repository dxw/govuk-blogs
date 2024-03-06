<?php

describe(GovUKBlogs\Theme\CSSManifest::class, function () {
	beforeEach(function () {
		allow('file_get_contents')->toBeCalled()->andReturn('{
			"rewrittenFiles": {
			"knownFile.css": "knownFile.1234.css"
			}
		}');
		$this->cssManifest = new GovUKBlogs\Theme\CSSManifest('/the/path/to/manifest.json');
	});

	describe('->get()', function () {
		context('the filename specified is not listed in the manifest', function () {
			it('returns an empty string', function () {
				$result = $this->cssManifest->get('unknownFile.css');

				expect($result)->toEqual('');
			});
		});

		context('the filename specified is listed in the manifest', function () {
			it('returns the path to that file relative to the manifest', function () {
				$result = $this->cssManifest->get('knownFile.css');

				expect($result)->toEqual('knownFile.1234.css');
			});
		});
	});
});
