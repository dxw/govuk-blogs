<?php

namespace GovUKBlogs\Theme;

use \phpmock\mockery\PHPMockery;

describe(NiceSearch::class, function () {
    beforeEach(function () {
        $this->niceSearch = new NiceSearch();
    });

    afterEach(function () {
        \Mockery::close();
    });

    it('is registerable', function () {
        expect($this->niceSearch)->to->be->an->instanceof(\Dxw\Iguana\Registerable::class);
    });

    describe('->register()', function () {
        it('registers hooks', function () {
            $addFilter = PHPMockery::mock(__NAMESPACE__, 'add_filter');
            $addFilter->with('template_redirect', [$this->niceSearch, 'redirect'])->once();
            $addFilter->with('wpseo_json_ld_search_url', [$this->niceSearch, 'rewrite'])->once();

            $this->niceSearch->register();
        });
    });

    describe('->redirect()', function () {
        context('when $wp_rewrite is not set', function () {
            it('does nothing', function () {
                global $wp_rewrite;
                $wp_rewrite = null;

                $result = $this->niceSearch->redirect();
                expect($result)->to->equal(null);
            });
        });

        context('when $wp_rewrite is not an object', function () {
            it('does nothing', function () {
                global $wp_rewrite;
                $wp_rewrite = [];

                $result = $this->niceSearch->redirect();
                expect($result)->to->equal(null);
            });
        });

        context('when there is no search permalink structure defined', function () {
            it('does nothing', function () {
                global $wp_rewrite;

                $wp_rewrite = \Mockery::mock(\WP_Rewrite::class);
                $wp_rewrite->allows()->get_search_permastruct()->andReturns(false);

                $result = $this->niceSearch->redirect();
                expect($result)->to->equal(null);
            });
        });

        context('when a WP_Rewrite object exists', function () {
            beforeEach(function () {
                global $wp_rewrite;
                $wp_rewrite = \Mockery::mock(\WP_Rewrite::class);
                $wp_rewrite->allows()->get_search_permastruct()->andReturns(true);
                $wp_rewrite->search_base = 'search';
            });

            context('and when not on search results', function () {
                it('does nothing', function () {
                    PHPMockery::mock(__NAMESPACE__, 'is_search')->with()->andReturn(false);

                    $result = $this->niceSearch->redirect();
                    expect($result)->to->equal(null);
                });
            });

            context('and when on search results', function () {
                it('redirects to search permalink', function () {
                    $_SERVER['REQUEST_URI'] = 'http://foo.bar.invalid/not_search/';

                    PHPMockery::mock(__NAMESPACE__, 'is_search')->andReturn(true);
                    PHPMockery::mock(__NAMESPACE__, 'wp_redirect')->with('http://foo.bar.invalid/search/query');
                    PHPMockery::mock(__NAMESPACE__, 'get_search_link')->andReturn('http://foo.bar.invalid/search/query');

                    $this->niceSearch->redirect();
                });
            });
        });
    });

    describe('->rewrite()', function () {
        it('rewrites', function () {
            $url = 'http://foo.bar.invalid/?s=query';

            $result = $this->niceSearch->rewrite($url);
            expect($result)->to->equal('http://foo.bar.invalid/search/query');
        });
    });
});
