#!/bin/bash
# Script to build the project with maven to be used with an ansible deployemnt.
# Assumes that we are in the root of the git checkout.
export DOCUMENT_ROOT=/var/lib/tomcat8/webapps/

mvn install

if [ -f target/backend-0.0.2-SNAPSHOT.jar ]; then
	mv target/backend-0.0.2-SNAPSHOT.jar $DOCUMENT_ROOT/backend.jar
fi