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
            $addFilter = PHPMockery::mock(__NAMESPACE__, 'add_filter');
            $addFilter->with('embed_oembed_html', [$this->youTube, 'forceHttps'])->once();
            $addFilter->with('oembed_result', [$this->youTube, 'hideRelated'])->once();

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

    describe('->hideRelated()', function () {
        context('with no youtube link', function () {
            it('does nothing', function () {
                $output = $this->youTube->hideRelated('abc http://foo.bar.invalid/');
                expect($output)->to->equal('abc http://foo.bar.invalid/');
            });
        });

        context('with youtube link', function () {
            it('modifies link', function () {
                $output = $this->youTube->hideRelated('abc https://youtube.com/xyz?feature=oembed&xyz');
                expect($output)->to->equal('abc https://youtube.com/xyz?wmode=transparent&amp;rel=0&xyz');
            });
        });

        context('when there are extra parameters', function () {
            it('does nothing', function () {
                $output = $this->youTube->hideRelated('foo', 'http://xyz.invalid/', [1, 2, 3]);
                expect($output)->to->equal('foo');
            });
        });
    });
});
