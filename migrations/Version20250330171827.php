<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250330171827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE hotel_amenity (hotel_id INT NOT NULL, amenity_id INT NOT NULL, INDEX IDX_782A674A3243BB18 (hotel_id), INDEX IDX_782A674A9F9F1305 (amenity_id), PRIMARY KEY(hotel_id, amenity_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE hotel_amenity ADD CONSTRAINT FK_782A674A3243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE hotel_amenity ADD CONSTRAINT FK_782A674A9F9F1305 FOREIGN KEY (amenity_id) REFERENCES amenity (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE hotel_amenity DROP FOREIGN KEY FK_782A674A3243BB18
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE hotel_amenity DROP FOREIGN KEY FK_782A674A9F9F1305
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE hotel_amenity
        SQL);
    }
}
