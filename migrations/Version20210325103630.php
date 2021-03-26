<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210325103630 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX sorties_lieux_fk ON sorties');
        $this->addSql('ALTER TABLE sorties ADD lieux_no_lieu_id INT DEFAULT NULL, DROP lieux_no_lieu');
        $this->addSql('CREATE INDEX IDX_488163E8171DE0C3 ON sorties (lieux_no_lieu_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participants DROP FOREIGN KEY FK_71697092DDF76323');
        $this->addSql('ALTER TABLE sorties DROP FOREIGN KEY FK_488163E8171DE0C3');
        $this->addSql('DROP INDEX IDX_488163E8171DE0C3 ON sorties');
        $this->addSql('ALTER TABLE sorties ADD lieux_no_lieu INT NOT NULL, DROP lieux_no_lieu_id');
        $this->addSql('CREATE INDEX sorties_lieux_fk ON sorties (lieux_no_lieu)');
    }
}
