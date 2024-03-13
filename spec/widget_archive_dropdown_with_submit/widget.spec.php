<?php

namespace GovUKBlogs\WidgetArchiveDropdownWithSubmit;

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
			allow('esc_url')->toBeCalled()->with('x')->andReturn('X');
			allow('home_url')->toBeCalled()->with()->andReturn('x');
			allow('esc_attr')->toBeCalled()->with('aaa-archive-dropdown-with-submit-3')->andReturn('y');
			allow('wp_get_archives')->toBeCalled()->andRun(
				function () {
					echo 'HELLO FROM wp_get_archives';
				},
				function () {
					echo 'HELLO FROM list-format wp_get_archives';
				}
			);

			$closure = function () {
				$this->widget->widget([
					'before_widget' => 'AAA',
					'before_title' => 'BBB',
					'after_title' => 'CCC',
					'after_widget' => 'DDD',
				], []);
			};

			expect($closure)->toEcho('AAABBBArchivesCCC<div class="archive-dropdown-with-submit-js-enabled"><label class="govuk-visually-hidden" for="y">Archives</label><select class="govuk-select" id="y" name="archive-dropdown"><option value="">Select month</option>HELLO FROM wp_get_archives</select><button class="govuk-button" data-module="govuk-button" onclick="newLocation = document.getElementById(\'y\').value; if ( newLocation != \'\' ) { window.location = newLocation; }">Go</button></div><div class="archive-dropdown-with-submit-js-disabled"><ul>HELLO FROM list-format wp_get_archives</ul></div>DDD');
		});
	});
});
