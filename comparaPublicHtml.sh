#!/bin/bash
updirb public_html/ liziechevarria/ | grep -Ev '\/version01|\/upload\/principal|\/error_log|\.htaccess|\.user.ini|\php.ini|\.well-known|\/fileupdate\/files|\.git|\.gitignore|\.vscode|\/sql.$|\/comparaPublicHtml.sh'
