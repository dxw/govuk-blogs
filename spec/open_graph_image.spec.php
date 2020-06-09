<?php

namespace GovUKBlogs;

use \phpmock\mockery\PHPMockery;

describe(OpenGraphImage::class, function () {
    beforeEach(function () {
        $this->openGraphImage = new OpenGraphImage();
    });

    afterEach(function () {
        \Mockery::close();
    });

    it('is registerable', function () {
        expect($this->openGraphImage)->to->be->instanceof(\Dxw\Iguana\Registerable::class);
    });

    describe('->register()', function () {
        it('adds action', function () {
            PHPMockery::mock(__NAMESPACE__, 'add_action')->with('wp_head', [$this->openGraphImage, 'wpHead'])->once();

            $this->openGraphImage->register();
        });
    });

    describe('->wpHead()', function () {
        context('when not on a post/page', function () {
            it('does nothing', function () {
                ob_start();
                $this->openGraphImage->wpHead();
                $output = ob_get_clean();
                expect($output)->to->equal('');
            });
        });

        context('when on a post', function () {
            context('when there is no featured image', function () {
                it('does nothing', function () {
                    ob_start();
                    $this->openGraphImage->wpHead();
                    $output = ob_get_clean();
                    expect($output)->to->equal('');
                });
            });
        });
    });
});
