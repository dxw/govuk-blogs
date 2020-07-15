<?php

namespace GovUKBlogs\Embed;

use \phpmock\mockery\PHPMockery;

describe(YouTube::class, function () {
    beforeEach(function () {
        $this->youTube = new YouTube();

        PHPMockery::mock(__NAMESPACE__, 'esc_attr')->andReturnUsing(function ($a) {
            return "_${a}_";
        });
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
            $addFilter->with('oembed_dataparse', [$this->youTube, 'hideRelated'])->once();
            $addFilter->with('oembed_dataparse', [$this->youTube, 'useNocookie'])->once();

            $this->youTube->register();
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

    describe('->useNocookie()', function () {
        context('when it does not contain youtube links', function () {
            it('does nothing', function () {
                $output = $this->youTube->useNocookie('abc http://foo.bar.invalid/');
                expect($output)->to->equal('abc http://foo.bar.invalid/');
            });
        });

        context('when it contains youtube links (1)', function () {
            it('replaces www.youtube.com with www.youtube-nocookie.com', function () {
                $output = $this->youTube->useNocookie('abc https://www.youtube.com/');
                expect($output)->to->equal('abc https://www.youtube-nocookie.com/');
            });
        });

        context('when it contains youtube links (2)', function () {
            it('replaces youtube.com with www.youtube-nocookie.com', function () {
                $output = $this->youTube->useNocookie('abc https://youtube.com/');
                expect($output)->to->equal('abc https://www.youtube-nocookie.com/');
            });
        });

        context('when there are extra parameters', function () {
            it('does nothing', function () {
                $output = $this->youTube->useNocookie('foo', 'http://xyz.invalid/', 'bar', 123);
                expect($output)->to->equal('foo');
            });
        });
    });
});
