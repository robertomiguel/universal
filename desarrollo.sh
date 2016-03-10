mv ./config/error ./config/error.no
sed -i 's/universal!!/cadillacs!!/g' ./config/databases.yml
sed -i 's/, false)/, true)/g' ./web/frontend_dev.php
sed -i 's/, true)/, false)/g' ./web/index.php
php symfony cc
