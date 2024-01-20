#!/usr/bin/env bash
# php -l every php file and report syntax errors. Run from the project root: bash bin/lint.sh
status=0
while IFS= read -r -d '' f; do
    out=$(php -l "$f" 2>&1) || { echo "$out"; status=1; }
done < <(find . -path ./vendor -prune -o -path ./api/vendor -prune -o -name '*.php' -print0)
if [ "$status" -eq 0 ]; then
    echo "no syntax errors"
fi
exit $status
