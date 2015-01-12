#!/bin/bash

#export YO_API_TOKEN=""
export TRAVIS_REPO_SLUG="gong023/underscore-rust"
export TRAVIS_BUILD_ID="45972301"

TOP_DIR=`dirname "${0}"`/../

${TOP_DIR}vendor/bin/phpunit -c ${TOP_DIR}phpunit.xml.dist --filter testFail