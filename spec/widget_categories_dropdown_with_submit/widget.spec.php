<?php

namespace GovUKBlogs\WidgetCategoriesDropdownWithSubmit;

describe(Widget::class, function () {
    beforeEach(function () {
        $this->widget = new Widget();
    });

    it('extends WP_Widget', function () {
        expect($this->widget)->toBeAnInstanceOf(\WP_Widget::class);
    });

    describe('->__construct()', function () {
        it("calls its parent's constructor", function () {
            expect($this->widget->__constructorArguments)->toEqual([
                'categories-dropdown-with-submit',
                'Categories Dropdown With Submit',
                [
                    'classname' => 'widget_categories',
                    'description' => 'The same as "Categories" but with a submit button',
                ],
            ]);
        });
    });

    describe('->widget()', function () {
        beforeEach(function () {
            $this->widget->id_base = 'aaa';
            $this->widget->number = 3;
        });

        it('outputs HTML', function () {
            allow('esc_url')->toBeCalled()->with('x')->andReturn('X');
            allow('home_url')->toBeCalled()->with()->andReturn('x');
            allow('esc_attr')->toBeCalled()->with('aaa-dropdown-with-submit-3')->andReturn('y');
            allow('wp_dropdown_categories')->toBeCalled()->andRun(function () {
                echo 'HELLO FROM wp_dropdown_categories';
            });

            $closure = function () {
                $this->widget->widget([
                    'before_widget' => 'AAA',
                    'before_title' => 'BBB',
                    'after_title' => 'CCC',
                    'after_widget' => 'DDD',
                ], []);
            };

            expect($closure)->toEcho('AAABBBCategoriesCCC<form action="X" method="get"><label class="govuk-visually-hidden" for="y">Categories</label>HELLO FROM wp_dropdown_categories<button class="govuk-button" data-module="govuk-button">Go</button></form>DDD');
        });
    });
});
