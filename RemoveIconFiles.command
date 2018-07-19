#! /bin/bash
current_path="$(dirname "$BASH_SOURCE")"
find $current_path -type f -name 'Icon?' -print -delete;

