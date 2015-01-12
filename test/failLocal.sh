#!/bin/bash

#export YO_API_TOKEN=""

TOP_DIR=`dirname "${0}"`/../

${TOP_DIR}vendor/bin/phpunit -c ${TOP_DIR}phpunit.xml.dist --filter testFail