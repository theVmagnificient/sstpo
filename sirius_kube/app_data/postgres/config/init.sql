ALTER USER postgres WITH PASSWORD 'bv2019sstpo';

\c bv2019

Create Table views (counter integer);

Create Table sstpo ( name varchar(1000), names 
	varchar(1000),description varchar(100000),description_clear
	varchar(100000),websites varchar(1000),category integer[],
	okved2s text[],ogrn bigint, inn bigint[],simila integer[], id serial);


Create Table users (id serial , email varchar(70) unique, pass
	varchar(30),token varchar(64),firstname varchar(30),surname
	varchar(30),my_sites integer[],fav_com integer[], fav_sup integer[],
	fav_cli integer[]);

COPY public.sstpo (name, names, description, description_clear, websites, category, okved2s, ogrn, inn, simila, id) FROM '/docker-entrypoint-initdb.d/dataset.csv' DELIMITER ';' CSV HEADER ENCODING 'UTF8' QUOTE '"' ESCAPE '"';

CREATE EXTENSION btree_gin;
CREATE INDEX "name5 " ON "sstpo" USING gin(id);
CREATE INDEX "name6 " ON "sstpo" USING gin(ogrn);
CREATE INDEX "name7 " ON "sstpo" USING gin(inn);
CREATE EXTENSION pg_trgm;
Create index name10 on sstpo using gin (name gin_trgm_ops);
Create index name11 on sstpo using gin (names gin_trgm_ops);
Create index name12 on sstpo using gin (description gin_trgm_ops);
Create index name13 on sstpo using gin (description_clear gin_trgm_ops);
Create index name14 on sstpo using gin (websites gin_trgm_ops);

