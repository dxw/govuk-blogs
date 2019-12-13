<?php

namespace GovUKBlogs;

use \phpmock\mockery\PHPMockery;

describe(FixRoots::class, function () {
    beforeEach(function () {
        $this->fixRoots = new FixRoots();
    });

    afterEach(function () {
        \Mockery::close();
    });

    it('is registerable', function () {
        expect($this->fixRoots)->to->be->instanceof(\Dxw\Iguana\Registerable::class);
    });

    describe('->register()', function () {
        it('does something', function () {
            PHPMockery::mock(__NAMESPACE__, 'add_action')->with('init', [$this->fixRoots, 'fixRoots'])->once();

            $this->fixRoots->register();
        });
    });

    describe('->fixRoots()', function () {
        it('removes the filter', function () {
            PHPMockery::mock(__NAMESPACE__, 'remove_filter')->with('style_loader_tag', 'roots_clean_style_tag')->once();

            $this->fixRoots->fixRoots();
        });
    });
});
