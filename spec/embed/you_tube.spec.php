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
            $addFilter->with('oembed_dataparse', [$this->youTube, 'addTitleAttribute'], 10, 3)->once();

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

    describe('addTitleAttribute', function () {
        beforeEach(function () {
            $this->input = '<iframe src="https://www.youtube.com/watch?v=E5i2Wa7daDA"></iframe>';
        });

        context('has no title', function () {
            beforeEach(function () {
                $this->data = (object)[];
                $this->url = 'https://www.dxw.com/';
            });

            it('does nothing', function () {
                $output = $this->youTube->addTitleAttribute($this->input, $this->data, $this->url);
                expect($output)->to->equal($this->input);
            });
        });

        context('includes title', function () {
            beforeEach(function () {
                $this->data = (object)[
                    'title' => 'The Title',
                ];
            });

            context('URL is not YouTube', function () {
                beforeEach(function () {
                    $this->url = 'https://www.dxw.com/';
                });

                it('does nothing', function () {
                    $output = $this->youTube->addTitleAttribute($this->input, $this->data, $this->url);
                    expect($output)->to->equal($this->input);
                });
            });

            context('URL is youtube.com', function () {
                beforeEach(function () {
                    $this->url = 'https://www.youtube.com/watch?v=E5i2Wa7daDA';
                });

                it('adds TITLE attribute to IFRAME', function () {
                    $output = $this->youTube->addTitleAttribute($this->input, $this->data, $this->url);
                    expect($output)->to->equal(
                        '<iframe src="https://www.youtube.com/watch?v=E5i2Wa7daDA" title="Video: _The Title_"></iframe>'
                    );
                });
            });

            context('URL is youtu.be', function () {
                beforeEach(function () {
                    $this->url = 'https://youtu.be/E5i2Wa7daDA';
                });

                it('adds TITLE attribute to IFRAME', function () {
                    $output = $this->youTube->addTitleAttribute($this->input, $this->data, $this->url);
                    expect($output)->to->equal(
                        '<iframe src="https://www.youtube.com/watch?v=E5i2Wa7daDA" title="Video: _The Title_"></iframe>'
                    );
                });
            });
        });
    });
});
