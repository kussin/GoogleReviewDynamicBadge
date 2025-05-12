#!/bin/bash

# Verzeichnisse
BASEDIR="/home/www/p654460/html/dynamic-badge.google-reviews.fuxstar.de"
CACHEDIR="$BASEDIR/cache"

# Neueste de-badge-*.cache Datei finden
LATEST_BADGE=$(ls -1t "$CACHEDIR"/de-badge-*.cache 2>/dev/null | head -n 1)
if [ -n "$LATEST_BADGE" ]; then
  ln -nsf "${LATEST_BADGE#$BASEDIR/}" "$BASEDIR/badge.svg"
fi

# Neueste de-mini-*.cache Datei finden
LATEST_MINI=$(ls -1t "$CACHEDIR"/de-mini-*.cache 2>/dev/null | head -n 1)
if [ -n "$LATEST_MINI" ]; then
  ln -nsf "${LATEST_MINI#$BASEDIR/}" "$BASEDIR/badge-mini.html"
fi
