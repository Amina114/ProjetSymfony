<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220330231652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club CHANGE creation_date creation_date DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE student ADD enabled TINYINT(1) NOT NULL, CHANGE creation_date creation_date DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classroom CHANGE name name VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE club CHANGE ref ref VARCHAR(25) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE creation_date creation_date DATE NOT NULL');
        $this->addSql('ALTER TABLE student DROP enabled, CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE creation_date creation_date DATE NOT NULL');
        $this->addSql('ALTER TABLE student_club CHANGE club_ref club_Ref VARCHAR(25) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
