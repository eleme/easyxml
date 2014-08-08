ctags:
	ctags -R --fields=+aimS --languages=php --php-kinds=cidf --exclude=tests

cscope:
	find . -name '*.php' > ./cscope.files
	cscope -b
	rm cscope.files

test:
	vendor/bin/phpunit --coverage-text

build:
	composer install
