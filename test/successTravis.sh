#!/bin/bash

#export YO_API_TOKEN=""
export TRAVIS_REPO_SLUG="gong023/Ayaml"
export TRAVIS_BUILD_ID="46425394"

TOP_DIR=`dirname "${0}"`/../

${TOP_DIR}vendor/bin/phpunit -c ${TOP_DIR}phpunit.xml.dist --filter testSuccess