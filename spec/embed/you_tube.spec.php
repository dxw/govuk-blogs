<?php

namespace GovUKBlogs\Embed;

use \phpmock\mockery\PHPMockery;

describe(YouTube::class, function () {
    beforeEach(function () {
        $this->youTube = new YouTube();
    });

    afterEach(function () {
        \Mockery::close();
    });

    it('is registerable', function () {
        expect($this->youTube)->to->be->instanceof(\Dxw\Iguana\Registerable::class);
    });

    describe('->register()', function () {
        it('registers hooks', function () {
            PHPMockery::mock(__NAMESPACE__, 'add_filter')->with('embed_oembed_html', [$this->youTube, 'forceHttps'])->once();

            $this->youTube->register();
        });
    });

    describe('->forceHttps()', function () {
        context('when it does not contain youtube links', function () {
            it('does nothing', function () {
                $output = $this->youTube->forceHttps('abc http://foo.bar.invalid/');
                expect($output)->to->equal('abc http://foo.bar.invalid/');
            });
        });

        context('when it contains youtube links', function () {
            it('replaces http:// with https://', function () {
                $output = $this->youTube->forceHttps('abc http://www.youtube.com/');
                expect($output)->to->equal('abc https://www.youtube.com/');
            });
        });

        context('when there are extra parameters', function () {
            it('does nothing', function () {
                $output = $this->youTube->forceHttps('foo', 'http://xyz.invalid/', 'bar', 123);
                expect($output)->to->equal('foo');
            });
        });
    });
});
