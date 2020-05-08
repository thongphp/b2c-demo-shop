<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1588825550.
 * Generated on 2020-05-07 04:25:50 by spryker
 */
class PropelMigration_1588825550
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

ALTER TABLE "pyz_training_price_item"

  ALTER COLUMN "customer_number" TYPE VARCHAR(4),

  ALTER COLUMN "item_number" TYPE VARCHAR(4);

ALTER TABLE "pyz_training_price_item_storage"

  DROP CONSTRAINT "pyz_training_price_item_storage_pkey",

  ALTER COLUMN "fk_customer_item_number" TYPE VARCHAR(9),

  DROP COLUMN "id_training_price_item_storage",

  ADD PRIMARY KEY ("fk_customer_item_number");

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

ALTER TABLE "pyz_training_price_item"

  ALTER COLUMN "customer_number" TYPE VARCHAR(2),

  ALTER COLUMN "item_number" TYPE VARCHAR(2);

ALTER TABLE "pyz_training_price_item_storage"

  DROP CONSTRAINT "pyz_training_price_item_storage_pkey",

  ALTER COLUMN "fk_customer_item_number" TYPE VARCHAR(25),

  ADD "id_training_price_item_storage" INT8 NOT NULL,

  ADD PRIMARY KEY ("id_training_price_item_storage");

COMMIT;
',
);
    }

}