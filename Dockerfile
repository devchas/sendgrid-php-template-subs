FROM php:7.0-cli
COPY . /usr/src/app
WORKDIR /usr/src/app

CMD ["php", "-r", "copy('https://getcomposer.org/installer', 'composer-setup.php');"]
CMD ["php", "-r", "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"]
CMD ["php", "composer-setup.php"]
CMD ["php", "-r", "unlink('composer-setup.php');"]
CMD ["php", "composer.phar", "install"]

CMD [ "php", "./scripts/email.php" ]