#!/bin/sh
set -xe

test -d govuk_template || git clone https://github.com/alphagov/govuk_template.git

cd govuk_template

bundle install
bundle exec rake build:mustache

cd ..

rm -rf build/govuk_template
cp -r govuk_template/pkg/mustache_govuk_template-0.6.1/ build/govuk_template
