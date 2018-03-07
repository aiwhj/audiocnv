PHP_ARG_ENABLE(audiocnv, whether to enable audiocnv support,
[  --enable-audiocnv          Enable audiocnv support], no)

if test "$PHP_AUDIOCNV" != "no"; then
  AC_DEFINE(HAVE_AUDIOCNV, 1, [ Have audiocnv support ])
  PHP_NEW_EXTENSION(audiocnv, audiocnv.c, $ext_shared)
fi
