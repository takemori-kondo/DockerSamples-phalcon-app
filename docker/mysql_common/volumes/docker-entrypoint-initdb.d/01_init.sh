mysql -u root -proot < /scripts/10user_and_db/user.sql
mysql -u root -proot < /scripts/10user_and_db/database.sql

DB_NAME=common
mysql -u common -ppassword_common $DB_NAME < /scripts/20tables/zzz_sample.sql

mysql -u common -ppassword_common $DB_NAME < /scripts/90insert/insert_zzz_sample.sql