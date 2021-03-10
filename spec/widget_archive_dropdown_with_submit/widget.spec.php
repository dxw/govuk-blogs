<?php

namespace GovUKBlogs\WidgetArchiveDropdownWithSubmit;

require_once(dirname(__DIR__).'/helpers/wp_widget.php');

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
                'archive-dropdown-with-submit',
                'Archives Dropdown With Submit',
                [
                    'classname' => 'widget_archive',
                    'description' => 'The same as monthly "Archives" widget dropdown but with a submit button',
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
            PHPMockery::mock(__NAMESPACE__, 'esc_attr')->with('aaa-archive-dropdown-with-submit-3')->andReturn('y');
            $wpGetArchivesMock = PHPMockery::mock(__NAMESPACE__, 'wp_get_archives');
            $wpGetArchivesMock->with([
                'type' => 'monthly',
                'format' => 'option',
                'show_post_count' => true
            ])->andReturnUsing(function () {
                echo 'HELLO FROM wp_get_archives';
            });
            $wpGetArchivesMock->with([
                'type' => 'monthly',
                'format' => 'html',
                'show_post_count' => true
            ])->andReturnUsing(function () {
                echo 'HELLO FROM list-format wp_get_archives';
            });

            ob_start();
            $this->widget->widget([
                'before_widget' => 'AAA',
                'before_title' => 'BBB',
                'after_title' => 'CCC',
                'after_widget' => 'DDD',
            ], []);
            $output = ob_get_clean();

            expect($output)->to->equal('AAABBBArchivesCCC<div class="archive-dropdown-with-submit-js-enabled"><label class="govuk-visually-hidden" for="y">Archives</label><select class="govuk-select" id="y" name="archive-dropdown"><option value="">Select month</option>HELLO FROM wp_get_archives</select><button class="govuk-button" data-module="govuk-button" onclick="newLocation = document.getElementById(\'y\').value; if ( newLocation != \'\' ) { window.location = newLocation; }">Go</button></div><div class="archive-dropdown-with-submit-js-disabled"><ul>HELLO FROM list-format wp_get_archives</ul></div>DDD');
        });
    });
});
