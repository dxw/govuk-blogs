<?php

namespace GovUKBlogs\WidgetCategoriesDropdownWithSubmit;

require_once(__DIR__.'/helpers.php');

use \phpmock\mockery\PHPMockery;

describe(Widget::class, function () {
    beforeEach(function () {
        $this->widget = new Widget();
    });

    afterEach(function () {
        \Mockery::close();
    });

    it('extends WP_Widget', function () {
        expect($this->widget)->to->be->an->instanceof(\WP_Widget::class);
    });

    describe('->__construct()', function () {
        it("calls its parent's constructor", function () {
            expect($this->widget->__constructorArguments)->to->equal([
                'categories-dropdown-with-submit',
                'Categories Dropdown With Submit',
                [
                    'classname' => 'widget_categories',
                    'description' => 'TODO',
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
            PHPMockery::mock(__NAMESPACE__, 'esc_url')->with('x')->andReturn('X');
            PHPMockery::mock(__NAMESPACE__, 'home_url')->with()->andReturn('x');
            PHPMockery::mock(__NAMESPACE__, 'esc_attr')->with('aaa-dropdown-with-submit-3')->andReturn('y');
            PHPMockery::mock(__NAMESPACE__, 'wp_dropdown_categories')->with([
                'orderby'      => 'name',
                'show_count'   => '0',
                'hierarchical' => '0',
                'show_option_none' => 'Select Category',
                'id'               => 'aaa-dropdown-with-submit-3',
            ])->andReturnUsing(function () {
                echo 'HELLO FROM wp_dropdown_categories';
            });

            ob_start();
            $this->widget->widget([
                'before_widget' => 'AAA',
                'before_title' => 'BBB',
                'after_title' => 'CCC',
                'after_widget' => 'DDD',
            ], []);
            $output = ob_get_clean();

            expect($output)->to->equal('AAABBBCategoriesCCC<form action="X" method="get"><label class="screen-reader-text" for="y">Categories</label>HELLO FROM wp_dropdown_categories<input type="submit" value="Go"></form>DDD');
        });
    });
});
