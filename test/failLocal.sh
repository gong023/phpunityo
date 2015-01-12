#!/bin/bash

export YO_API_TOKEN="f4666be1-737c-443e-a9ae-53f244f7631c"

TOP_DIR=`dirname "${0}"`/../

${TOP_DIR}vendor/bin/phpunit -c ${TOP_DIR}phpunit.xml.dist --filter testFail