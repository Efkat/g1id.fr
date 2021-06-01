<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210601222759 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity ADD is_visible TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE course ADD is_visible TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE project ADD is_visible TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity DROP is_visible');
        $this->addSql('ALTER TABLE course DROP is_visible');
        $this->addSql('ALTER TABLE project DROP is_visible');
    }
}