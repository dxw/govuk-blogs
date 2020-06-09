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
            beforeEach(function () {
                PHPMockery::mock(__NAMESPACE__, 'is_single')->with()->andReturn(false);
            });

            it('does nothing', function () {
                ob_start();
                $this->openGraphImage->wpHead();
                $output = ob_get_clean();
                expect($output)->to->equal('');
            });
        });

        context('when on a post', function () {
            beforeEach(function () {
                PHPMockery::mock(__NAMESPACE__, 'is_single')->with()->andReturn(true);
            });

            context('when there is no featured image', function () {
                beforeEach(function () {
                    PHPMockery::mock(__NAMESPACE__, 'has_post_thumbnail')->with()->andReturn(false);
                });

                it('does nothing', function () {
                    ob_start();
                    $this->openGraphImage->wpHead();
                    $output = ob_get_clean();
                    expect($output)->to->equal('');
                });
            });

            context('there is a featured image', function () {
                beforeEach(function () {
                    PHPMockery::mock(__NAMESPACE__, 'has_post_thumbnail')->with()->andReturn(true);
                    PHPMockery::mock(__NAMESPACE__, 'get_the_post_thumbnail_url')->with()->andReturn('https://govuk-blog.invalid/wp-content/uploads/my-image.png');
                });

                it('outputs an og:image tag', function () {
                    ob_start();
                    $this->openGraphImage->wpHead();
                    $output = ob_get_clean();
                    expect($output)->to->equal('<meta property="og:image" content="https://govuk-blog.invalid/wp-content/uploads/my-image.png">'."\n");
                });
            });
        });
    });
});
