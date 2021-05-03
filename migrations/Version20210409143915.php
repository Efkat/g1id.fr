<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210409143915 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity DROP modified_at');
        $this->addSql('ALTER TABLE course DROP modified_at');
        $this->addSql('ALTER TABLE course_chapter DROP created_at, DROP modified_at');
        $this->addSql('ALTER TABLE exercice DROP modified_at');
        $this->addSql('ALTER TABLE project DROP modified_at');
        $this->addSql('ALTER TABLE project_chapter DROP modified_at');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity ADD modified_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE course ADD modified_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE course_chapter ADD created_at DATETIME NOT NULL, ADD modified_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE exercice ADD modified_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE project ADD modified_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE project_chapter ADD modified_at DATETIME NOT NULL');
    }
}
