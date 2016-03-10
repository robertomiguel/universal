mysqldump --complete-insert --no-create-info -u universal --password=universal --opt universal>$1
gzip $1

