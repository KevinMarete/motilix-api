-- Adminer 4.7.1 PostgreSQL dump

DROP TABLE IF EXISTS "migrations";
DROP SEQUENCE IF EXISTS migrations_id_seq;
CREATE SEQUENCE migrations_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."migrations" (
    "id" integer DEFAULT nextval('migrations_id_seq') NOT NULL,
    "migration" character varying(255) NOT NULL,
    "batch" integer NOT NULL,
    CONSTRAINT "migrations_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "migrations" ("id", "migration", "batch") VALUES
(56,	'2019_02_25_144454_create_table_tbl_role',	1),
(57,	'2019_02_25_144600_create_table_tbl_user',	1),
(59,	'2019_02_25_144910_create_table_tbl_vehicle',	1),
(61,	'2019_02_25_161043_create_table_tbl_brand',	1),
(62,	'2019_02_25_162019_create_table_tbl_device',	1),
(63,	'2019_02_25_163219_create_table_tbl_order',	1),
(64,	'2019_02_25_164716_create_table_tbl_order_log',	1),
(65,	'2019_02_25_165257_create_table_tbl_card',	1),
(66,	'2019_02_25_171228_create_table_tbl_payment',	1),
(67,	'2019_02_25_172243_create_table_tbl_payment_installation',	1),
(68,	'2019_02_25_172757_create_table_tbl_payment_subscription',	1),
(69,	'2019_02_25_173200_create_table_tbl_invoice',	1),
(70,	'2019_02_25_173357_create_table_tbl_refund',	1),
(71,	'2019_02_25_173805_create_table_tbl_vehicle_device',	1),
(72,	'2016_06_01_000001_create_oauth_auth_codes_table',	2),
(73,	'2016_06_01_000002_create_oauth_access_tokens_table',	2),
(74,	'2016_06_01_000003_create_oauth_refresh_tokens_table',	2),
(75,	'2016_06_01_000004_create_oauth_clients_table',	2),
(76,	'2016_06_01_000005_create_oauth_personal_access_clients_table',	2),
(60,	'2019_02_25_144920_create_table_tbl_vehicle_model',	1);

DROP TABLE IF EXISTS "oauth_access_tokens";
CREATE TABLE "public"."oauth_access_tokens" (
    "id" character varying(100) NOT NULL,
    "user_id" integer,
    "client_id" integer NOT NULL,
    "name" character varying(255),
    "scopes" text,
    "revoked" boolean NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "expires_at" timestamp(0),
    CONSTRAINT "oauth_access_tokens_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "oauth_access_tokens_user_id_index" ON "public"."oauth_access_tokens" USING btree ("user_id");

INSERT INTO "oauth_access_tokens" ("id", "user_id", "client_id", "name", "scopes", "revoked", "created_at", "updated_at", "expires_at") VALUES
('cfd47d9a8008d67a48510d63fa6e0768b3865869701a2b8fdbf31e9295e4b197bb558dc91ba7689c',	1,	1,	'MotilixSeeder',	'[]',	't',	'2019-02-27 10:52:00',	'2019-02-27 10:52:00',	'2020-02-27 10:52:00'),
('8f946044ec66ed8636ea627209ded7fa1762c11a929713bb9f59a52efdf112d2f1804f05f4ce0ec5',	1,	1,	'MotilixSeeder',	'[]',	'f',	'2019-02-27 14:24:10',	'2019-02-27 14:24:10',	'2020-02-27 14:24:10'),
('cbe18320393417c72b0b60a2c4cbe870d3160f6628022cb078eb6e05710ad6aaa6fea16529d23789',	1,	1,	'MotilixSeeder',	'[]',	't',	'2019-02-27 15:58:46',	'2019-02-27 15:58:46',	'2020-02-27 15:58:46'),
('15e84c1d7a173b3ba1a01fac043f456ae8cd5b915690147fea68e69e5eefb9c4d06198cf3c094b99',	1,	1,	'MotilixSeeder',	'[]',	'f',	'2019-02-27 16:00:31',	'2019-02-27 16:00:31',	'2020-02-27 16:00:31');

DROP TABLE IF EXISTS "oauth_auth_codes";
CREATE TABLE "public"."oauth_auth_codes" (
    "id" character varying(100) NOT NULL,
    "user_id" integer NOT NULL,
    "client_id" integer NOT NULL,
    "scopes" text,
    "revoked" boolean NOT NULL,
    "expires_at" timestamp(0),
    CONSTRAINT "oauth_auth_codes_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "oauth_clients";
DROP SEQUENCE IF EXISTS oauth_clients_id_seq;
CREATE SEQUENCE oauth_clients_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."oauth_clients" (
    "id" integer DEFAULT nextval('oauth_clients_id_seq') NOT NULL,
    "user_id" integer,
    "name" character varying(255) NOT NULL,
    "secret" character varying(100) NOT NULL,
    "redirect" text NOT NULL,
    "personal_access_client" boolean NOT NULL,
    "password_client" boolean NOT NULL,
    "revoked" boolean NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "oauth_clients_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "oauth_clients_user_id_index" ON "public"."oauth_clients" USING btree ("user_id");

INSERT INTO "oauth_clients" ("id", "user_id", "name", "secret", "redirect", "personal_access_client", "password_client", "revoked", "created_at", "updated_at") VALUES
(1,	NULL,	'motilix-api Personal Access Client',	'MxDgNftJ2IIjdVSMqixcVoXaJUobeSXZ6dcRpiqi',	'http://localhost',	't',	'f',	'f',	'2019-02-27 08:25:08',	'2019-02-27 08:25:08'),
(2,	NULL,	'motilix-api Password Grant Client',	'IRjTgXFoYFaAmzbHLT36ck5H2c42Sih6FIyZhrs6',	'http://localhost',	'f',	't',	'f',	'2019-02-27 08:25:08',	'2019-02-27 08:25:08');

DROP TABLE IF EXISTS "oauth_personal_access_clients";
DROP SEQUENCE IF EXISTS oauth_personal_access_clients_id_seq;
CREATE SEQUENCE oauth_personal_access_clients_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."oauth_personal_access_clients" (
    "id" integer DEFAULT nextval('oauth_personal_access_clients_id_seq') NOT NULL,
    "client_id" integer NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "oauth_personal_access_clients_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "oauth_personal_access_clients_client_id_index" ON "public"."oauth_personal_access_clients" USING btree ("client_id");

INSERT INTO "oauth_personal_access_clients" ("id", "client_id", "created_at", "updated_at") VALUES
(1,	1,	'2019-02-27 08:25:08',	'2019-02-27 08:25:08');

DROP TABLE IF EXISTS "oauth_refresh_tokens";
CREATE TABLE "public"."oauth_refresh_tokens" (
    "id" character varying(100) NOT NULL,
    "access_token_id" character varying(100) NOT NULL,
    "revoked" boolean NOT NULL,
    "expires_at" timestamp(0),
    CONSTRAINT "oauth_refresh_tokens_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "oauth_refresh_tokens_access_token_id_index" ON "public"."oauth_refresh_tokens" USING btree ("access_token_id");


DROP TABLE IF EXISTS "tbl_brand";
DROP SEQUENCE IF EXISTS tbl_brand_id_seq;
CREATE SEQUENCE tbl_brand_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."tbl_brand" (
    "id" integer DEFAULT nextval('tbl_brand_id_seq') NOT NULL,
    "name" character varying(255) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" timestamp(0),
    CONSTRAINT "tbl_brand_name_unique" UNIQUE ("name"),
    CONSTRAINT "tbl_brand_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "tbl_card";
DROP SEQUENCE IF EXISTS tbl_card_id_seq;
CREATE SEQUENCE tbl_card_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."tbl_card" (
    "id" integer DEFAULT nextval('tbl_card_id_seq') NOT NULL,
    "name_on_card" character varying(255) NOT NULL,
    "card_number" character varying(255) NOT NULL,
    "expiry_period" character varying(255) NOT NULL,
    "gateway_token" character varying(255) NOT NULL,
    "subscription_date" date NOT NULL,
    "user_id" integer NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" timestamp(0),
    CONSTRAINT "tbl_card_name_on_card_card_number_user_id_unique" UNIQUE ("name_on_card", "card_number", "user_id"),
    CONSTRAINT "tbl_card_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "tbl_card_user_id_foreign" FOREIGN KEY (user_id) REFERENCES tbl_vehicle_model(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE
) WITH (oids = false);


DROP TABLE IF EXISTS "tbl_device";
DROP SEQUENCE IF EXISTS tbl_device_id_seq;
CREATE SEQUENCE tbl_device_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."tbl_device" (
    "id" integer DEFAULT nextval('tbl_device_id_seq') NOT NULL,
    "model" character varying(255) NOT NULL,
    "input" character varying(255) NOT NULL,
    "serial_number" character varying(255) NOT NULL,
    "is_available" boolean DEFAULT true NOT NULL,
    "brand_id" integer NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" timestamp(0),
    CONSTRAINT "tbl_device_brand_id_model_input_serial_number_unique" UNIQUE ("brand_id", "model", "input", "serial_number"),
    CONSTRAINT "tbl_device_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "tbl_device_brand_id_foreign" FOREIGN KEY (brand_id) REFERENCES tbl_brand(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE
) WITH (oids = false);


DROP TABLE IF EXISTS "tbl_invoice";
DROP SEQUENCE IF EXISTS tbl_invoice_id_seq;
CREATE SEQUENCE tbl_invoice_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."tbl_invoice" (
    "id" integer DEFAULT nextval('tbl_invoice_id_seq') NOT NULL,
    "payment_date" date NOT NULL,
    "payment_id" integer NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" timestamp(0),
    CONSTRAINT "tbl_invoice_payment_date_payment_id_unique" UNIQUE ("payment_date", "payment_id"),
    CONSTRAINT "tbl_invoice_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "tbl_invoice_payment_id_foreign" FOREIGN KEY (payment_id) REFERENCES tbl_payment(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE
) WITH (oids = false);


DROP TABLE IF EXISTS "tbl_order";
DROP SEQUENCE IF EXISTS tbl_order_id_seq;
CREATE SEQUENCE tbl_order_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."tbl_order" (
    "id" integer DEFAULT nextval('tbl_order_id_seq') NOT NULL,
    "year_of_manufacture" date NOT NULL,
    "number_plate" character varying(255) NOT NULL,
    "physical_address" character varying(255) NOT NULL,
    "status" character varying(255) NOT NULL,
    "user_id" integer NOT NULL,
    "vehicle_model_id" integer NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" timestamp(0),
    CONSTRAINT "tbl_order_number_plate_user_id_model_id_unique" UNIQUE ("number_plate", "user_id", "vehicle_model_id"),
    CONSTRAINT "tbl_order_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "tbl_order_model_id_foreign" FOREIGN KEY (vehicle_model_id) REFERENCES tbl_vehicle_model(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE,
    CONSTRAINT "tbl_order_user_id_foreign" FOREIGN KEY (user_id) REFERENCES tbl_user(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE
) WITH (oids = false);


DROP TABLE IF EXISTS "tbl_order_log";
DROP SEQUENCE IF EXISTS tbl_order_log_id_seq;
CREATE SEQUENCE tbl_order_log_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."tbl_order_log" (
    "id" integer DEFAULT nextval('tbl_order_log_id_seq') NOT NULL,
    "status" character varying(255) NOT NULL,
    "transaction_time" timestamp(0) DEFAULT now() NOT NULL,
    "order_id" integer NOT NULL,
    "user_id" integer NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" timestamp(0),
    CONSTRAINT "tbl_order_log_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "tbl_order_log_status_transaction_time_order_id_user_id_unique" UNIQUE ("status", "transaction_time", "order_id", "user_id"),
    CONSTRAINT "tbl_order_log_order_id_foreign" FOREIGN KEY (order_id) REFERENCES tbl_order(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE,
    CONSTRAINT "tbl_order_log_user_id_foreign" FOREIGN KEY (user_id) REFERENCES tbl_user(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE
) WITH (oids = false);


DROP TABLE IF EXISTS "tbl_payment";
DROP SEQUENCE IF EXISTS tbl_payment_id_seq;
CREATE SEQUENCE tbl_payment_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."tbl_payment" (
    "id" integer DEFAULT nextval('tbl_payment_id_seq') NOT NULL,
    "transaction_time" timestamp(0) DEFAULT now() NOT NULL,
    "card_id" integer NOT NULL,
    "device_id" integer NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" timestamp(0),
    CONSTRAINT "tbl_payment_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "tbl_payment_transaction_time_card_id_device_id_unique" UNIQUE ("transaction_time", "card_id", "device_id"),
    CONSTRAINT "tbl_payment_card_id_foreign" FOREIGN KEY (card_id) REFERENCES tbl_card(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE,
    CONSTRAINT "tbl_payment_device_id_foreign" FOREIGN KEY (device_id) REFERENCES tbl_device(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE
) WITH (oids = false);


DROP TABLE IF EXISTS "tbl_payment_installation";
DROP SEQUENCE IF EXISTS tbl_payment_installation_id_seq;
CREATE SEQUENCE tbl_payment_installation_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."tbl_payment_installation" (
    "id" integer DEFAULT nextval('tbl_payment_installation_id_seq') NOT NULL,
    "initial_fee" double precision NOT NULL,
    "payment_id" integer NOT NULL,
    "order_id" integer NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" timestamp(0),
    CONSTRAINT "tbl_payment_installation_payment_id_order_id_initial_fee_unique" UNIQUE ("payment_id", "order_id", "initial_fee"),
    CONSTRAINT "tbl_payment_installation_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "tbl_payment_installation_order_id_foreign" FOREIGN KEY (order_id) REFERENCES tbl_order(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE,
    CONSTRAINT "tbl_payment_installation_payment_id_foreign" FOREIGN KEY (payment_id) REFERENCES tbl_payment(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE
) WITH (oids = false);


DROP TABLE IF EXISTS "tbl_payment_subscription";
DROP SEQUENCE IF EXISTS tbl_payment_subscription_id_seq;
CREATE SEQUENCE tbl_payment_subscription_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."tbl_payment_subscription" (
    "id" integer DEFAULT nextval('tbl_payment_subscription_id_seq') NOT NULL,
    "membership_fee" double precision NOT NULL,
    "start_date" date NOT NULL,
    "end_date" date NOT NULL,
    "payment_id" integer NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" timestamp(0),
    CONSTRAINT "tbl_payment_subscription_payment_id_start_date_end_date_members" UNIQUE ("payment_id", "start_date", "end_date", "membership_fee"),
    CONSTRAINT "tbl_payment_subscription_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "tbl_payment_subscription_payment_id_foreign" FOREIGN KEY (payment_id) REFERENCES tbl_payment(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE
) WITH (oids = false);


DROP TABLE IF EXISTS "tbl_refund";
DROP SEQUENCE IF EXISTS tbl_refund_id_seq;
CREATE SEQUENCE tbl_refund_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."tbl_refund" (
    "id" integer DEFAULT nextval('tbl_refund_id_seq') NOT NULL,
    "refund_date" date NOT NULL,
    "reason_for_refund" text NOT NULL,
    "payment_id" integer NOT NULL,
    "user_id" integer NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" timestamp(0),
    CONSTRAINT "tbl_refund_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "tbl_refund_refund_date_payment_id_user_id_unique" UNIQUE ("refund_date", "payment_id", "user_id"),
    CONSTRAINT "tbl_refund_payment_id_foreign" FOREIGN KEY (payment_id) REFERENCES tbl_payment(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE,
    CONSTRAINT "tbl_refund_user_id_foreign" FOREIGN KEY (user_id) REFERENCES tbl_user(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE
) WITH (oids = false);


DROP TABLE IF EXISTS "tbl_role";
DROP SEQUENCE IF EXISTS tbl_role_id_seq;
CREATE SEQUENCE tbl_role_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."tbl_role" (
    "id" integer DEFAULT nextval('tbl_role_id_seq') NOT NULL,
    "name" character varying(255) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" timestamp(0),
    CONSTRAINT "tbl_role_name_unique" UNIQUE ("name"),
    CONSTRAINT "tbl_role_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "tbl_role" ("id", "name", "created_at", "updated_at", "deleted_at") VALUES
(2,	'Technician',	'2019-02-26 06:55:37',	'2019-02-26 06:55:37',	NULL),
(3,	'Sales',	'2019-02-26 06:58:07',	'2019-02-26 06:58:07',	NULL),
(4,	'Finance',	'2019-02-26 06:58:20',	'2019-02-26 06:58:20',	NULL),
(1,	'Customer',	'2019-02-26 06:52:00',	'2019-02-26 07:01:14',	NULL),
(5,	'Testing',	'2019-02-26 07:02:14',	'2019-02-26 07:02:42',	'2019-02-26 07:02:42');

DROP TABLE IF EXISTS "tbl_user";
DROP SEQUENCE IF EXISTS tbl_user_id_seq;
CREATE SEQUENCE tbl_user_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."tbl_user" (
    "id" integer DEFAULT nextval('tbl_user_id_seq') NOT NULL,
    "firstname" character varying(255) NOT NULL,
    "surname" character varying(255) NOT NULL,
    "country_code" character varying(5) NOT NULL,
    "phone_number" character varying(20) NOT NULL,
    "email" character varying(255) NOT NULL,
    "email_verified_at" timestamp(0),
    "password" character varying(255) NOT NULL,
    "remember_token" character varying(100),
    "role_id" integer NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" timestamp(0),
    CONSTRAINT "tbl_user_country_code_phone_number_email_role_id_unique" UNIQUE ("country_code", "phone_number", "email", "role_id"),
    CONSTRAINT "tbl_user_email_unique" UNIQUE ("email"),
    CONSTRAINT "tbl_user_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "tbl_user_role_id_foreign" FOREIGN KEY (role_id) REFERENCES tbl_role(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE
) WITH (oids = false);

INSERT INTO "tbl_user" ("id", "firstname", "surname", "country_code", "phone_number", "email", "email_verified_at", "password", "remember_token", "role_id", "created_at", "updated_at", "deleted_at") VALUES
(1,	'Kevin',	'Marete',	'+254',	'7255102659',	'kevomarete@gmail.com',	'2019-02-27 14:23:49',	'$2y$10$1gszloVY/RBgBDLsRfIuD.J2/DwuSa5/1XcdzMIKBF.MC98GEFEGG',	NULL,	1,	'2019-02-27 10:36:07',	'2019-02-27 16:01:24',	NULL);

DROP TABLE IF EXISTS "tbl_vehicle";
DROP SEQUENCE IF EXISTS tbl_vehicle_id_seq;
CREATE SEQUENCE tbl_vehicle_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."tbl_vehicle" (
    "id" integer DEFAULT nextval('tbl_vehicle_id_seq') NOT NULL,
    "name" character varying(255) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" timestamp(0),
    CONSTRAINT "tbl_vehicle_name_unique" UNIQUE ("name"),
    CONSTRAINT "tbl_vehicle_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "tbl_vehicle" ("id", "name", "created_at", "updated_at", "deleted_at") VALUES
(2,	'BMW',	'2019-02-26 07:19:38',	'2019-02-26 07:19:38',	NULL),
(3,	'Subaru',	'2019-02-26 07:20:48',	'2019-02-26 07:20:48',	NULL),
(4,	'Toyota',	'2019-02-26 07:21:10',	'2019-02-26 07:21:10',	NULL),
(1,	'Mercedes Benz',	'2019-02-26 07:19:21',	'2019-02-26 07:22:25',	NULL),
(5,	'Testing',	'2019-02-26 07:23:03',	'2019-02-26 07:23:43',	'2019-02-26 07:23:43');

DROP TABLE IF EXISTS "tbl_vehicle_device";
DROP SEQUENCE IF EXISTS tbl_vehicle_device_id_seq;
CREATE SEQUENCE tbl_vehicle_device_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."tbl_vehicle_device" (
    "id" integer DEFAULT nextval('tbl_vehicle_device_id_seq') NOT NULL,
    "device_id" integer NOT NULL,
    "user_id" integer NOT NULL,
    "order_id" integer NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" timestamp(0),
    CONSTRAINT "tbl_vehicle_device_device_id_user_id_order_id_unique" UNIQUE ("device_id", "user_id", "order_id"),
    CONSTRAINT "tbl_vehicle_device_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "tbl_vehicle_device_device_id_foreign" FOREIGN KEY (device_id) REFERENCES tbl_device(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE,
    CONSTRAINT "tbl_vehicle_device_order_id_foreign" FOREIGN KEY (order_id) REFERENCES tbl_order(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE,
    CONSTRAINT "tbl_vehicle_device_user_id_foreign" FOREIGN KEY (user_id) REFERENCES tbl_user(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE
) WITH (oids = false);


DROP TABLE IF EXISTS "tbl_vehicle_model";
DROP SEQUENCE IF EXISTS tbl_model_id_seq;
CREATE SEQUENCE tbl_model_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."tbl_vehicle_model" (
    "id" integer DEFAULT nextval('tbl_model_id_seq') NOT NULL,
    "name" character varying(255) NOT NULL,
    "is_supported" boolean NOT NULL,
    "vehicle_id" integer NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" timestamp(0),
    CONSTRAINT "tbl_model_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "tbl_model_vehicle_id_name_unique" UNIQUE ("vehicle_id", "name"),
    CONSTRAINT "tbl_model_vehicle_id_foreign" FOREIGN KEY (vehicle_id) REFERENCES tbl_vehicle(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE
) WITH (oids = false);

INSERT INTO "tbl_vehicle_model" ("id", "name", "is_supported", "vehicle_id", "created_at", "updated_at", "deleted_at") VALUES
(4,	'C200',	't',	1,	'2019-02-26 07:48:42',	'2019-02-26 07:48:42',	NULL),
(6,	'720',	'f',	2,	'2019-02-26 07:49:28',	'2019-02-26 07:49:28',	NULL),
(7,	'320',	't',	2,	'2019-02-26 07:49:47',	'2019-02-26 07:49:47',	NULL),
(8,	'Forester',	't',	3,	'2019-02-26 07:49:58',	'2019-02-26 07:49:58',	NULL),
(9,	'Outback',	'f',	3,	'2019-02-26 07:50:12',	'2019-02-26 07:50:12',	NULL),
(5,	'E200',	't',	1,	'2019-02-26 07:49:05',	'2019-02-26 07:53:14',	NULL),
(10,	'Testing',	'f',	5,	'2019-02-26 07:50:28',	'2019-02-26 07:54:03',	'2019-02-26 07:54:03');

-- 2019-02-27 18:35:13.147212+03
