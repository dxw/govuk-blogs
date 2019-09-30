<?php

namespace GovUKBlogs\WidgetCategoriesDropdownWithSubmit;

use \phpmock\mockery\PHPMockery;

describe(Register::class, function () {
    beforeEach(function () {
        $this->register = new Register();
    });

    afterEach(function () {
        \Mockery::close();
    });

    it('is registerable', function () {
        expect($this->register)->to->be->instanceof(\Dxw\Iguana\Registerable::class);
    });

    describe('->register()', function () {
        it('does something', function () {
            PHPMockery::mock(__NAMESPACE__, 'add_action')->with('widgets_init', [$this->register, 'widgetsInit'])->once();

            $this->register->register();
        });
    });

    describe('->widgetsInit()', function () {
        it('registers the widget', function () {
            PHPMockery::mock(__NAMESPACE__, 'register_widget')->with(Widget::class)->once();

            $this->register->widgetsInit();
        });
    });
});
