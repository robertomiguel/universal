mv ./config/error.no ./config/error
sed -i 's/cadillacs!!/universal!!/g' ./config/databases.yml
sed -i 's/, true)/, false)/g' ./web/frontend_dev.php
sed -i 's/, false)/, true)/g' ./web/index.php
php symfony cc
