<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1588830543.
 * Generated on 2020-05-07 05:49:03 by spryker
 */
class PropelMigration_1588830543
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

ALTER TABLE "pyz_training_price_item_storage"

  ALTER COLUMN "key" DROP NOT NULL;

CREATE UNIQUE INDEX "pyz_training_price_item_storage-unique-key" ON "pyz_training_price_item_storage" ("key");

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

    ALTER TABLE "pyz_training_price_item_storage" DROP CONSTRAINT "pyz_training_price_item_storage-unique-key";
    
ALTER TABLE "pyz_training_price_item_storage"

  ALTER COLUMN "key" SET NOT NULL;

COMMIT;
',
);
    }

}