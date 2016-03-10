cd /home/roberto/universal/resguardo/
mysqldump --complete-insert --no-create-info -u universal --password=universal --opt universal provincia>provincia.sql
mysqldump --complete-insert --no-create-info -u universal --password=universal --opt universal localidad>localidad.sql
mysqldump --complete-insert --no-create-info -u universal --password=universal --opt universal suscriptor>suscriptor.sql
mysqldump --complete-insert --no-create-info -u universal --password=universal --opt universal productor>productor.sql
mysqldump --complete-insert --no-create-info -u universal --password=universal --opt universal suscripcion>suscripcion.sql
mysqldump --complete-insert --no-create-info -u universal --password=universal --opt universal cuota>cuota.sql
mysqldump --complete-insert --no-create-info -u universal --password=universal --opt universal sf_guard_user>sfguarduser.sql
zip hoy.zip *.sql
echo listo
