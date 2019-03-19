<?php
namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs! This block will be used as the migration description if getDescription() is not used.
 */
class Version20190319122952 extends AbstractMigration
{

    /**
     * @return string
     */
    public function getDescription()
    {
        return '';
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function up(Schema $schema)
    {
        // this up() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on "mysql".');
        
        $this->addSql('CREATE TABLE diu_assetsource_vimeo_domain_model_vimeo (persistence_object_identifier VARCHAR(40) NOT NULL, videoid INT NOT NULL, PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE diu_assetsource_vimeo_domain_model_vimeo ADD CONSTRAINT FK_8E2A859847A46B0A FOREIGN KEY (persistence_object_identifier) REFERENCES neos_media_domain_model_asset (persistence_object_identifier) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE neos_contentrepository_domain_model_nodedata DROP INDEX IDX_CE6515692D45FE4D, ADD UNIQUE INDEX UNIQ_CE6515692D45FE4D (movedto)');
        $this->addSql('DROP INDEX idx_35dc14f03332102a ON neos_flow_resourcemanagement_persistentresource');
        $this->addSql('CREATE INDEX IDX_6954B1F63332102A ON neos_flow_resourcemanagement_persistentresource (sha1)');
        $this->addSql('DROP INDEX sourceuripathhash ON neos_redirecthandler_databasestorage_domain_model_redirect');
        $this->addSql('ALTER TABLE neos_media_domain_model_asset CHANGE assetsourceidentifier assetsourceidentifier VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE neos_media_domain_model_importedasset CHANGE importedat importedat DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function down(Schema $schema)
    {
        // this down() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on "mysql".');
        
        $this->addSql('DROP TABLE diu_assetsource_vimeo_domain_model_vimeo');
        $this->addSql('ALTER TABLE neos_contentrepository_domain_model_nodedata DROP INDEX UNIQ_CE6515692D45FE4D, ADD INDEX IDX_CE6515692D45FE4D (movedto)');
        $this->addSql('DROP INDEX idx_6954b1f63332102a ON neos_flow_resourcemanagement_persistentresource');
        $this->addSql('CREATE INDEX IDX_35DC14F03332102A ON neos_flow_resourcemanagement_persistentresource (sha1)');
        $this->addSql('ALTER TABLE neos_media_domain_model_asset CHANGE assetsourceidentifier assetsourceidentifier VARCHAR(255) DEFAULT \'neos\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE neos_media_domain_model_importedasset CHANGE importedat importedat DATETIME NOT NULL');
        $this->addSql('CREATE INDEX sourceuripathhash ON neos_redirecthandler_databasestorage_domain_model_redirect (sourceuripathhash, host)');
    }
}