/* audiocnv extension for PHP */

#ifndef PHP_AUDIOCNV_H
# define PHP_AUDIOCNV_H

extern zend_module_entry audiocnv_module_entry;
# define phpext_audiocnv_ptr &audiocnv_module_entry

# define PHP_AUDIOCNV_VERSION "0.1.0"

# if defined(ZTS) && defined(COMPILE_DL_AUDIOCNV)
ZEND_TSRMLS_CACHE_EXTERN()
# endif

#endif	/* PHP_AUDIOCNV_H */
