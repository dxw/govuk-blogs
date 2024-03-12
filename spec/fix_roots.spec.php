<?php

namespace GovUKBlogs;

describe(FixRoots::class, function () {
    beforeEach(function () {
        $this->fixRoots = new FixRoots();
    });

    it('is registerable', function () {
        expect($this->fixRoots)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
    });

    describe('->register()', function () {
        it('adds the action', function () {
            allow('add_action')->toBeCalled();

            expect('add_action')->toBeCalled()->with('init', [$this->fixRoots, 'fixRoots'])->once();

            $this->fixRoots->register();
        });
    });

    describe('->fixRoots()', function () {
        it('removes the filter', function () {
            allow('remove_filter')->toBeCalled();
            expect('remove_filter')->toBeCalled()->with('style_loader_tag', 'roots_clean_style_tag')->once();

            $this->fixRoots->fixRoots();
        });
    });
});
