<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221219074938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE song_artist (song_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_722870DA0BDB2F3 (song_id), INDEX IDX_722870DB7970CF8 (artist_id), PRIMARY KEY(song_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE song_artist ADD CONSTRAINT FK_722870DA0BDB2F3 FOREIGN KEY (song_id) REFERENCES song (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE song_artist ADD CONSTRAINT FK_722870DB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE song_artist DROP FOREIGN KEY FK_722870DA0BDB2F3');
        $this->addSql('ALTER TABLE song_artist DROP FOREIGN KEY FK_722870DB7970CF8');
        $this->addSql('DROP TABLE song_artist');
    }
}
