<?php

namespace GovUKBlogs\WidgetCategoriesDropdownWithSubmit;

describe(Register::class, function () {
    beforeEach(function () {
        $this->register = new Register();
    });

    it('is registerable', function () {
        expect($this->register)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
    });

    describe('->register()', function () {
        it('adds the action', function () {
            allow('add_action')->toBeCalled();

            expect('add_action')->toBeCalled()->with('widgets_init', [$this->register, 'widgetsInit'])->once();

            $this->register->register();
        });
    });

    describe('->widgetsInit()', function () {
        it('registers the widget', function () {
            allow('register_widget')->toBeCalled();
            
            expect('register_widget')->toBeCalled()->with(Widget::class)->once();

            $this->register->widgetsInit();
        });
    });
});
