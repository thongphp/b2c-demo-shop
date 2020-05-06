<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1588601222.
 * Generated on 2020-05-04 14:07:02 by spryker
 */
class PropelMigration_1588601222
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

DROP TABLE IF EXISTS "pyz_thong_training" CASCADE;

CREATE TABLE "pyz_training_price_item"
(
    "customer_number" VARCHAR(2) NOT NULL,
    "item_number" VARCHAR(2) NOT NULL,
    "quantity" INTEGER NOT NULL,
    "price" DOUBLE PRECISION NOT NULL
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

DROP TABLE IF EXISTS "pyz_training_price_item" CASCADE;

CREATE TABLE "pyz_thong_training"
(
    "customer_number" VARCHAR(2) NOT NULL,
    "item_number" VARCHAR(2) NOT NULL,
    "quantity" INTEGER NOT NULL,
    "value" DOUBLE PRECISION NOT NULL
);

COMMIT;
',
);
    }

}