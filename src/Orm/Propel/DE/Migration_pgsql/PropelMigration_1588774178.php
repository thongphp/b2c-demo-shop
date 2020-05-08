<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1588774178.
 * Generated on 2020-05-06 14:09:38 by spryker
 */
class PropelMigration_1588774178
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'zed' => '
BEGIN;

CREATE SEQUENCE "pyz_training_price_item_storage_pk_seq";

CREATE TABLE "pyz_training_price_item_storage"
(
    "id_training_price_item_storage" INT8 NOT NULL,
    "fk_customer_item_number" VARCHAR(25) NOT NULL,
    "data" TEXT,
    "store" VARCHAR(128),
    "key" VARCHAR,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_training_price_item_storage"),
    CONSTRAINT "pyz_training_price_item_storage-unique-key" UNIQUE ("key")
);

COMMIT;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'zed' => '
BEGIN;

DROP TABLE IF EXISTS "pyz_training_price_item_storage" CASCADE;

DROP SEQUENCE "pyz_training_price_item_storage_pk_seq";

COMMIT;
',
);
    }

}