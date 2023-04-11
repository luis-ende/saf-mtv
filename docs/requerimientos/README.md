# Módulos de PHP 8.1 requeridos:
- `bcmath
Core
ctype
curl
date
dom
exif
fileinfo
filter
ftp
gd
hash
iconv
imagick
intl
json
libxml
mbstring
mysqlnd
openssl
pcntl
pcre
PDO
pdo_pgsql
pdo_sqlite
pgsql
Phar
posix
readline
Reflection
session
SimpleXML
sodium
SPL
sqlite3
standard
tokenizer
xml
xmlreader
xmlwriter
zip
zlib`

# Node.js:

- Mínimo versión 16 de Node.js para la compilación de assets (a menos que se suban a producción las versiones compiladas)

# Extensión habilitada en PostgreSQL
- Extensión  de PostgreSQL `pg_trgm` debe estar activada. 
  - En línea de comando con psql, revisar si la extensión ya se encuentra activada usar: `\dx`
  - Para activar la extensión: `CREATE EXTENSION pg_trgm;`
  - Más información sobre la extensión y su uso: https://www.postgresql.org/docs/current/pgtrgm.html

