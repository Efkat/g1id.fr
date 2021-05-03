<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210415133218 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity_chapter ADD time SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE course_chapter ADD time SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE project_chapter ADD time SMALLINT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity_chapter DROP time');
        $this->addSql('ALTER TABLE course_chapter DROP time');
        $this->addSql('ALTER TABLE project_chapter DROP time');
    }
}
