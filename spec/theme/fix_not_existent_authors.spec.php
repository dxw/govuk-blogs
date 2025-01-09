<?php

describe(\GovUKBlogs\Theme\FixNonExistentAuthors::class, function () {
	beforeEach(function () {
		$this->fixNonExistentAuthors = new \GovUKBlogs\Theme\FixNonExistentAuthors();
	});

	it('implements the Registerable interface', function () {
		expect($this->fixNonExistentAuthors)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});

	describe('->register()', function () {
		it('adds the action', function () {
			allow('add_action')->toBeCalled();
			expect('add_action')->toBeCalled()->once()->with('gds_byline', [$this->fixNonExistentAuthors, 'replaceAbsentAuthor']);
			$this->fixNonExistentAuthors->register();
		});
	});

	describe('->replaceAbsentAuthor()', function () {
		context('the post author ID is 1', function () {
			it('does nothing', function () {
				global $post;
				$post = (object) [
					"ID" => 123
				];
				allow('get_post_field')->toBeCalled()->andReturn(1);
				expect('wp_update_post')->not->toBeCalled();

				$this->fixNonExistentAuthors->replaceAbsentAuthor();
			});
		});
		context('the post author ID is greater than 1', function () {
			context('but the user exists', function () {
				it('does nothing', function () {
					global $post;
					$post = (object) [
						"ID" => 123
					];
					allow('get_post_field')->toBeCalled()->andReturn(2);
					allow('get_user_by')->toBeCalled()->andReturn((object) [
						"ID" => 2,
						"user_login" => "valid_user"
					]);
					expect('wp_update_post')->not->toBeCalled();

					$this->fixNonExistentAuthors->replaceAbsentAuthor();
				});
			});
			context('and the user does not exist', function () {
				it('adds the filter and calls update_post', function () {
					global $post;
					$post = (object) [
						"ID" => 123
					];
					allow('get_post_field')->toBeCalled()->andReturn(2);
					allow('get_user_by')->toBeCalled()->andReturn(false);
					allow('add_filter')->toBeCalled();
					allow('error_log')->toBeCalled();
					expect('error_log')->toBeCalled()->once()->with('author of post 123 is deleted user 2', 0);
					expect('add_filter')->toBeCalled()->once()->with('wp_insert_post_data', [$this->fixNonExistentAuthors, 'setArchiveAuthor'], 99, 2);
					allow('wp_update_post')->toBeCalled();
					expect('wp_update_post')->toBeCalled()->once();

					$this->fixNonExistentAuthors->replaceAbsentAuthor();
				});
			});
		});
	});

	describe('->setArchiveAuthor()', function () {
		context('the post is not one of the types we want to fix', function () {
			it('returns the post data unamended', function () {
				$postData = [
					'post_type' => 'custom_post_type',
					'post_author' => 123
				];
				expect('get_option')->not->toBeCalled();

				$result = $this->fixNonExistentAuthors->setArchiveAuthor($postData, []);

				expect($result)->toEqual($postData);
			});
		});
		context('the post is one of the type we want to fix', function () {
			beforeEach(function () {
				$this->postData = [
					'post_type' => 'post',
					'post_author' => 123
				];
			});
			context('but the archive_author option is not set', function () {
				it('returns the post data unamended', function () {
					allow('get_option')->toBeCalled()->andReturn(false);

					$result = $this->fixNonExistentAuthors->setArchiveAuthor($this->postData, []);

					expect($result)->toEqual($this->postData);
				});
			});
			context('and the archive_author option is an integer', function () {
				it('amends the post data to set the post_author to the archive_author value', function () {
					allow('get_option')->toBeCalled()->andReturn(456);
					allow('taxonomy_exists')->toBeCalled()->andReturn(false);

					$result = $this->fixNonExistentAuthors->setArchiveAuthor($this->postData, []);

					expect($result)->toEqual([
						'post_type' => 'post',
						'post_author' => 456
					]);
				});
			});
			context('and the archive_author option is a string containing only an integer', function () {
				it('amends the post data to set the post_author to the archive_author value', function () {
					allow('get_option')->toBeCalled()->andReturn('456');
					allow('taxonomy_exists')->toBeCalled()->andReturn(false);

					$result = $this->fixNonExistentAuthors->setArchiveAuthor($this->postData, []);

					expect($result)->toEqual([
						'post_type' => 'post',
						'post_author' => 456
					]);
				});
			});
			context('and the archive_author option is a string containing non-numeric characters', function () {
				it('returns the post data unamended', function () {
					allow('get_option')->toBeCalled()->andReturn('456foo');

					$result = $this->fixNonExistentAuthors->setArchiveAuthor($this->postData, []);

					expect($result)->toEqual($this->postData);
				});
			});
			context('and the "author" taxonomy exists, indicating that co-authors is in use', function () {
				it('removes any existing co-author relationships with this post, as well as amending the author ID', function () {
					allow('get_option')->toBeCalled()->andReturn(456);
					allow('taxonomy_exists')->toBeCalled()->andReturn(true);
					allow('wp_delete_object_term_relationships')->toBeCalled();
					expect('wp_delete_object_term_relationships')->toBeCalled()->once()->with(123, 'author');

					$result = $this->fixNonExistentAuthors->setArchiveAuthor($this->postData, ['ID' => 123]);

					expect($result)->toEqual([
						'post_type' => 'post',
						'post_author' => 456
					]);
				});
			});
		});
	});
});
