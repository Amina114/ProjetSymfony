<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220326102713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student_club DROP FOREIGN KEY FK_87CD43AA8F40585A');
        $this->addSql('DROP INDEX idx_87cd43aa8f40585a ON student_club');
        $this->addSql('CREATE INDEX IDX_87CD43AAB70D1EBA ON student_club (club_ref)');
        $this->addSql('ALTER TABLE student_club ADD CONSTRAINT FK_87CD43AA8F40585A FOREIGN KEY (club_Ref) REFERENCES club (ref) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classroom CHANGE name name VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE club CHANGE ref ref VARCHAR(25) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE student CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE student_club DROP FOREIGN KEY FK_87CD43AAB70D1EBA');
        $this->addSql('ALTER TABLE student_club CHANGE club_ref club_Ref VARCHAR(25) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX idx_87cd43aab70d1eba ON student_club');
        $this->addSql('CREATE INDEX IDX_87CD43AA8F40585A ON student_club (club_Ref)');
        $this->addSql('ALTER TABLE student_club ADD CONSTRAINT FK_87CD43AAB70D1EBA FOREIGN KEY (club_ref) REFERENCES club (ref) ON DELETE CASCADE');
    }
}
